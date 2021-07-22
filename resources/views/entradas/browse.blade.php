@extends('voyager::master')

@section('page_title', 'Viendo Ingresos')

@if(auth()->user()->hasPermission('browse_entradas'))

    @section('page_header')
        <div class="container-fluid div-phone">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="voyager-credit-cards"></i> Ingresos
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
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-hover">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.modal-delete')

        {{-- Personas modal --}}
        @include('partials.modal-derivar')
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
                    { data: 'hr', title: 'HR' },
                    { data: 'fecha_ingreso', title: 'Fecha de ingreso' },
                    // { data: 'cite', title: 'Nro. cite' },
                    // { data: 'nro_hojas', title: 'Nro. de hojas' },
                    { data: 'origen', title: 'origen' },
                    { data: 'remitente', title: 'Remitente' },
                    { data: 'referencia', title: 'Referencia' },
                    { data: 'estado', title: 'Estado' },
                    { data: 'action', title: 'Acciones', orderable: false, searchable: false },
                ]
                customDataTable("{{ url('admin/entradas/ajax/list') }}/", columns);
            });

            function derivacionItem(id){
                $('#form-derivacion input[name="id"]').val(id);
            }

            function deleteItem(url){
                $('#delete_form').attr('action', url);
            }

            $(function() {
                let ip_address = '127.0.0.1';
                let socket_port = "{{ env('SOCKET_PORT', '3000') }}";
                let socket = io(ip_address + ':' + socket_port);
                @if (session('alert-type'))
                socket.emit('sendNotificationToServer', "{{ session('funcionario_id') }}");
                @endif
            });

        </script>
    @endpush
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif
