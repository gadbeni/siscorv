@extends('voyager::master')

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Pendientes</a></li>
                            <li><a data-toggle="tab" href="#menu1">Archivados</a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <div class="table-responsive">
                                    <table class="dataTable table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Fecha de derivación</th>
                                                <th>HR</th>
                                                <th>Nro. de cite</th>
                                                <th>Origen</th>
                                                <th>Remitente</th>
                                                <th>Referencia</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ingresos as $item)
                                                @php
                                                    $derivacion = $item->derivaciones[count($item->derivaciones)-1];
                                                    // dd($derivacion);
                                                @endphp
                                                @if ($funcionario_id == $derivacion->funcionario_id_para && $item->estado_id != 6 && $item->estado_id != 4)
                                                    <tr class="entrada @if(!$derivacion->visto) unread @endif" title="Ver" onclick="read({{ $derivacion->id }})">
                                                        <td></td>
                                                        <td>{{ date('d/m/Y H:i:s', strtotime($derivacion->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($derivacion->created_at)->diffForHumans() }}</small></td>
                                                        <td>{{ $item->tipo.'-'.$item->gestion.'-'.$item->id }}</td>
                                                        <td>{{ $item->cite }}</td>
                                                        <td>{{ $item->entity->nombre }}</td>
                                                        <td>{{ $item->remitente }}</td>
                                                        <td>{{ $item->referencia }}</td>
                                                        <td></td>
                                                    </tr>
                                                @endif
                                            @empty
                                                
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div class="table-responsive">
                                    <table class="dataTable table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Fecha de derivación</th>
                                                <th>HR</th>
                                                <th>Nro. de cite</th>
                                                <th>Origen</th>
                                                <th>Remitente</th>
                                                <th>Referencia</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ingresos as $item)
                                                @php
                                                    $derivacion = $item->derivaciones[count($item->derivaciones)-1];
                                                    // dd($derivacion);
                                                @endphp
                                                @if ($funcionario_id == $derivacion->funcionario_id_para && $item->estado_id == 4)
                                                    <tr class="entrada @if(!$derivacion->visto) unread @endif" title="Ver" onclick="read({{ $derivacion->id }})">
                                                        <td></td>
                                                        <td>{{ date('d/m/Y H:i:s', strtotime($derivacion->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($derivacion->created_at)->diffForHumans() }}</small></td>
                                                        <td>{{ $item->tipo.'-'.$item->gestion.'-'.$item->id }}</td>
                                                        <td>{{ $item->cite }}</td>
                                                        <td>{{ $item->entity->nombre }}</td>
                                                        <td>{{ $item->remitente }}</td>
                                                        <td>{{ $item->referencia }}</td>
                                                        <td></td>
                                                    </tr>
                                                @endif
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
            $('.dataTable').DataTable({
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
