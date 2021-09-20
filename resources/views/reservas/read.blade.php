@extends('voyager::master')

@section('page_title', 'Ver Reservas')

@if(auth()->user()->hasPermission('read_reservas'))

    @section('page_header')
        <div class="col-md-6" style="margin: 20px 0px;">
            <a href="{{ route('reservas.index') }}" class="btn btn-default"><i class="voyager-angle-left"></i> Volver</a>
            <h3 class="text-muted" style="padding-left: 20px">{{ $reserva->nombre }}</h3>
        </div>
        <div class="col-md-6 text-right" style="margin-top: 40px;">
            <div class="btn-group" role="group" aria-label="...">
                    <button type="button" data-toggle="modal" data-target="#modal-rechazar" title="Anular" class="btn btn-default"><i class="voyager-warning"></i> Anular</button>
                {{-- <button type="button" title="Anterio" class="btn btn-default"><i class="voyager-angle-left"></i> &nbsp;</button>
                <button type="button" title="Siguiente" class="btn btn-default"><i class="voyager-angle-right"></i> &nbsp;</button> --}}
            </div>
        </div>
    @stop

    @section('content')
        <div class="page-content read container-fluid div-phone">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Provincia - Municipio</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $reserva->municipio->provincia->nombre }} - {{ $reserva->municipio->nombre }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-2">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">N° Recibo</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $reserva->numero_recibo }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-3">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Costo Reserva</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $reserva->costo_reserva }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-3">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Estado</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $reserva->estado->key }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Nombre Reserva</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $reserva->nombre }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Solicitante</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $reserva->nombre_solicitante }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Fecha de Inicio Trámite</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $reserva->fecha_inicio }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Fecha Conclusion Trámite</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ $reserva->fecha_conclusion ?? 'No a concluido este tramite' }}</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h3 class="panel-title">Fecha de Registro</h3>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p>{{ date('d/m/Y H:i:s', strtotime($reserva->created_at)) }} <small>{{ \Carbon\Carbon::parse($reserva->created_at)->diffForHumans() }}</small></p>
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
                                                <th>Adjuntado por</th>
                                                <th>Fecha de registro</th>
                                                <th>Archivo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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

        @include('partials.modal-dropzone', ['title' => 'Agregar archivo', 'id' => $reserva->id, 'action' => url('admin/entradas/store/file')])

        {{-- rechazar modal --}}
        <form action="{{ route('bandeja.archivar', ['id' => $reserva->id]) }}" method="post">
            <div class="modal modal-success fade" tabindex="-1" id="modal-archivar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="voyager-categories"></i> Archivar correspondencia</h4>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" value="{{ $reserva->id }}">
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Archivar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- rechazar modal --}}
        <form action="{{ route('reservas.nulled', ['id' => $reserva->id]) }}" method="post">
            <div class="modal modal-danger fade" tabindex="-1" id="modal-rechazar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="voyager-warning"></i> Anular Reserva</h4>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" value="{{ $reserva->id }}">
                            <div class="form-group">
                                <label>Motivo</label>
                                <textarea name="observacion" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Aceptar</button>
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
                // $('#select-destinatario').select2({ dropdownParent: "#derivar-modal" });
            });
        </script>
    @stop
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif
