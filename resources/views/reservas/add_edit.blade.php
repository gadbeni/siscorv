@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', 'Añadir Reserva')

@if(auth()->user()->hasPermission('add_reservas') || auth()->user()->hasPermission('edit_reservas'))

    @section('page_header')
        <h1 class="page-title">
            <i class="voyager-credit-cards"></i>
            Añadir Reserva
        </h1>
    @stop

    @section('content')
        <div class="page-content edit-add container-fluid">
            <div class="row">
                <div class="col-md-12 div-phone">
                    <form 
                        action="{{ ! $reserva->id ? route('reservas.store') : route('reservas.update',$reserva->id) }}" 
                        method="POST" 
                        enctype="multipart/form-data"
                    >
                        @if($reserva->id)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Sucursal</label>
                                        <select name="warehouse_id" class="form-control select2" id="select-sucursal" required>
                                        <option value="" selected>Seleccione el tipo</option>
                                            @foreach (\App\Models\Warehouse::get() as $item)
                                            <option {{(int)old('warehouse_id') === $item->id ||$reserva->warehouse_id === $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->name }}</option> 
                                            @endforeach 
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Nombre</label>
                                        <input type="text" name="nombre" maxlength="50" class="form-control" value="{{old('nombre') ? : $reserva->nombre}}" required>
                                    </div>
                                    <div id="div_municipio" class="form-group col-md-5">
                                        <label class="control-label">Municipio</label>
                                        <select name="municipio_id" class="form-control select2" id="select-category" required>
                                            <option value="" selected>Seleccione el municipio</option>
                                            @foreach (\App\Models\Municipio::with('provincia')->get() as $item)
                                            <option {{(int)old('municipio_id') === $item->id ||$reserva->municipio_id === $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ ($item->provincia->count() > 0) ? substr($item->provincia->nombre,0,4).' -' : '' }} {{ $item->nombre }}</option> 
                                            @endforeach                                        
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">Localidad</label>
                                        <input type="text" name="localidad" class="form-control" value="{{old('localidad') ? : $reserva->localidad}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Nombre Solicitante</label>
                                        <input type="text" name="solicitante" class="form-control" value="{{old('solicitante') ? : $reserva->solicitante}}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Nro. de Rec Oficial</label>
                                        <input type="text" name="numero_recibo" class="form-control" required value="{{old('numero_recibo') ? : $reserva->numero_recibo}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Costo Reserva</label>
                                        <input type="text" name="costo_reserva" class="form-control" required value="{{old('costo_reserva') ? : $reserva->costo_reserva}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Fecha(Inicio Trámite)</label>
                                        @php 
                                        $fechaentrada = $reserva->fecha_inicio ? $reserva->fecha_inicio->format('Y-m-d') : '';
                                        @endphp
                                        <input type="date" name="fecha_inicio" class="form-control"  value="{{old('fecha_inicio') ? : $fechaentrada}}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }} <i class="voyager-check"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @stop

    @section('javascript')
        <script>
            $(document).ready(function(){
                ruta = "{{ route('certificados.getFuncionario') }}";
                $("#select-funcionario_id_destino").select2({
                    ajax: { 
                        allowClear: true,
                        url: ruta,
                        type: "get",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term // search term
                            };
                        },
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        }
                    }
                });

                var additionalConfig = {
                    selector: 'textarea.richTextBox[name="detalle"]',
                }
                tinymce.init(window.voyagerTinyMCE.getConfig(additionalConfig));
            });
        </script>
    @stop
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif