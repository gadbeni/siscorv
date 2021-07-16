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
                                            <th>Subido por</th>
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
                                                <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br><small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
                                                <td><a href="{{ url('storage/'.$item->ruta) }}" class="btn btn-sm btn-info" target="_blank"> <i class="voyager-eye"></i> Ver</a></td>
                                                <td>{{ $item->user->name }}</td>
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
                                            <th>Fecha de recepción</th>
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
                                                <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
                                                <td>
                                                    @if ($cont == count($data->derivaciones))
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
                            <hr style="margin:0;">
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

    @include('partials.modal-dropzone', ['title' => 'Agregar archivo', 'id' => $data->id, 'action' => url('admin/entradas/store/file')])
@stop

@section('css')

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {

            $('.btn-anular').click(function(){
                let id = $(this).data('id');
                $('#anulacion_form input[name="id"]').val(id);
            });
            $('.btn-delete-file').click(function(){
                let id = $(this).data('id');
                $('#delete_file_form input[name="id"]').val(id);
            });
        });
    </script>
@stop
