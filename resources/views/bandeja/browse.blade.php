@extends('voyager::master')

@section('page_title', 'Bandeja de Entradas')

@if(auth()->user()->hasPermission('browse_bandeja'))

    @section('content')
        <div class="page-content browse container-fluid">
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

                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#home">Pendientes</a></li>
                                <li><a data-toggle="tab" href="#menu2">Urgentes</a></li>
                                <li><a data-toggle="tab" href="#menu1">Archivados</a></li>
                            </ul>
                            
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                    <div class="table-responsive">
                                        <table class="dataTable table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>HR</th>
                                                    <th>Fecha de derivación</th>
                                                    <th>Nro. de cite</th>
                                                    <th>Remitente</th>
                                                    <th>Referencia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($ingresos as $item)
                                                    @php
                                                        $derivacion = $item->derivaciones[count($item->derivaciones)-1];
                                                        // dd($derivacion);
                                                    @endphp
                                                    @if ($funcionario_id == $derivacion->funcionario_id_para && $item->estado_id != 6 && $item->estado_id != 4 && $item->urgent != true)
                                                        <tr class="entrada @if(!$derivacion->visto) unread @endif" title="Ver" onclick="read({{ $derivacion->id }})">
                                                            <td>{{ $item->id }}</td>
                                                            <td>{{ $item->tipo.'-'.$item->gestion.'-'.$item->id }}</td>
                                                            <td>{{ date('d/m/Y H:i:s', strtotime($derivacion->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($derivacion->created_at)->diffForHumans() }}</small></td>
                                                            <td>{{ $item->cite }}</td>
                                                            <td>{{ $item->remitente }}</td>
                                                            <td>{{ $item->referencia }}</td>
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
                                                    <th>ID</th>
                                                    <th>HR</th>
                                                    <th>Fecha de derivación</th>
                                                    <th>Nro. de cite</th>
                                                    <th>Remitente</th>
                                                    <th>Referencia</th>
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
                                                            <td>{{ $item->id }}</td>
                                                            <td>{{ $item->tipo.'-'.$item->gestion.'-'.$item->id }}</td>
                                                            <td>{{ date('d/m/Y H:i:s', strtotime($derivacion->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($derivacion->created_at)->diffForHumans() }}</small></td>
                                                            <td>{{ $item->cite }}</td>
                                                            <td>{{ $item->remitente }}</td>
                                                            <td>{{ $item->referencia }}</td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                    
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="menu2" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="dataTable table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>HR</th>
                                                    <th>Fecha. Derivación</th>
                                                    <th>Plazo</th>
                                                    <th>Nro. de cite</th>
                                                    <th>Remitente</th>
                                                    <th>Referencia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($ingresos as $item)
                                                    @php
                                                        $derivacion = $item->derivaciones[count($item->derivaciones)-1];
                                                        $now = \Carbon\Carbon::now();
                                                        $created = new \Carbon\Carbon($item->deadline);
                                                        $difference = ($created <= $now)
                                                                        ? 'NOTA EXTEMPORÁNEA'
                                                                        : 'URGENTE';
                                                        // dd($derivacion);
                                                    @endphp
                                                    @if ($funcionario_id == $derivacion->funcionario_id_para && $item->urgent)
                                                        <tr class="entrada @if(!$derivacion->visto) unread @endif" title="Ver" onclick="read({{ $derivacion->id }})">
                                                            <td>{{ $item->id }}</td>
                                                            <td>{{ $item->tipo.'-'.$item->gestion.'-'.$item->id }}</td>
                                                            <td>{{ date('d/m/Y H:i:s', strtotime($derivacion->created_at)) }} <br> 
                                                                <small>
                                                                    {{ \Carbon\Carbon::parse($derivacion->created_at)->diffForHumans() }}
                                                                </small>
                                                            </td>
                                                            <td>{{ date('d/m/Y', strtotime($item->deadline)) }} <br> 
                                                                <small>
                                                                    <strong class="{{($difference != 'URGENTE') ? 'danger' : 'success'}}"><h5>{{$difference}}</h5></strong>
                                                                </small>
                                                            </td>
                                                            <td>{{ $item->cite }}</td>
                                                            <td>{{ $item->remitente }}</td>
                                                            <td>{{ $item->referencia }}</td>
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
        <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                $('.dataTable').DataTable({
                    language: {
                        // "order": [[ 0, "desc" ]],
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


                // Socket.io
                let socket = io(IP_ADDRESS + ':' + SOCKET_PORT);
                socket.on('sendNotificationToClient', (id) => {
                    let user_id = "{{ Auth::user()->id }}";
                    if(user_id == id){
                        $('#alert-new').fadeIn();
                    }
                });

                @if (session('alert-type'))
                socket.emit('sendNotificationToServer', "{{ session('funcionario_id') }}");
                @endif
            });

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