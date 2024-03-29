@extends('voyager::master')

@section('page_title', 'Ver Detalle de Bandeja')

@if(auth()->user()->hasPermission('read_bandeja'))
    @section('content')
        <div class="page-content read container-fluid div-phone">
            <div class="row">
                <div class="col-md-6" style="margin-top: 20px;">
                    <a href="{{ route('bandeja.index') }}" class="btn btn-default"><i class="voyager-angle-left"></i> Volver</a>
                </div>
                <div class="col-md-6 text-right" style="margin-top: 20px;">
                    <div class="btn-group" role="group" aria-label="...">
                        @if ($data->estado_id != 4 && $derivacion->ok != 'ARCHIVADO' && $derivacion->ok != 'SI' && $derivacion->ok != 'RECHAZADO')
                            <button type="button" data-toggle="modal" data-target="#modal-archivar" title="Archivar" class="btn btn-default"><i class="voyager-categories"></i> Archivar</button>
                            @if($derivacion->via == 0)
                                <button type="button" data-toggle="modal" data-target="#modal-derivar" title="Derivar" class="btn btn-default"><i class="voyager-forward"></i> Derivar</button>
                                <button type="button" data-toggle="modal" data-target="#modal-rechazar" title="Rechazar" class="btn btn-default"><i class="voyager-warning"></i> Rechazar</button>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <h3 class="text-muted" style="padding-left: 10px">{{ $data->referencia }}</h3>
                        </div>
                    </div>
                </div>
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
                                    <p>{{ $data->cite ?? 'No definido' }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Número de hojas</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $data->nro_hojas ?? 'No definido' }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Origen</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    @if ($data->tipo == 'E')
                                    <p>{{ $data->entity->nombre }}</p>
                                    @else
                                    <p>{{ $origen }}</p>
                                    @endif
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
                            @if ($data->tipo == 'I')
                            <div class="col-md-12">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Destino</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    {{ $data->person ? $data->person->first_name.' '.$data->person->last_name : '' }}
                                </div>
                                <hr style="margin:0;">
                            </div>
                            @endif
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
                                                <th>Adjuntado por</th>
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
                                                    <td>{{ $item->user->name ?? 'RDE' }}</td>
                                                    <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br><small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
                                                    <td class="no-sort no-click bread-actions text-right">
                                                        <a href="{{ url('storage/'.$item->ruta) }}" class="btn btn-warning" target="_blank"> <i class="voyager-eye"></i> Ver</a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $cont++;
                                                @endphp
                                            @empty
                                                <tr>
                                                    <td colspan="5"><h5 class="text-center">No hay archivos guardados</h5></td>
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="panel-title">Historial de derivaciones</h3>
                                        </div>
                                    </div>
                                </div>
                                @if ($data->derivaciones->count() > 0)
                                <div class="panel-body" style="padding-top:0;">
                                    <table class="table table-bordered-table-hover">
                                        <thead>
                                            <tr>
                                                <th>N&deg;</th>
                                                <th>Dirección Administrativa</th>
                                                <th>Funcionario</th>
                                                <th>Observaciones</th>
                                                <th></th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $cont = 1;
                                            @endphp
                                            @forelse ($data->derivaciones as $item)
                                                <tr @if ($item->rechazo) style="background-color: rgba(192,57,43,0.3)" @endif @if ($item->via) style="background-color: rgb(224,223,223)" @endif>
                                                    <td>{{ $cont }}</td>
                                                    <td>{{ $item->funcionario_direccion_para }} <br> {{ Str::upper($item->funcionario_unidad_para) }}</td>
                                                    <td>{{ $item->funcionario_nombre_para }} <br> <small>{{ $item->funcionario_cargo_para }}</small> </td>
                                                    <td>{{ $item->observacion }}</td>
                                                    <td>
                                                        @if ($item->visto)
                                                            <i class="fa-solid fa-eye" style="color: rgb(9,132,41)"></i>
                                                        @else
                                                            <i class="fa-solid fa-eye-slash"></i>
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
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
                                @endif
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal para eliminar las derivaciones --}}
        <div class="modal modal-danger fade" tabindex="-1" id="anular_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-trash"></i> Desea anular la siguiente derivación?</h4>
                    </div>
                    <div class="modal-footer">
                        <p></p>
                        <form id="anulacion_form" action="{{ route('bandeja-derivation.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="entrada_id" value="{{ $data->id }}">
                            <input type="hidden" name="id">
                            <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, anular">
                        </form>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.modal-dropzone', ['title' => 'Agregar archivo', 'id' => $data->id, 'action' => url('admin/entradas/store/file')])

        {{-- rechazar modal --}}
        <form class="form-submit" action="{{ route('bandeja.archivar', ['id' => $data->id]) }}" method="post">
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
                            <input type="hidden" name="derivacion_id" value="{{ $derivacion->id }}">
                            <div class="form-group">
                                <label class="">Observaciones</label>
                                <textarea name="observacion" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success btn-submit">Archivar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        {{-- Personas modal --}}
        @include('partials.modal-derivar', ['id' => $data->id, $der_id = $derivacion->id, 'redirect' => 'bandeja.index'])

        {{-- rechazar modal --}}
        <form class="form-submit" action="{{ route('bandeja.rechazar', ['id' => $data->id]) }}" method="post">
            <div class="modal modal-danger fade" tabindex="-1" id="modal-rechazar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="voyager-warning"></i> Rechazar correspondencia</h4>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="derivacion_id" value="{{ $derivacion->id }}">
                            <div class="form-group">
                                <label>Motivo del rechazo</label>
                                <textarea name="observacion" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger btn-submit">Rechazar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- info modal --}}
        <div class="modal modal-success fade" tabindex="-1" id="info_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-activity"></i> Detalle de la derivacion</h4>
                    </div>
                    <form id="info_form" action="#" method="POST">
                     @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Direccion</label>
                            <input class="form-control" type="text" name="direccion_para" readonly>
                            <label>Unidad</label>
                            <input class="form-control" type="text" name="unidad_para" readonly>
                            <label>Observacion</label>
                            <textarea class="form-control" name="observacion" id="" rows="4" readonly></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @stop

    @section('css')
        <style>
            .select2-container {
                width: 100% !important;
            }
            .bread-actions .btn{
                margin: 5px 0px;
                padding: 5px 10px;
                font-size: 12px;
                text-decoration: none
            }
        </style>
    @endsection
        
    @section('javascript')
        <script>
            var destinatario_id = 0;
            var intern_externo = 1;
            
            $(document).ready(function () {

            });

        </script>
    @stop
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif
