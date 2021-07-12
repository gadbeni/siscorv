@extends('voyager::master')

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>HR</th>
                                        <th>Nro. de cite</th>
                                        <th>Fecha de ingreso</th>
                                        <th>Origen</th>
                                        <th>Remitente</th>
                                        <th>Referencia</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ingresos as $item)
                                        <tr class="entrada @if(!$item->visto) unread @endif" title="Ver" onclick="read({{ $item->id }})">
                                            <td></td>
                                            <td>{{ date('d/m/Y H:i:s', strtotime($item->entrada->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->entrada->created_at)->diffForHumans() }}</small></td>
                                            <td>{{ $item->entrada->tipo.'-'.$item->entrada->gestion.'-'.$item->entrada->id }}</td>
                                            <td>{{ $item->entrada->cite }}</td>
                                            <td>{{ $item->entrada->entity->nombre }}</td>
                                            <td>{{ $item->entrada->remitente }}</td>
                                            <td>{{ $item->entrada->referencia }}</td>
                                            <td></td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                            </table>
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
            background-color: rgba(9,132,41,0.2) !important
        }
    </style>
@endsection

@section('javascript')
    <script>
        $(document).ready(function(){
            $('#dataTable').DataTable({
                language: {
                    sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sSearch: "Buscar:",
                    sInfoThousands: ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior"
                    },
                    oAria: {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    buttons: {
                        copy: "Copiar",
                        colvis: "Visibilidad"
                    }
                }
            })
        });

        function read(id){
            window.location = "{{ url('admin/bandeja') }}/"+id;
        }
    </script>
@stop
