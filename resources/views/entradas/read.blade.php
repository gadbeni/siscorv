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
                                        <div class="alert alert-warning">
                                            <h3>Advertencia</h3>
                                            <p>Debe agregar el documento de respaldo</p>
                                            <input type="hidden" name="id" value="{{$data->id}}" class="form-control">
                                            <div class="form-group">
                                                <input type="file" name="archivos[]" multiple class="form-control" accept="image/jpeg,image/jpg,image/png,application/pdf" required>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-danger btn-submit">Subir Archivos</button>
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
                                    {{ $data->remitente ? strtoupper($data->remitente) : '' }}
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
                                                        <a href="{{ url('storage/'.$item->ruta) }}" class="btn btn-warning" target="_blank">
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
                            <input type="hidden" name="user_id" id="input-user-id" value="{{$user_entrada->id}}">
                            <input type="hidden" name="entrada_id" id="input-entrada-id" value="{{ $data->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btn-submit-message" class="btn btn-success"> <i class="fa fa-paper-plane"></i> Enviar</button>
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
