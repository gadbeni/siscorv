@extends('voyager::master')

@section('page_title', 'Ver Ingresos')

@if(auth()->user()->hasPermission('read_entradas'))

    @section('page_header')
        <div class="col-md-6 col-xs-6" style="margin-top: 20px;">
            <a href="{{ route('entradas.index') }}" class="btn btn-default"><i class="voyager-angle-left"></i> Volver</a>
        </div>
        <div class="col-md-6 col-xs-6 text-right" style="margin-top: 20px;">
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
                    @if (count($nci)>0)
                        <button data-toggle="modal" data-target="#modal-derivar" onclick="derivacionItem({{ $data->id }}, {{ $data->people_id_para }})" title="Derivar" class="btn btn-sm btn-dark view" style="border: 0px">
                            <i class="voyager-forward"></i> <span class="hidden-xs hidden-sm">Derivar</span>
                        </button>
                    @endif
                @endif
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <h3 class="text-muted page-title" style="padding-left: 10px">{{ $data->referencia }}</h3>
        </div>
    @stop

    @section('content')
        <div class="page-content read container-fluid div-phone">
            <div class="row">
                <div class="col-md-12">
                    @if (count($nci)==0)     
                        <form action="{{route('entradas-file-nci.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="alert" style="background-color: #F5C02A;">
                                <strong>Advertencia:</strong>
                                <p>Carge su documento de respaldo..</p>
                                <input type="hidden" name="id" value="{{$data->id}}" class="form-control">
                                <input type="file" name="archivos[]" multiple class="form-control" accept="image/jpeg,image/jpg,image/png,application/pdf" required>
                                <button type="submit" class="btn btn-success">Subir Archivos</button>

                            </div>

                        </form>
                    @endif
                    <div class="panel panel-bordered">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <label class="panel-title">Hoja de Ruta</label>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <small>{{ $data->tipo.'-'.$data->gestion.'-'.$data->id }}</small>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-3">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <label class="panel-title">Fecha de Ingreso</label>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <small>{{ date('d/m/Y H:i:s', strtotime($data->created_at)) }} {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</small>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-3">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <label class="panel-title">Número de Cite</label>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <small>{{ $data->cite ?? '' }}</small>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-3">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <label class="panel-title">Número de hojas</label>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <small>{{ $data->nro_hojas ?? 'No definida' }}</small>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            @if ($data->tipo == 'E')
                                <div class="col-md-6">
                                    <div class="panel-heading" style="border-bottom:0;">
                                        <label class="panel-title">Origen</label>
                                    </div>
                                    <div class="panel-body" style="padding-top:0;">
                                        <small>{{ $data->entity->nombre ?? 'Sin Origen' }}</small>                                    
                                    </div>
                                    <hr style="margin:0;">
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <label class="panel-title">Remitente</label>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <small>{{ $data->remitente ? strtoupper($data->remitente) : '' }}</small>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <label class="panel-title">Destino</label>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <small>
                                        {{ $data->person ? $data->person->first_name.' '.$data->person->last_name : '' }}
                                    </small>
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
                                            <label class="panel-title">Archivos</label>
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
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>N&deg;</th>
                                                    <th style="text-align: center">Título</th>
                                                    <th style="text-align: center">Adjuntado por</th>
                                                    <th style="text-align: center">Fecha de registro</th>
                                                    <th width="150px" style="text-align: center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $cont = 1;
                                                @endphp
                                                @forelse ($data->archivos as $item)
                                                    <tr>
                                                        <td width="5px">{{ $cont }}</td>
                                                        <td style="text-align: center">
                                                            {{ $item->nombre_origen }}
                                                        </td>
                                                        <td style="text-align: center">{{ $item->user->name ?? '' }}</td>
                                                        <td style="text-align: center">{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br><small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
                                                        <td style="text-align: right">
                                                            <a href="{{ url('storage/'.$item->ruta) }}" class="btn btn-sm btn-info" target="_blank"> <i class="voyager-eye"></i> Ver</a>
                                                            <button type="button" data-toggle="modal" data-target="#delete-file-modal" data-id="{{ $item->id }}" class="btn btn-danger btn-sm btn-delete-file"><span class="voyager-trash"></span></button>
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
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($data->personeria)    
                        @php
                            $name = \App\Models\PjNameReservation::where('entrada_id', $data->id)->where('deleted_at', null)->first();
                            $fileName = \App\Models\PjNameFile::where('nameReservation_id', $name->id)
                                                    ->where('deleted_at', null)->first();
                        @endphp                    
                        <div class="panel panel-bordered" style="padding-bottom:5px;">
                            <label class="panel-title">Personería Jurídica</label>
                                
                           
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="panel-heading" style="border-bottom:0;">
                                        <label class="panel-title">Nombre Personería Jurídica</label>
                                    </div>
                                    <div class="panel-body" style="padding-top:0;">
                                        <small>{{$name->name }}</small>
                                    </div>
                                    <hr style="margin:0;">
                                </div>
                                <div class="col-md-4">
                                    <div class="panel-heading" style="border-bottom:0;">
                                        <label class="panel-title">Solicitante</label>
                                    </div>
                                    <div class="panel-body" style="padding-top:0;">
                                        <small>{{$name->applicant }}</small>
                                    </div>
                                    <hr style="margin:0;">
                                </div>
                                <div class="col-md-4">
                                    <div class="panel-heading" style="border-bottom:0;">
                                        <label class="panel-title">Celular</label>
                                    </div>
                                    <div class="panel-body" style="padding-top:0;">
                                        <small>{{$name->phone }}</small>
                                    </div>
                                    <hr style="margin:0;">
                                </div>
                                <div class="col-md-12">
                                    
                                    <div class="panel-body" style="padding-top:0;">
                                        <div class="table-responsive">
                                            <table id="dataTable" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>                
                                                        <th style="text-align: center">Detalle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="height: 50px">Solicitud</td>
                                                        <td style="text-align: center">
                                                            @if (!$fileName->solicitud)
                                                                <label class="label label-danger">Sin datos</label>
                                                            @else                                                                
                                                                <a href="{{asset('../../sidepej/public/storage/'.$fileName->solicitud)}}" title="Ver" target="_blank">
                                                                    <img src="{{asset('images/icon/pdf.png')}}"  href="{{asset('../../sidepej_v2/public/storage/'.$fileName->solicitud)}}" class="zoom" style="width: 30px; height: 30px; border-radius: 30px; margin-right: 10px"/>
                                                                </a> 
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="height: 50px">Carnet de Identidad</td>
                                                          <td style="text-align: center">
                                                            @if (!$fileName->carnet)
                                                                <label class="label label-danger">Sin datos</label>
                                                            @else
                                                                <a href="{{asset('storage/'.$fileName->carnet)}}" title="Ver" target="_blank">
                                                                    <img src="{{asset('images/icon/pdf.png')}}" href="{{asset('storage/'.$fileName->carnet)}}" class="zoom" class="zoom" style="width: 30px; height: 30px; border-radius: 30px; margin-right: 10px"/>
                                                                </a> 
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="height: 50px">Deposito</td>
                                                        <td style="text-align: center">
                                                            @if (!$fileName->deposito)
                                                                <label class="label label-danger">Sin datos</label>
                                                            @else
                                                                <a href="{{asset('storage/'.$fileName->deposito)}}" title="Ver" target="_blank">
                                                                    <img src="{{asset('images/icon/pdf.png')}}" href="{{asset('storage/'.$fileName->deposito)}}" class="zoom" class="zoom" style="width: 30px; height: 30px; border-radius: 30px; margin-right: 10px"/>
                                                                </a>                                                                
                                                            @endif                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="height: 50px">Poder</td>
                                                        <td style="text-align: center">
                                                            @if (!$fileName->poder)
                                                                <label class="label label-danger">Sin datos</label>
                                                            @else
                                                                <a href="{{asset('storage/'.$fileName->poder)}}" title="Ver" target="_blank">
                                                                    <img src="{{asset('images/icon/pdf.png')}}" href="{{asset('storage/'.$fileName->poder)}}" class="zoom" class="zoom" style="width: 30px; height: 30px; border-radius: 30px; margin-right: 10px"/>
                                                                </a>                                                                
                                                            @endif                                                            
                                                        </td>
                                                    </tr>                                     
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

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
                                                        <i class="voyager-list-add"></i> 
                                                        Nuevo
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body" style="padding-top:0;">
                                        <div class="table-responsive">
                                            <table id="dataTable" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ID&deg;</th>
                                                        <th>Nombre</th>
                                                        <th>Cargo</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $cont = 1;
                                                    @endphp
                                                    @forelse ($data->vias as $item)
                                                        <tr style="text-transform: uppercase;">
                                                            <td>{{ $cont }}</td>
                                                            <td>{{ $item->nombre }}</td>
                                                            <td>{{ $item->cargo }}</td>
                                                            <td>
                                                                @if ($data->derivaciones->whereNull('deleted_at')->count() == 0)
                                                                    <button type="button" 
                                                                    data-toggle="modal" 
                                                                    data-target="#delete-via-modal" 
                                                                    data-id="{{ $item->id }}" 
                                                                    data-entrada_id="{{ $data->id }}"
                                                                    class="btn btn-danger btn-sm btn-delete-via">
                                                                        <span class="voyager-trash"></span>
                                                                    </button>
                                                                @endif
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
                                    <label class="panel-title">Historial de derivaciones</label>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <div class="table-responsive">
                                        {{-- para que el dueño del tramite pueda eliminar todas las derivacion --}}
                                        @php
                                            $ok = \App\Models\Derivation::where('parent_id', $data->id)->where('entrada_id', $data->id)->where('via', 0)
                                                    ->where('deleted_at', null)
                                                    ->where('derivation', 0)
                                                    ->where('ok', 'NO')->first();
                                        @endphp
                                        @if ($ok)
                                            @if ($ok->visto == null || auth()->user()->hasRole('admin'))
                                                <button type="button" data-toggle="modal" data-target="#modal_derivacionAnular" class="btn btn-danger btn-sm btn-anular"><span class="voyager-trash"></span> Eliminar Derivación</button>                                                
                                            @endif                                            
                                        @endif


                                        <table id="dataTable" class="table table-bordered-table-hover">
                                            <thead>
                                                <tr>
                                                    <th>N&deg;</th>
                                                    <th>Dirección</th>
                                                    <th>Unidad</th>
                                                    <th>Funcionario</th>
                                                    <th>Observaciones</th>
                                                    <th>Fecha de derivación</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $cont = 1;
                                                @endphp
                                                @forelse ($data->derivaciones as $item)
                                                    <tr  @if ($item->via) style="background-color: rgb(224,223,223)" @endif @if ($item->rechazo) style="background-color: rgba(192,57,43,0.3)" @endif>
                                                        <td>{{ $cont }}</td>
                                                        <td>{{ $item->funcionario_direccion_para }}</td>
                                                        <td>{{ $item->funcionario_unidad_para }}</td>
                                                        <td>{{ $item->funcionario_nombre_para }} <br> <small>{{ $item->funcionario_cargo_para }}</small> </td>
                                                        <td>{{ $item->observacion }}</td>
                                                        <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small><br>
                                                            @if ($item->visto)
                                                                <i class="fa-solid fa-eye" style="color: rgb(9,132,41)" data-toggle="tooltip" title="Derivación abierta"></i>
                                                            @else
                                                                <i class="fa-solid fa-eye-slash" data-toggle="tooltip" title="Derivación no abierta"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $ok = \App\Models\Derivation::where('parent_id', $item->id)->get();
                                                            @endphp
                                                            @if(0 == count($ok) && $item->via == 0 && auth()->user()->hasRole('admin') && $item->entrada_id != $item->parent_id)
                                                                <button type="button" data-toggle="modal" data-target="#anular_modal" data-id="{{ $item->id }}" class="btn btn-danger btn-sm btn-anular"><span class="voyager-trash"></span></button>
                                                            @endif
                                                        </td> 
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- anulación modal --}}
        <div class="modal modal-danger fade" tabindex="-1" id="anular_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-trash"></i> Desea anular la siguiente derivación?</h4>
                    </div>
                    <div class="modal-footer">
                        <p></p>
                        <form id="anulacion_form" action="{{ route('delete.derivacion') }}" method="POST">
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
        
        <div class="modal modal-danger fade" tabindex="-1" id="modal_derivacionAnular" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-trash"></i> Desea anular la siguiente derivación?</h4>
                    </div>
                    <div class="modal-footer">
                        <p></p>
                        <form action="{{ route('delete.derivacions') }}" method="POST">
                            @csrf
                            <input type="hidden" name="entrada_id" value="{{ $data->id }}">

                            <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, anular">
                        </form>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

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

        {{-- para derivar la correspondencia --}}
        @include('partials.modal-derivar')

        {{-- delete via modal --}}
        @include('partials.modal-delete-via')
        @include('partials.modal-dropzone', ['title' => 'Agregar archivo', 'id' => $data->id, 'action' => url('admin/entradas/store/file')])

        {{-- Personas modal --}}
        @include('partials.modal-agregar-vias', ['id' => $data->id])

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

            function derivacionItem(id,destinoid=0){
                $('#form-derivacion input[name="id"]').val(id);
                destinatario_id = destinoid;
            }
        </script>
    @stop

@else
    @section('content')
        @include('errors.403')
    @stop
@endif
