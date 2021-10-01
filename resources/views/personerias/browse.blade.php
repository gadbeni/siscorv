@extends('voyager::master')

@section('page_title', 'Viendo Personerias')

@if(auth()->user()->hasPermission('browse_personerias'))

    @section('page_header')
        <div class="container-fluid div-phone">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="voyager-credit-cards"></i> Personerias
                    </h1>
                    <a href="{{ route('personerias.create') }}" class="btn btn-success btn-add-new">
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
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-hover">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.modal-delete',['name' => 'Desea Anular esta personeria?'])

    @stop

    @section('css')
        <style>
            .select2-container {
                width: 100% !important;
            }
        </style>
    @stop

    @push('javascript')
        <script src="{{ url('js/main.js') }}"></script>
        <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {
                let columns = [
                    { data: 'id', title: 'ID' },
                    { data: 'nombre_reserva', title: 'Nombre reserva' },
                    { data: 'representante', title: 'Representante' },
                    { data: 'hojaruta', title: 'Hoja Ruta' }, 
                    { data: 'fecha_entrega', title: 'Fecha de entrega' },
                    { data: 'fecha_conclusion', title: 'Fecha de conclusion' },
                    { data: 'action', title: 'Acciones', orderable: false, searchable: false },
                ]
                customDataTable("{{ url('admin/personerias/ajax/list') }}/", columns);
            });

            function deleteItem(url){
                $('#delete_form').attr('action', url);
            }

        </script>
    @endpush
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif
