@extends('voyager::master')

@section('page_title', 'Ver Detalle de Ingreso')

@if(auth()->user()->hasPermission('read_entradas'))
    @section('content')
        <div class="page-content read container-fluid div-phone">
            <div class="row">
                <div class="col-md-6 col-xs-6" style="margin-top: 20px;">
                    <a href="{{ route('entradas.index') }}" class="btn btn-default"><i class="voyager-angle-left"></i> Volver</a>
                    @if(setting('servidores.whatsapp') && setting('servidores.whatsapp-session'))
                        @if ($data->tipo == 'I' && $data->estado_id != 6)
                        <button class="btn btn-sm btn-success btn-send-message"
                            data-toggle="modal" data-target="#send-message-modal"
                            {{-- data-phone="{{ $item->phone }}" @if(!$item->phone) disabled @endif > --}}
                            data-phone="{{$user_entrada->phone}}" @if(!$user_entrada->phone) disabled @endif >
                            <i class="fa fa-paper-plane"></i> Notificar <i class="fa-brands fa-whatsapp"></i>
                        </button>
                        @endif
                    @endif
                    {{-- <i class="voyager-paper-plane"></i> --}}
                </div>
                <div class="col-md-6 text-right" style="margin-top: 20px;">
                    
                    <div class="dropdown">
                        <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Imprimir
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu pull-right">
                          <li>
                            <a href="{{ route('entradas.print', ['entrada' => $data->id]) }}" target="_blank">
                                <span class="glyphicon glyphicon-print"></span>&nbsp;
                                    Comprobante
                            </a>
                          </li>
                          <li>
                            <a href="{{ route('entradas.printhr', ['entrada' => $data->id]) }}" target="_blank">
                                <span class="glyphicon glyphicon-print"></span>&nbsp;
                                    Hoja de Ruta
                            </a>
                          </li>
                        </ul>
                        @if ($data->derivaciones->whereNull('deleted_at')->count() == 0)
                            @if (count($nci) > 0)
                                <button data-toggle="modal" data-target="#modal-derivar" onclick="derivacionItem({{ $data->id }}, {{ $data->people_id_para }})" title="Derivar" class="btn btn-sm btn-dark view" style="border: 0px">
                                    <i class="voyager-forward"></i> <span class="hidden-xs hidden-sm">Derivar</span>
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(setting('servidores.whatsapp') && setting('servidores.whatsapp-session'))
                    <a class="btn btn-default" href="{{ route('entradas.mensajes', ['entrada' => $data->id]) }}">
                        <i class="fa fa-paper-plane"></i> Ver Mensajes enviados
                    </a>
                    @endif
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <h3 class="text-muted page-title" style="padding: 0; padding-left: 10px;">{{ $data->referencia }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <div class="row">
                            @if (count($nci)==0)
                                <div class="col-md-12">
                                    <form class="form-submit" action="{{route('entradas-file-nci.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$data->id}}">
                                        <div class="upload-respaldo">
                                            <div class="upload-respaldo-header">
                                                <div class="upload-respaldo-icon">
                                                    <i class="voyager-warning"></i>
                                                </div>
                                                <div class="upload-respaldo-text">
                                                    <h4>Documento de respaldo pendiente</h4>
                                                    <p>Adjunte el documento digitalizado para continuar con el trámite. Formatos permitidos: <strong>PDF, JPG o PNG</strong>.</p>
                                                </div>
                                            </div>
                                            <label class="upload-dropzone" for="input-archivos-nci">
                                                <i class="voyager-upload"></i>
                                                <span><strong>Haga clic para seleccionar</strong> o arrastre los archivos aquí</span>
                                                <input type="file" id="input-archivos-nci" name="archivos[]" multiple accept="image/jpeg,image/jpg,image/png,application/pdf">
                                            </label>
                                            <ul class="upload-file-list" id="upload-file-list"></ul>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-warning btn-submit" id="btn-subir-archivos" disabled>
                                                    <i class="voyager-upload"></i> Subir Archivos
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
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
                            @if ($data->tipo == 'E')
                                <div class="col-md-6">
                                    <div class="panel-heading" style="border-bottom:0;">
                                        <h3 class="panel-title">Origen</h3>
                                    </div>
                                    <div class="panel-body" style="padding-top:0;">
                                        {{ $data->entity->nombre ?? 'Sin Origen' }}                                   
                                    </div>
                                    <hr style="margin:0;">
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Remitente</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    {{ $data->remitente ? strtoupper($data->remitente). ' - ' .strtoupper($data->job_de) : '' }}
                                </div>
                                <hr style="margin:0;">
                            </div>
                            {{-- @if ($data->tipo == 'I') --}}
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Destino</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    {{ $data->person ? $data->person->first_name.' '.$data->person->last_name : '' }}
                                </div>
                                <hr style="margin:0;">
                            </div>
                            {{-- @endif --}}
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
                                            <a href="#" data-toggle="modal" data-target="#modal-upload" class="btn btn-success" style="margin: 15px;"><span class="voyager-plus"></span>&nbsp;Agregar nuevo</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body table-responsive" style="padding-top:0;">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>N&deg;</th>
                                                <th>ID</th>
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
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->nombre_origen }}</td>
                                                    <td>{{ $item->user->name ?? 'RDE' }}</td>
                                                    <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br><small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
                                                    <td class="no-sort no-click bread-actions text-right">
                                                        <a href="{{ str_starts_with($item->ruta, 'http') ? $item->ruta : url('storage/'.$item->ruta) }}" class="btn btn-warning" target="_blank">
                                                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">ver</span>
                                                        </a>
                                                        <button type="button" data-toggle="modal" data-target="#delete-file-modal" data-id="{{ $item->id }}" class="btn btn-danger btn-sm btn-delete-file">
                                                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Anular</span>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @php
                                                    $cont++;
                                                @endphp
                                            @empty
                                                <tr>
                                                    <td colspan="6"><h5 class="text-center">No hay archivos guardados</h5></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <hr style="margin:0;">
                            </div>
                        </div>
                    </div>

                    @if($data->tipo == 'I')
                        <div class="panel panel-bordered" style="padding-bottom:5px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-heading" style="border-bottom:0;">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <label class="panel-title">Vias</label>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                @if ($data->derivaciones->whereNull('deleted_at')->count() == 0)
                                                    <button 
                                                        type="button" 
                                                        data-toggle="modal" 
                                                        data-target="#modal-derivar-via" 
                                                        title="Nuevo" class="btn btn-success"
                                                        style="margin: 15px;">
                                                        <span class="voyager-plus"></span>&nbsp;Agregar nueva
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body" style="padding-top:0;">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>N&deg;</th>
                                                        <th>ID</th>
                                                        <th>Nombre</th>
                                                        <th>Cargo</th>
                                                        <th class="text-right">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $cont = 1;
                                                    @endphp
                                                    @forelse ($data->vias as $item)
                                                        <tr style="text-transform: uppercase;">
                                                            <td>{{ $cont }}</td>
                                                            <td>{{ $item->id }}</td>
                                                            <td>{{ $item->nombre }}</td>
                                                            <td>{{ $item->cargo }}</td>
                                                            <td class="no-sort no-click bread-actions text-right">
                                                                @if ($data->derivaciones->whereNull('deleted_at')->count() == 0)
                                                                    <button type="button" data-toggle="modal" data-target="#delete-via-modal" data-id="{{ $item->id }}" data-entrada_id="{{ $data->id }}" class="btn btn-danger btn-sm btn-delete-via">
                                                                        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Anular</span>
                                                                    </button>
                                                                @endif
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
                                    </div>
                                    <hr style="margin:0;">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h3 class="panel-title">Historial de derivaciones</h3>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            {{-- @if (auth()->user()->hasRole('admin')) --}}
                                            @php
                                                $ok = \App\Models\Derivation::where('parent_id', $data->id)->where('entrada_id', $data->id)->where('via', 0)
                                                        ->where('deleted_at', null)
                                                        ->where('derivation', 0)
                                                        ->where('ok', 'NO')->first();
                                            @endphp
                                            @if ($ok)
                                                @if ($ok->visto == null || auth()->user()->hasRole('admin'))
                                                <div class="dropdown">
                                                    <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Opciones
                                                    <span class="caret"></span></button>
                                                    <ul class="dropdown-menu pull-right">
                                                        
                                                                <li>
                                                                    <a href="#" data-toggle="modal" data-target="#modal-anular_derivaciones" class="btn-anular"><span class="voyager-trash"> Eliminar Derivación</a>
                                                                </li>
                                                            
                                                    </ul>
                                                </div>
                                                @endif
                                            @endif
                                            {{-- @endif --}}
                                        </div>
                                    </div>
                                </div>
                                @if ($data->derivaciones->count() > 0)
                                @php
                                    $derivColeccion = $data->derivaciones->whereNull('deleted_at');
                                    $childrenMap = $derivColeccion
                                        ->filter(fn($d) => $d->parent_type === 'App\Models\Derivation' && $d->parent_id)
                                        ->groupBy('parent_id');
                                    $idsDeriv = $derivColeccion->pluck('id');
                                    $raices = $derivColeccion->filter(function($d) use ($data, $idsDeriv) {
                                        if ($d->parent_type === 'App\Models\Entrada') return true;
                                        if (!$d->parent_id || $d->parent_id == $data->id && $d->parent_type !== 'App\Models\Derivation') return true;
                                        // huérfanas: el padre fue anulado, mostrarlas como raíz para no perderlas
                                        return $d->parent_type === 'App\Models\Derivation' && !$idsDeriv->contains($d->parent_id);
                                    });
                                @endphp
                                <div class="panel-body deriv-tree-wrapper" style="padding-top:0;">
                                    <div class="deriv-tree">
                                        <ul>
                                            <li>
                                                <div class="deriv-node deriv-node-origen">
                                                    <span class="deriv-badge-origen"><i class="voyager-mail"></i> Origen</span>
                                                    <strong class="deriv-node-nombre">{{ $data->tipo.'-'.$data->gestion.'-'.$data->id }}</strong>
                                                    <small class="deriv-node-unidad">Recepción de la hoja de ruta</small>
                                                    <div class="deriv-node-meta">
                                                        <span class="deriv-node-fecha" title="{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}">
                                                            {{ date('d/m/Y H:i', strtotime($data->created_at)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                @if ($raices->count() > 0)
                                                    <ul>
                                                        @foreach ($raices as $raiz)
                                                            @include('entradas.partials.derivation-node', ['node' => $raiz, 'childrenMap' => $childrenMap])
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="deriv-tree-leyenda text-center">
                                        <span><span class="deriv-dot deriv-dot-actual"></span> Ubicación actual</span>
                                        <span><span class="deriv-dot deriv-dot-via"></span> Vía</span>
                                        <span><span class="deriv-dot deriv-dot-rechazo"></span> Devuelto</span>
                                        <span><span class="deriv-dot deriv-dot-archivado"></span> Archivado</span>
                                    </div>
                                </div>
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
                                                <th>Acciones</th>
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
                                                            <i class="fa-solid fa-eye" style="color: rgb(9,132,41)" data-toggle="tooltip" title="Derivación abierta"></i>
                                                        @else
                                                            <i class="fa-solid fa-eye-slash" data-toggle="tooltip" title="Derivación no abierta"></i>
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
                                                    <td class="no-sort no-click bread-actions text-right">
                                                        @php
                                                            $ok = \App\Models\Derivation::where('parent_id', $item->id)->get();
                                                        @endphp
                                                        @if(0 == count($ok) && $item->via == 0 && $item->entrada_id != $item->parent_id && auth()->user()->hasRole('admin'))
                                                            <button type="button" data-toggle="modal" data-target="#anular_modal" data-id="{{ $item->id }}" class="btn btn-danger btn-sm btn-anular">
                                                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Anular</span>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php
                                                    $cont++;
                                                @endphp
                                            @empty
                                                <tr>
                                                    <td colspan="8"><h5 class="text-center">No se han realizado derivaciones</h5></td>
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

        {{-- Modal para eliminar las derivacion --}}
        <div class="modal modal-danger fade" tabindex="-1" id="anular_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-trash"></i> Desea anular la siguiente derivación?</h4>
                    </div>
                    <div class="modal-footer">
                        <form class="form-submit" id="anulacion_form" action="{{ route('delete.derivacion') }}" method="POST">
                            @csrf
                            <input type="hidden" name="entrada_id" value="{{ $data->id }}">
                            <input type="hidden" name="id">
                            <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, anular">
                        </form>
                        <button type="button" class="btn btn-default pull-right btn-submit" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal eliminar todas las derivaciones --}}
        <div class="modal modal-danger fade" tabindex="-1" id="modal-anular_derivaciones" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-trash"></i> Desea anular la siguiente derivación?</h4>
                    </div>
                    <div class="modal-footer">
                        <p></p>
                        <form class="form-submit" action="{{ route('delete.derivacions') }}" method="POST">
                            @csrf
                            <input type="hidden" name="entrada_id" value="{{ $data->id }}">

                            <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, anular">
                        </form>
                        <button type="button" class="btn btn-default pull-right btn-submit" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.modal-dropzone', ['title' => 'Agregar archivo', 'id' => $data->id, 'action' => url('admin/entradas/store/file')])

        {{-- delete file modal --}}
        <div class="modal modal-danger fade" tabindex="-1" id="delete-file-modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-trash"></i> Desea eliminar el archivo?</h4>
                    </div>
                    <div class="modal-footer">
                        <p></p>
                        <form id="delete_file_form" action="{{ route('delete.derivacion.file') }}" method="POST">
                            @csrf
                            <input type="hidden" name="entrada_id" value="{{ $data->id }}">
                            <input type="hidden" name="id">
                            <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, eliminar">
                        </form>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Personas modal --}}
        @include('partials.modal-derivar')

        {{-- Personas modal --}}
        @include('partials.modal-agregar-vias', ['id' => $data->id])
        {{-- delete via modal --}}
        @include('partials.modal-delete-via')

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
                            <input type="hidden" name="derivacion_id" value="{{ $data->id }}">
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
        {{-- Modal msj WhatsApp --}}
        {{-- {{ route('send.whatsapp') }} --}}
        <form action="{{ route('send.whatsapp') }}" id="form-submit-message" method="post">
            @csrf
            <div class="modal fade" tabindex="-1" id="send-message-modal" role="dialog">
                <div class="modal-dialog modal-success">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-paper-plane"></i> Enviar mensaje de información</h4>
                        </div>
                        <div class="modal-body">
                            @php
                                $lastDerivation = $data->derivaciones->last();
                            @endphp
                            <div class="form-group">
                                @if ($lastDerivation)
                                <label class="radio-inline"><input type="radio" name="radio_messaje" value="Su tramite: {{ $data->referencia }}. Se encuentra en {{$lastDerivation->funcionario_direccion_para}}." checked>Mensaje 1</label>
                                @endif
                                
                                <label class="radio-inline"><input type="radio" name="radio_messaje" value="Estimad@ {{ $data->remitente ? strtoupper($data->remitente) : 'usuario' }}, su tramite {{ $data->referencia }} tiene una observación.">Mensaje 2</label>
                                <label class="radio-inline"><input type="radio" name="radio_messaje" value="Su tramite: {{ $data->referencia }} Se encuentra observado">Mensaje 3</label>
                            </div>
                            <div class="form-group">
                                <textarea id="textarea-message" name="message" class="form-control" rows="5"></textarea>
                            </div>
                            <input type="hidden" name="phone" id="input-phone-number">
                            <input type="hidden" name="user_id" id="input-user-id" value="{{ $user_entrada ? $user_entrada->id: null }}">
                            <input type="hidden" name="entrada_id" id="input-entrada-id" value="{{ $data->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btn-submit-message" class="btn btn-success"> 
                                
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
            .bread-actions .btn{
                margin: 5px 0px;
                padding: 5px 10px;
                font-size: 12px;
                text-decoration: none
            }
            .upload-respaldo{
                background: #fffaf0;
                border: 1px solid #f0ad4e;
                border-left: 5px solid #f0ad4e;
                border-radius: 4px;
                padding: 20px;
                margin: 10px 15px 15px;
            }
            .upload-respaldo-header{
                display: flex;
                align-items: flex-start;
                margin-bottom: 15px;
            }
            .upload-respaldo-icon{
                flex-shrink: 0;
                width: 44px;
                height: 44px;
                border-radius: 50%;
                background: #f0ad4e;
                color: #fff;
                font-size: 22px;
                line-height: 44px;
                text-align: center;
                margin-right: 15px;
            }
            .upload-respaldo-text h4{
                margin: 0 0 5px;
                font-weight: 600;
                color: #8a6d3b;
            }
            .upload-respaldo-text p{
                margin: 0;
                color: #8a6d3b;
            }
            .upload-dropzone{
                display: block;
                border: 2px dashed #f0ad4e;
                border-radius: 4px;
                background: #fff;
                padding: 25px 15px;
                text-align: center;
                color: #8a6d3b;
                cursor: pointer;
                font-weight: normal;
                margin-bottom: 10px;
                transition: background .15s, border-color .15s;
            }
            .upload-dropzone:hover,
            .upload-dropzone.dragover{
                background: #fdf3e3;
                border-color: #ec971f;
            }
            .upload-dropzone i{
                display: block;
                font-size: 28px;
                margin-bottom: 5px;
            }
            .upload-dropzone input[type="file"]{
                display: none;
            }
            .upload-file-list{
                list-style: none;
                padding: 0;
                margin: 0 0 10px;
            }
            .upload-file-list li{
                display: flex;
                align-items: center;
                background: #fff;
                border: 1px solid #eee;
                border-radius: 4px;
                padding: 8px 12px;
                margin-bottom: 5px;
            }
            .upload-file-list li i{
                color: #f0ad4e;
                margin-right: 10px;
                font-size: 16px;
            }
            .upload-file-list li span{
                flex: 1;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .upload-file-list li small{
                color: #999;
                margin-left: 10px;
            }
            /* Árbol de derivaciones */
            .deriv-tree-wrapper{
                overflow-x: auto;
            }
            .deriv-tree ul{
                display: flex;
                justify-content: center;
                padding: 20px 0 0;
                margin: 0;
                position: relative;
                list-style: none;
            }
            .deriv-tree > ul{
                padding-top: 16px;
            }
            .deriv-tree li{
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 20px 8px 0;
                position: relative;
            }
            .deriv-tree > ul > li{
                padding-top: 0;
            }
            /* conectores */
            .deriv-tree li::before,
            .deriv-tree li::after{
                content: '';
                position: absolute;
                top: 0;
                right: 50%;
                width: 50%;
                height: 20px;
                border-top: 2px solid #c8c8c8;
            }
            .deriv-tree li::after{
                right: auto;
                left: 50%;
                border-left: 2px solid #c8c8c8;
            }
            .deriv-tree li:only-child::before,
            .deriv-tree li:only-child::after{
                border-top: 0;
            }
            .deriv-tree li:only-child::after{
                border-left: 2px solid #c8c8c8;
            }
            .deriv-tree li:first-child::before,
            .deriv-tree li:last-child::after{
                border-top: 0;
            }
            .deriv-tree li:last-child::before{
                border-right: 2px solid #c8c8c8;
                border-radius: 0 5px 0 0;
            }
            .deriv-tree li:first-child::after{
                border-radius: 5px 0 0 0;
            }
            .deriv-tree > ul > li::before,
            .deriv-tree > ul > li::after{
                display: none;
            }
            .deriv-tree ul ul::before{
                content: '';
                position: absolute;
                top: 0;
                left: 50%;
                width: 0;
                height: 20px;
                border-left: 2px solid #c8c8c8;
            }
            /* nodos */
            .deriv-node{
                position: relative;
                background: #fff;
                border: 1px solid #d5d5d5;
                border-top: 3px solid #2a9f68;
                border-radius: 4px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.12);
                padding: 10px 14px;
                min-width: 190px;
                max-width: 230px;
                text-align: center;
            }
            .deriv-node-nombre{
                display: block;
                font-size: 12px;
                line-height: 1.3;
            }
            .deriv-node-cargo,
            .deriv-node-unidad{
                display: block;
                color: #777;
                font-size: 11px;
                line-height: 1.3;
                margin-top: 2px;
            }
            .deriv-node-meta{
                margin-top: 6px;
                font-size: 11px;
                color: #999;
            }
            .deriv-node-meta .label{
                font-size: 10px;
                margin: 0 2px;
            }
            .deriv-node-fecha{
                display: block;
                margin-bottom: 3px;
            }
            .deriv-node-origen{
                border-top-color: #555;
                background: #f7f7f7;
            }
            .deriv-node-via{
                border-top-color: #999;
                background: #f2f2f2;
            }
            .deriv-node-rechazo{
                border-top-color: #c0392b;
                background: #fdf3f2;
            }
            .deriv-node-archivado{
                border-top-color: #337ab7;
                background: #f2f7fb;
            }
            .deriv-node-actual{
                border-color: #2a9f68;
                border-top-width: 3px;
                box-shadow: 0 0 0 3px rgba(42,159,104,0.25);
            }
            .deriv-badge-actual,
            .deriv-badge-origen{
                position: absolute;
                top: -12px;
                left: 50%;
                transform: translateX(-50%);
                background: #2a9f68;
                color: #fff;
                font-size: 10px;
                font-weight: 600;
                padding: 2px 8px;
                border-radius: 10px;
                white-space: nowrap;
            }
            .deriv-badge-origen{
                background: #555;
            }
            /* leyenda */
            .deriv-tree-leyenda{
                margin-top: 15px;
                font-size: 11px;
                color: #777;
            }
            .deriv-tree-leyenda > span{
                margin: 0 8px;
            }
            .deriv-dot{
                display: inline-block;
                width: 10px;
                height: 10px;
                border-radius: 50%;
                vertical-align: middle;
                margin-right: 4px;
            }
            .deriv-dot-actual{ background: #2a9f68; }
            .deriv-dot-via{ background: #999; }
            .deriv-dot-rechazo{ background: #c0392b; }
            .deriv-dot-archivado{ background: #337ab7; }
        </style>
    @endsection
        
    @section('javascript')
        <script>
            var destinatario_id = 0;
            var intern_externo = 1;
            $(document).ready(function () {

                $('.btn-anular').click(function(){
                    let id = $(this).data('id');
                    $('#anulacion_form input[name="id"]').val(id);
                });
                $('.btn-delete-file').click(function(){
                    let id = $(this).data('id');
                    $('#delete_file_form input[name="id"]').val(id);
                });
                $('.btn-delete-via').click(function(){
                    let id = $(this).data('id');
                    let entrada_id = $(this).data('entrada_id');
                    $('#delete_via_form input[name="id"]').val(id);
                    $('#delete_via_form input[name="entrada_id"]').val(entrada_id);
                });
            });

            function derivacionItem(id, destinoid = 0){
                $('#form-derivacion input[name="id"]').val(id);
                destinatario_id = destinoid;
            }

            (function(){
                var $input = $('#input-archivos-nci');
                if (!$input.length) return;
                var $list = $('#upload-file-list');
                var $btn = $('#btn-subir-archivos');
                var $zone = $('.upload-dropzone');

                function formatSize(bytes){
                    if (bytes >= 1048576) return (bytes / 1048576).toFixed(1) + ' MB';
                    if (bytes >= 1024) return (bytes / 1024).toFixed(1) + ' KB';
                    return bytes + ' B';
                }

                function render(){
                    var files = $input[0].files;
                    $list.empty();
                    for (var i = 0; i < files.length; i++) {
                        var icon = files[i].type === 'application/pdf' ? 'voyager-file-text' : 'voyager-photos';
                        $list.append(
                            $('<li>').append(
                                $('<i>').addClass(icon),
                                $('<span>').text(files[i].name),
                                $('<small>').text(formatSize(files[i].size))
                            )
                        );
                    }
                    $btn.prop('disabled', files.length === 0);
                }

                $input.on('change', render);

                $zone.on('dragover dragenter', function(e){
                    e.preventDefault();
                    $zone.addClass('dragover');
                }).on('dragleave dragend', function(e){
                    e.preventDefault();
                    $zone.removeClass('dragover');
                }).on('drop', function(e){
                    e.preventDefault();
                    $zone.removeClass('dragover');
                    var dt = e.originalEvent.dataTransfer;
                    if (dt && dt.files.length) {
                        $input[0].files = dt.files;
                        render();
                    }
                });
            })();
        </script>
        <script>
        $('.btn-send-message').click(function(){
            $('#input-phone-number').val($(this).data('phone'));
            $('#textarea-message').val($('#form-submit-message input[name="radio_messaje"]:checked').val());
        });

        $('#form-submit-message input[name="radio_messaje"]').click(function(){
            $('#textarea-message').val($('#form-submit-message input[name="radio_messaje"]:checked').val());
        });

        $('#form-submit-message').submit(function(e){
            $('#btn-submit-message').attr('disabled', 'disabled');
            e.preventDefault();
            $.post($('#form-submit-message').attr('action'), $('#form-submit-message').serialize(), function(res){
                $('#btn-submit-message').removeAttr('disabled');
                if (res.success) {
                    $('#send-message-modal').modal('hide');
                    toastr.success('Mensaje enviado');
                } else {
                    toastr.error('Ocurrió un error');
                }
            })
        });
        </script>
    @stop
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif
