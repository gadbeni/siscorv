@extends('voyager::master')

@section('page_title', 'Ver Ingresos')

@section('page_header')
    <div class="col-md-6" style="margin: 20px 0px;">
        <h3 class="text-muted"> <a href="{{ route('bandeja.index') }}" class="btn btn-default"><i class="voyager-angle-left"></i> Volver</a> &nbsp; {{ $data->referencia }}</h3>
    </div>
    <div class="col-md-6 text-right" style="margin-top: 40px;">
        <div class="btn-group" role="group" aria-label="...">
            @if ($data->estado_id != 4)
                <button type="button" data-toggle="modal" data-target="#modal-archivar" title="Archivar" class="btn btn-default"><i class="voyager-categories"></i> Archivar</button>
                <button type="button" data-toggle="modal" data-target="#modal-derivar" title="Derivar" class="btn btn-default"><i class="voyager-forward"></i> Derivar</button>
                <button type="button" data-toggle="modal" data-target="#modal-rechazar" title="Rechazar" class="btn btn-default"><i class="voyager-warning"></i> Rechazar</button>
            @endif
            {{-- <button type="button" title="Anterio" class="btn btn-default"><i class="voyager-angle-left"></i> &nbsp;</button>
            <button type="button" title="Siguiente" class="btn btn-default"><i class="voyager-angle-right"></i> &nbsp;</button> --}}
        </div>
    </div>
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
                                        @if ($data->estado_id != 4)
                                        <a href="#" data-toggle="modal" data-target="#modal-upload" class="btn btn-success" style="margin: 15px;">
                                            <span class="voyager-plus"></span>&nbsp;
                                            Agregar nuevo
                                        </a>
                                        @endif
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
            </div>
        </div>
    </div>

    @include('partials.modal-dropzone', ['title' => 'Agregar archivo', 'id' => $data->id, 'action' => url('admin/entradas/store/file')])

    {{-- rechazar modal --}}
    <form action="{{ route('bandeja.archivar', ['id' => $data->id]) }}" method="post">
        <div class="modal modal-success fade" tabindex="-1" id="modal-archivar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-categories"></i> Archivar correspondencia</h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Archivar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    {{-- Personas modal --}}
    @include('partials.modal-derivar', ['personas' => $personas, 'id' => $data->id, 'redirect' => 'bandeja.index'])

    {{-- rechazar modal --}}
    <form action="{{ route('bandeja.rechazar', ['id' => $data->id]) }}" method="post">
        <div class="modal modal-danger fade" tabindex="-1" id="modal-rechazar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-warning"></i> Rechazar correspondencia</h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="form-group">
                            <label>Motivo del rechazo</label>
                            <textarea name="observacion" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Rechazar</button>
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

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#select-destinatario').select2({ dropdownParent: "#derivar-modal" });
        });
    </script>
@stop
