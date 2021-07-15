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
                    </div>
                </div>
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-heading" style="border-bottom:0;">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3 class="panel-title">Archivos</h3>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <a href="#" data-toggle="modal" data-target="#modal-upload" class="btn btn-success" style="margin: 15px;">
                                            <span class="voyager-plus"></span>&nbsp;
                                            Agregar nuevo
                                        </a>
                                    </div>
                                </div>
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
                                                <td><a href="{{ url('storage/'.$item->ruta) }}" class="btn btn-sm btn-info" target="_blank"> <i class="voyager-eye"></i> Ver</a></td>
                                            </tr>
                                            @php
                                                $cont++;
                                            @endphp
                                        @empty
                                            <tr>
                                                <td colspan="4"><h5 class="text-center">No hay archivos guardados</h5></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <hr style="margin:0;">
                        </div>
                    </div>
                </div>
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Historial de derivaciones</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <table class="table table-bordered-table-hover">
                                    <thead>
                                        <tr>
                                            <th>N&deg;</th>
                                            <th>Dirección</th>
                                            <th>Unidad</th>
                                            <th>Funcionario</th>
                                            <th>Acciones</th>
                                            <th>Fecha de derivación</th>
                                            {{-- <th>Fecha de recepción</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cont = 1;
                                        @endphp
                                        @forelse ($data->derivaciones as $item)
                                            <tr>
                                                <td>{{ $cont }}</td>
                                                <td>{{ $item->funcionario_direccion_para }}</td>
                                                <td>{{ $item->funcionario_unidad_para }}</td>
                                                <td>{{ $item->funcionario_nombre_para }} <br> <small>{{ $item->funcionario_cargo_para }}</small> </td>
                                                <td>{{ $item->observacion }}</td>
                                                <td>{{ date('d/m/Y', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
                                                {{-- <td></td> --}}
                                            </tr>
                                            @php
                                                $cont++;
                                            @endphp
                                        @empty
                                            <tr>
                                                <td colspan="7"><h5 class="text-center">No se han realizado derivaciones</h5></td>
                                            </tr>
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

    @include('partials.modal-dropzone', ['title' => 'Agregar archivo', 'id' => $data->id, 'action' => url('admin/entradas/store/file')])
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/dropzone/dropzone.min.css') }}">
@endsection

@section('javascript')
<script src="{{ asset('vendor/dropzone/dropzone.min.js') }}"></script>
    <script>
        $(document).ready(function () {

        });
    </script>
@stop
