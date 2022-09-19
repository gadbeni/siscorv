@extends('voyager::master')

@section('page_title', 'Ver Ingresos')

@if(auth()->user()->hasPermission('read_entradas'))

    @section('page_header')
        <div class="col-md-6 col-xs-6" style="margin-top: 20px;">
            <a href="{{ route('entradas.index') }}" class="btn btn-default"><i class="voyager-angle-left"></i> Volver</a>
        </div>
        <div class="col-md-6 col-xs-6 text-right" style="margin-top: 20px;">
            @if($data->derivaciones->count() > 0)
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
                </div>
            @endif
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12" style="margin-bottom: 20px">
            <h3 class="text-muted" style="padding-left: 10px">{{ $data->referencia }}</h3>
        </div>
    @stop

    @section('content')
        <div class="page-content read container-fluid div-phone">
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
                                    <p>{{ $data->cite ?? '' }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Número de hojas</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $data->nro_hojas ?? 'No definida' }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Origen</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    @if ($data->tipo == 'E')
                                    <p>{{ $data->entity->nombre ?? 'Sin Origen' }}</p>
                                    @else
                                        No definido
                                    @endif
                                    
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Remitente</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $data->remitente ? strtoupper($data->remitente) : '' }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            @if ($data->tipo == 'I')
                            <div class="col-md-12">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Destino</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>
                                        {{ $data->person ? $data->person->first_name.' '.$data->person->last_name : '' }}
                                    </p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            @endif
                            {{-- <div class="col-md-12">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Referencia</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $data->referencia ? strtoupper($data->referencia) : 'NN' }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div> --}}
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
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>N&deg;</th>
                                                    <th>Título</th>
                                                    <th>Adjuntado por</th>
                                                    <th>Fecha de registro</th>
                                                    <th>Archivo</th>
                                                    <th>Acciones</th>
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
                                                        <td>{{ $item->user->name ?? '' }}</td>
                                                        <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br><small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
                                                        <td><a href="{{ url('storage/'.$item->ruta) }}" class="btn btn-sm btn-info" target="_blank"> <i class="voyager-eye"></i> Ver</a></td>
                                                        <td><button type="button" data-toggle="modal" data-target="#delete-file-modal" data-id="{{ $item->id }}" class="btn btn-danger btn-sm btn-delete-file"><span class="voyager-trash"></span></button></td>
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
                    @if($data->tipo == 'I')
                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h3 class="panel-title">Vias</h3>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <button 
                                                type="button" 
                                                data-toggle="modal" 
                                                data-target="#modal-derivar" 
                                                title="Nuevo" class="btn btn-success"
                                                style="margin: 15px;">
                                                <i class="voyager-list-add"></i> 
                                                Nuevo
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
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
                                                            <button type="button" 
                                                            data-toggle="modal" 
                                                            data-target="#delete-via-modal" 
                                                            data-id="{{ $item->id }}" 
                                                            data-entrada_id="{{ $data->id }}"
                                                            class="btn btn-danger btn-sm btn-delete-via">
                                                                <span class="voyager-trash"></span>
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
                                    <h3 class="panel-title">Historial de derivaciones</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <div class="table-responsive">
                                        <table class="table table-bordered-table-hover">
                                            <thead>
                                                <tr>
                                                    <th>N&deg;</th>
                                                    <th>Dirección</th>
                                                    <th>Unidad</th>
                                                    <th>Funcionario</th>
                                                    <th>Observaciones</th>
                                                    <th>Fecha de derivación</th>
                                                    {{-- <th>Fecha de recepción</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $cont = 1;
                                                @endphp
                                                @forelse ($data->derivaciones as $item)
                                                    <tr @if ($item->rechazo) style="background-color: rgba(192,57,43,0.3)" @endif>
                                                        <td>{{ $cont }}</td>
                                                        <td>{{ $item->funcionario_direccion_para }}</td>
                                                        <td>{{ $item->funcionario_unidad_para }}</td>
                                                        <td>{{ $item->funcionario_nombre_para }} <br> <small>{{ $item->funcionario_cargo_para }}</small> </td>
                                                        <td>{{ $item->observacion }}</td>
                                                        <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
                                                        <td>
                                                            {{-- @if ($cont == count($data->derivaciones)) --}}
                                                            {{-- @if (auth()->user()->hasRole('admin'))
                                                                <button type="button" data-toggle="modal" data-target="#anular_modal" data-id="{{ $item->id }}" class="btn btn-danger btn-sm btn-anular"><span class="voyager-trash"></span></button>
                                                            @endif --}}
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
    <style>
        .select2-container {
            width: 100% !important;
        }
        /* CSS to style Treeview menu  */
        ol.tree {
                    padding: 0 0 0 30px;
                    /* width: 500px; */
            }
            .li { 
                    position: relative; 
                    margin-left: -15px;
                    list-style: none;
            }      
            .li input {
                    position: absolute;
                    left: 0;
                    margin-left: 0;
                    opacity: 0;
                    z-index: 2;
                    cursor: pointer;
                    height: 1em;
                    width: 1em;
                    top: 0;
            }
            .li input + ol {
                    background: url({{asset("/images/treeview/toggle-small-expand.png")}}) 40px 0 no-repeat;
                    margin: -1.600em 0px 8px -44px; 
                    height: 1em;
            }
            .li input + ol > .li { 
                    display: none; 
                    margin-left: -14px !important; 
                    padding-left: 1px; 
            }
            .li label {
                    background: url({{asset("/images/treeview/default.png")}}) 15px 1px no-repeat;
                    cursor: pointer;
                    display: block;
                    padding-left: 37px;
            }
            .li input:checked + ol {
                    background: url({{asset("images/treeview/toggle-small.png")}}) 40px 5px no-repeat;
                    margin: -1.96em 0 0 -44px; 
                    padding: 1.563em 0 0 80px;
                    height: auto;
            }
            .li input:checked + ol > .li { 
                    display: block; 
                    margin: 8px 0px 0px 0.125em;
            }
            .li input:checked + ol > .li:last-child { 
                    margin: 8px 0 0.063em;
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
                $('.btn-showinfo').click(function(){
                    let id = $(this).data('id');
                    let unidad_para = $(this).data('unidad_para');
                    let direccion_para = $(this).data('direccion_para');
                    let observacion = $(this).data('observacion');
                    $('#info_form input[name="id"]').val(id);
                    $('#info_form input[name="direccion_para"]').val(direccion_para);
                    $('#info_form input[name="unidad_para"]').val(unidad_para);
                    $('#info_form textarea[name="observacion"]').val(observacion);
                });
            });
        </script>
    @stop

@else
    @section('content')
        @include('errors.403')
    @stop
@endif
