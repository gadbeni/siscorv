@extends('voyager::master')

@section('page_title', 'Lista de mensajes enviados')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title">
                    <i class="fa fa-paper-plane"></i> Mensajes enviados para la entrada {{ $entrada->cite }}
                </h1>
                <div class="panel">
                    <div class="panel-body">
                        <div class="panel-body table-responsive" style="padding-top:0;">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>N&deg;</th>
                                        <th>Persona</th>
                                        <th>Numero</th>
                                        <th>Mensaje</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mensajes as $mensaje)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $mensaje->nombre_persona }}</td>
                                            <td>{{ $mensaje->phone }}</td>
                                            <td>{{ $mensaje->message }}</td>
                                            <td>Enviado el {{ \Carbon\Carbon::parse($mensaje->fecha_envio)->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6"><h5 class="text-center">No hay mensajes enviado</h5></td>
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
@endsection