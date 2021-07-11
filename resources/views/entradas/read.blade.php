@extends('voyager::master')

@section('page_title', 'Ver Ingresos')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-credit-cards"></i> Viendo Ingresos
        <a href="{{ route('entradas.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Volver a la lista
        </a>
    </h1>
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Hoja de Ruta</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $data->tipo.'-'.$data->gestion.'-'.$data->id }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Fecha de Ingreso</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ date('d/m/Y H:i:s', strtotime($data->created_at)) }} <small>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</small></p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Número de Cite</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $data->cite }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Número de hojas</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $data->nro_hojas }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Origen</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $data->entity->nombre }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Remitente</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $data->remitente }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-12">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Referencia</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $data->referencia }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-12">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Archivos</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>N&deg;</th>
                                            <th>Título</th>
                                            <th>Fecha de registro</th>
                                            <th>Archivo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cont = 1;
                                        @endphp
                                        @forelse ($data->archivos as $item)
                                            <tr>
                                                <td>{{ $cont }}</td>
                                                <td>{{ $item->nombre_origen }}</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br><small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
                                                <td><a href="{{ url('storage/'.$item->ruta) }}" class="btn btn-sm btn-success" target="_blank"> <i class="voyager-eye"></i> Ver</a></td>
                                            </tr>
                                            @php
                                                $cont++;
                                            @endphp
                                        @empty
                                            
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <hr style="margin:0;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function () {
            
        });
    </script>
@stop
