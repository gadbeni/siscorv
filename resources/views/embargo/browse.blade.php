@extends('voyager::master')

@section('page_title', 'Viendo Ingresos')

@if(auth()->user()->hasPermission('browse_embargos'))

    @section('page_header')
        <div class="container-fluid div-phone">
            <div class="row">
                    <div class="col-md-6">
                        <h1 class="page-title">
                            <i class="fa-solid fa-square-pen"></i> Embargos
                        </h1>
                        @if(auth()->user()->hasPermission('add_embargos'))
                            <a data-toggle="modal" data-target="#myModal" class="btn btn-success btn-add-new">
                                <i class="fa-solid fa-file-import"></i> <span>Importar</span>
                            </a>
                            <a data-toggle="modal" data-target="#modal_destroy" class="btn btn-danger btn-add-new">
                                <i class="fa-solid fa-trash"></i> <span>Eliminar Lista</span>
                            </a>
                        @endif
                    </div>
                
                <div class="col-md-6">
                </div>
            </div>
        </div>
    @stop

    @section('content')
        <div class="page-content browse container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="dataTables_length" id="dataTable_length">
                                        <label>Mostrar <select id="select-paginate" class="form-control input-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> registros</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" id="input-search" class="form-control">
                                </div>
                            </div>
                            <div class="row" id="div-results" style="min-height: 120px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form class="form-submit" action="{{ route('embargos-embargo.excel') }}" id="form-create-customer" enctype="multipart/form-data" method="post">
            @csrf
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content modal-success">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa-solid fa-file-import"></i> Importar archivo excel</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="archivo" type="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default btn-cerrar" data-dismiss="modal" value="Cerrar">
                            <input type="submit" id="btn-add-new" class="btn btn-success btn-add-new btn-submit" value="Sí, agregar">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>


        {{-- modal para inhabilitar --}}
        <div class="modal modal-warning fade" tabindex="-1" id="modal-inhabilitar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-submit" action="{{ route('embargos-list.inhabilitar') }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa-solid fa-triangle-exclamation"></i> Desea Inhabilitar?</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <p>Desea inhabilitar el siguiente registro?</p>
                        </div>                
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-warning delete-confirm btn-submit" value="Sí, Inhabilitar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Para eliminar todos los registro de embargo --}}
        <div class="modal modal-danger fade" id="modal_destroy" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa-solid fa-trash"></i> Eliminar Lista</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <p>Desea eliminar todos los registro de la lista de embargo?</p>
                    </div>                
                    <div class="modal-footer">                            
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <a href="{{route('embargos.eliminar')}}" class="btn btn-danger btn-add-new">Si, eliminar</a>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- modal para habilitar --}}
        <div class="modal fade" tabindex="-1" id="modal-habilitar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-success">
                    <form class="form-submit" action="{{ route('embargos-list.habilitar') }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa-solid fa-check"></i> Desea Habilitar?</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="text-center" style="text-transform:uppercase">
                                <i class="fa-solid fa-check" style="color: #42d07e; font-size: 5em;"></i>
                                <br>
                                <p><b>Desea habilitar el siguiente registro?</b></p>
                            </div>
                        </div>                
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success delete-confirm" value="Sí, Habilitar">
                            <button type="button" class="btn btn-default btn-submit" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @stop

    @section('css')
    @stop

    @push('javascript')
        <script>
            var countPage = 10, order = 'id', typeOrder = 'desc';
            $(document).ready(() => {
                list();
                $('#input-search').on('keyup', function(e){
                    if(e.keyCode == 13) {
                        list();
                    }
                });

                $('#select-paginate').change(function(){
                    countPage = $(this).val();
                    list();
                });

                $('#modal-inhabilitar').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget)
                    var id = button.data('id')
                    var modal = $(this)
                    modal.find('.modal-body #id').val(id)
                    
                });
                $('#modal-habilitar').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget)
                    var id = button.data('id')
                    var modal = $(this)
                    modal.find('.modal-body #id').val(id)
                });

            });

            $(document).on('change','#archivo',function(){
                $('#form-create-customer').submit(function(e){
                    $('.btn-add-new').attr('disabled', true);
                    $('.btn-cerrar').attr('disabled', true);
                    $('.btn-add-new').val('Importando su archivo...');                       
                });

                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;
                if(fileSize > 5000000){
                    alert('El archivo no debe superar los 3MB');
                    this.value = '';
                    this.files[0].name = '';
                }else{
                    var ext = fileName.split('.').pop().toLowerCase();
                    switch (ext) {
                        case 'xlsx': break;
                        default:
                            alert('El archivo no tiene la extensión adecuada');
                            this.value = '';
                            this.files[0].name = '';
                    }
                }
            });

            function list(page = 1){
                // $('#div-results').loading({message: 'Cargando...'});
                let url = '{{ url("admin/embargos/list/ajax") }}';
                let search = $('#input-search').val() ? $('#input-search').val() : '';
                $.ajax({
                    url: `${url}?search=${search}&paginate=${countPage}&page=${page}`,
                    type: 'get',
                    success: function(response){
                        $('#div-results').html(response);
                        // $('#div-results').loading('toggle');
                    }
                });
            }
        </script>
    @endpush
@else
    @section('content')
        @include('errors.403')
    @stop
@endif
