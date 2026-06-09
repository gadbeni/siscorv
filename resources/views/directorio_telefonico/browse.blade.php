@extends('voyager::master')

@section('page_title', 'Directorio Telefónico')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8" style="padding: 0px">
                <h1 class="page-title">
                    <i class="voyager-telephone"></i>
                    Directorio Telefónico
                </h1>
            </div>
            <div class="col-md-4 text-right" style="margin-top: 30px">
                @if (auth()->user()->hasPermission('delete_directorio_telefonico'))
                    <a href="{{route('directorio-telefonico.create')}}" class="btn btn-success">
                        <i class="voyager-plus"></i> <span>Crear</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12 div-phone">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row" style="margin-bottom: 10px; align-items: center;">
                            <div class="col-sm-3" style="margin-bottom: 0px">
                                <label style="font-weight: normal;">Mostrar
                                    <select id="select-paginate" class="form-control input-sm" style="display:inline-block;width:auto;">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> registros
                                </label>
                            </div>
                            <div class="col-sm-4" style="margin-bottom: 0px">
                                <div class="input-group">
                                    <span class="input-group-addon"><b>Filtro:</b></span>
                                    <select id="select-grupo" name="directorioGrupo" class="form-control select2">
                                        <option value="">TODOS</option>
                                        @foreach ( $directorioGrupos as $item )
                                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5" style="margin-bottom: 0px">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="voyager-search"></i></span>
                                    <input type="text" id="input-search" class="form-control" placeholder="Buscar...">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="div-results" style="min-height: 120px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.modal-delete',['name'=>'Desea Eliminar este registro telefónico?'])
@stop

@section('css')
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
@stop

@push('javascript')
    <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/loading_overlay/loadingoverlay.min.js') }}"></script>

    <script>
        var countPage = 10;
        var directorioGrupo = "";
        $(document).ready(function() {
            list();
            var searchTimer;
            $('#input-search').on('keyup', function(){
                clearTimeout(searchTimer);
                searchTimer = setTimeout(function(){ list(); }, 350);
            });
            $('#select-paginate').change(function(){
                countPage = $(this).val();
                list();
            });
            $('#select-grupo').change(function(){
                directorioGrupo = $(this).val();
                list();
            });
        });

        function list(page = 1){
            $("#div-results").LoadingOverlay("show");
            let url = '{{ url("admin/directorio_telefonico/ajax/list") }}';
            let search = $('#input-search').val() ? $('#input-search').val() : '';
            $.ajax({
                url: `${url}?directorioGrupo=${directorioGrupo}&search=${search}&paginate=${countPage}&page=${page}`,
                type: 'get',
                success: function(response){
                    $('#div-results').html(response);
                    $("#div-results").LoadingOverlay("hide");
                }
            });
        }
        function deleteItem(url){
            $('#delete_form').attr('action', url);
        }
    </script>
@endpush