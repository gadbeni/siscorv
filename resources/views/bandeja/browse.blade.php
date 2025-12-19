@extends('voyager::master')

@section('page_title', 'Bandeja de Entradas')

@if(auth()->user()->hasPermission('browse_bandeja'))

    @section('content')
        <div id="page-content" class="page-content browse container-fluid">
            @include('voyager::alerts')
            <div class="row">
                <div class="col-md-12 div-phone">
                    <div class="panel panel-bordered">
                        <div class="panel-body">

                            <div class="alert alert-info" style="padding: 5px 10px; display: none" role="alert" id="alert-new">
                                <div class="row">
                                    <div class="col-md-8" style="margin: 0px">
                                    <p style="margin-top: 10px"><b>Atención!</b> Tienes una nueva derivación, refresca la página para actualizar la lista.</p></div>
                                    <div class="col-md-4 text-right" style="margin: 0px"><button class="btn btn-default" onclick="location.reload()">Refrescar <i class="voyager-refresh"></i></button></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-9" style="margin-bottom: 0px">
                                    <div class="dataTables_length" id="dataTable_length">
                                        <label>Mostrar <select id="select-paginate" class="form-control input-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50" selected>50</option>
                                            <option value="100">100</option>
                                        </select> registros</label>
                                    </div>
                                </div>
                                <div class="col-sm-3" style="margin-bottom: 0px">
                                    <input type="text" id="input-search" class="form-control" placeholder="Ingrese busqueda..."> <br>
                                </div>
                                <div class="col-md-12 text-right">
                                    <label class="radio-inline"><input type="radio" class="radio-type" name="optradio" value="pendientes" checked>Pendientes</label>
                                    <label class="radio-inline"><input type="radio" class="radio-type" name="optradio" value="urgentes">Urgentes</label>
                                    <label class="radio-inline"><input type="radio" class="radio-type" name="optradio" value="derivados">Derivados</label>
                                    <label class="radio-inline"><input type="radio" class="radio-type" name="optradio" value="archivados">Archivados</label>
                                </div>
                            </div>
                            <div class="row" id="div-results" style="min-height: 200px">
                                {!! $initial_list !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('css')
        <style>
            .entrada:hover{
                cursor: pointer;
                opacity: .7;
            }
            .unread{
                background-color: rgba(135, 183, 148, 0.2) !important
            }
        </style>
    @endsection

    @section('javascript')
        <script src="{{ asset('vendor/loading_overlay/loadingoverlay.min.js') }}"></script>
        <script>
            var countPage = 50;
            jQuery(function($) {
                $('.radio-type').click(function(){
                    list();
                });
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

            // Hook for master socket listener
            function bandejaNewAlert() {
                jQuery('#alert-new').fadeIn();
            }

            function list(page = 1){
                jQuery("#div-results").LoadingOverlay("show");
                let type = jQuery(".radio-type:checked").val();
                let url = '{{ url("admin/bandeja/list/".($funcionario_id ?? 0)) }}';
                let search = jQuery('#input-search').val() ? jQuery('#input-search').val() : '';
                jQuery.ajax({
                    url: `${url}/${type}?search=${search}&paginate=${countPage}&page=${page}`,
                    type: 'get',
                    success: function(response){
                        jQuery('#div-results').html(response);
                        jQuery("#div-results").LoadingOverlay("hide");
                    },
                    error: function(){
                        jQuery("#div-results").LoadingOverlay("hide");
                    }
                });
            }

            function read(id){
                window.location = "{{ url('admin/bandeja') }}/"+id;
            }
        </script>
    @stop
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif