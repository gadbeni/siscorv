@extends('voyager::master')

@section('page_title', 'Viendo Ingresos')

@if(auth()->user()->hasPermission('browse_entradas'))

    @section('page_header')
        <div class="container-fluid div-phone">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="voyager-credit-cards"></i>
                        @if (auth()->user()->hasRole('funcionario') && auth()->user()->hasRole('ventanilla'))
                            Correspondencia/NCI
                        @elseif (auth()->user()->hasRole('funcionario'))
                            NCI
                        @elseif(auth()->user()->hasRole('ventanilla'))
                            Correspondencia
                        @else
                            Correspondencia/NCI
                        @endif
                    </h1>
                    <a href="{{ route('entradas.create') }}" class="btn btn-success btn-add-new">
                        <i class="voyager-plus"></i> <span>Crear</span>
                    </a>
                </div>
                <div class="col-md-4">

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
                            <div class="row">
                                <div class="col-sm-9" style="margin-bottom: 0px">
                                    <div class="dataTables_length" id="dataTable_length">
                                        <label>Mostrar <select id="select-paginate" class="form-control input-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> registros</label>
                                    </div>
                                </div>
                                <div class="col-sm-3" style="margin-bottom: 0px">
                                    <input type="text" id="input-search" class="form-control" placeholder="Ingrese busqueda..."> <br>
                                </div>
                            </div>
                            <div class="row" id="div-results" style="min-height: 120px">
                                {!! $initial_list !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.modal-delete',['name'=>'Si anula esta entrada tambien anulara la derivacion si tuviese, desea continuar?'])

        {{-- Personas modal --}}
        @include('partials.modal-derivar')



        {{-- Para cambios de fercha de cada tramites --}}
        <form action="#" method="POST" class="form-submit" id="update_entrada_date" enctype="multipart/form-data">
        @csrf
            <div class="modal modal-success fade" tabindex="-1" id="modal-change-date" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa-solid fa-calendar"></i> Cambio de fecha de trámite</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="">Fecha</label>
                                        <input type="datetime-local" name="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="">Documento de Respaldo</label>
                                        <input type="file" name="file" id="" accept="application/pdf" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="">Observaciones</label>
                                        <textarea name="observation" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success btn-submit">Cambiar fecha</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
        {{-- <script src="{{ asset('vendor/loading_overlay/loadingoverlay.min.js') }}"></script> --}}

        <script>
            var destinatario_id;
            var intern_externo = 1;
            var countPage = 10;
            
            jQuery(function($) {
                // list(); // Eliminamos la carga inicial por AJAX ya que ahora viene del servidor
                // Pagination and search listeners
                $('#input-search').on('keyup', function(e){
                    if(e.keyCode == 13) {
                        list();
                    }
                });
                $('#select-paginate').change(function(){
                    countPage = $(this).val();
                    list();
                });

                // Delegation for pagination links
                $(document).on('click', '.page-link', function(e){
                    e.preventDefault();
                    let link = $(this).attr('href');
                    if(link){
                        let page_id = link.split('=')[1];
                        list(page_id);
                    }
                });
            });

            function list(page = 1){
                jQuery('#div-results').loading({message: 'Cargando...'});
                let url = '{{ url("admin/entradas/ajax/list") }}';
                let search = jQuery('#input-search').val() ? jQuery('#input-search').val() : '';
                jQuery.ajax({
                    url: `${url}?search=${search}&paginate=${countPage}&page=${page}`,
                    type: 'get',
                    success: function(result){
                        jQuery("#div-results").html(result);
                        jQuery('#div-results').loading('toggle');
                    },
                    error: function(){
                        jQuery('#div-results').loading('toggle');
                    }
                });
            }

            function deleteItem(url){
                jQuery('#delete_form').attr('action', url);
            }

            function dateItem(url){
                jQuery('#update_entrada_date').attr('action', url);
            }
        </script>
    @endpush
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif
