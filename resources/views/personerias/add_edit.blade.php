@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', 'Añadir Personeria')

@if(auth()->user()->hasPermission('add_reservas') || auth()->user()->hasPermission('edit_reservas'))

    @section('page_header')
        <h1 class="page-title">
            <i class="voyager-credit-cards"></i>
            Añadir Personeria
        </h1>
    @stop

    @section('content')
        <div class="page-content container-fluid">
            <div class="row">
                <form 
                    action="{{ ! $personeria->id ? route('personerias.store') : route('personerias.update',$personeria->id) }}" 
                    method="POST" 
                    enctype="multipart/form-data"
                >
                    @if($personeria->id)
                        @method('PUT')
                    @endif
                    @csrf
                    <div class="col-xs-12 col-sm-7 col-md-6 div-phone">
                        <div class="panel panel-bordered">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Datos generales
                                </h3>
                                <div class="panel-actions">
                                    <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    @if(auth()->user()->isAdmin() || auth()->user()->warehouses()->count() > 1)
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Sucursal</label>
                                        <select name="warehouse_id" class="form-control select2" id="select-sucursal" required>
                                        <option value="" selected>Seleccione el tipo</option>
                                            @foreach (\App\Models\Warehouse::where('tipo','sidepej')->get() as $item)
                                            <option {{(int)old('warehouse_id') === $item->id ||$personeria->warehouse_id === $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->name }}</option> 
                                            @endforeach 
                                        </select>
                                    </div>
                                    @endif
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Fecha(Ingreso RDE)</label>
                                        @php 
                                        $fechaentrada = $personeria->fecha_inicio ? $personeria->fecha_inicio : '';
                                        @endphp
                                        <input type="date" name="fecha_inicio" class="form-control"  value="{{old('fecha_inicio') ? : $fechaentrada}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label">Hoja de Ruta (R.D.E.)</label>
                                        <input type="text" name="hojaruta" maxlength="50" class="form-control" value="{{old('hojaruta') ? : $personeria->hojaruta}}" required>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label class="control-label">Representante Legal</label>
                                        <input type="text" name="representante" maxlength="50" class="form-control" value="{{old('representante') ? : $personeria->representante}}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label">N° Documento</label>
                                        <input type="text" name="representante" maxlength="50" class="form-control" value="{{old('representante') ? : $personeria->representante}}" required>
                                    </div>
                                    <div id="div_departamento" class="form-group col-md-8">
                                        <label class="control-label">Expedido</label>
                                        <select name="departamento_id" class="form-control select2" id="select-category" required>
                                            <option value="" selected>Seleccione el departamento</option>
                                            @foreach (\App\Models\Departamento::all() as $item)
                                            <option {{(int)old('departamento_id') === $item->id ||$personeria->departamento_id === $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->name }}</option> 
                                            @endforeach                                        
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Costo Servicio (Personería Jurídica)</label>
                                        <input type="number" name="costo_personeria" class="form-control" required value="{{old('costo_personeria') ? : $personeria->costo_personeria}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Costo Valorados</label>
                                        <input type="number" name="costo_valoragregado" class="form-control" required value="{{old('costo_valoragregado') ? : $personeria->costo_valoragregado}}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <br><br>
                            </div>
                        </div>
                    </div>
                     <div class="col-xs-12 col-sm-7 col-md-6 div-phone">
                        <div class="panel panel-bordered">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                Datos Personería Jurídica
                                </h3>
                                <div class="panel-actions">
                                    <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Personeria</label>
                                        <select name="reserva_id" class="form-control select2" required>
                                        <option value="" selected>Seleccione la reserva de nombre</option>
                                            @foreach (\App\Models\Reserva::pluck('id','nombre') as $item)
                                            <option {{(int)old('reserva_id') === $item->id ||$personeria->reserva_id === $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->nombre }}</option> 
                                            @endforeach 
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Objeto</label>
                                        <select name="objeto_id" class="form-control select2" required>
                                        <option value="" selected>Seleccione el objeto</option>
                                            @foreach (\App\Models\Organization::where('tipo','objetos')->get() as $item)
                                            <option {{(int)old('objeto_id') === $item->id ||$personeria->objeto_id === $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->nombre }}</option> 
                                            @endforeach 
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Ambito de Aplicación</label>
                                        <select name="ambitoaplicacion_id" class="form-control select2" required>
                                        <option value="" selected>Seleccione el objeto</option>
                                            @foreach (\App\Models\Organization::where('tipo','ambitosaplicacion')->get() as $item)
                                            <option {{(int)old('ambitoaplicacion_id') === $item->id ||$personeria->ambitoaplicacion_id === $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->nombre }}</option> 
                                            @endforeach 
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Numero Resolucion</label>
                                        <input type="text" name="numero_resolucion" maxlength="50" class="form-control" value="{{old('numero_resolucion') ? : $personeria->numero_resolucion}}" required>
                                    </div>
                                    <div id="div_municipio" class="form-group col-md-4">
                                        <label class="control-label">Municipio</label>
                                        <select name="municipio_id" class="form-control select2" id="select-category" required>
                                            <option value="" selected>Seleccione el municipio</option>
                                            @foreach (\App\Models\Municipio::with('provincia')->get() as $item)
                                            <option {{(int)old('municipio_id') === $item->id ||$personeria->municipio_id === $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ ($item->provincia->count() > 0) ? $item->provincia->nombre : '' }} - {{ $item->nombre }}</option> 
                                            @endforeach                                        
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Localidad</label>
                                        <input type="text" name="localidad" class="form-control" value="{{old('localidad') ? : $personeria->localidad}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Nombre Solicitante</label>
                                        <input type="text" name="nombre_solicitante" class="form-control" value="{{old('nombre_solicitante') ? : $personeria->nombre_solicitante}}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Nro. de Recibo Oficial</label>
                                        <input type="text" name="numero_recibo" class="form-control" required value="{{old('numero_recibo') ? : $personeria->numero_recibo}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Costo Reserva</label>
                                        <input type="number" name="costo_reserva" class="form-control" required value="{{old('costo_reserva') ? : $personeria->costo_reserva}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Fecha(Inicio Trámite)</label>
                                        @php 
                                        $fechaentrada = $personeria->fecha_inicio ? $personeria->fecha_inicio : '';
                                        @endphp
                                        <input type="date" name="fecha_inicio" class="form-control"  value="{{old('fecha_inicio') ? : $fechaentrada}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Fecha Conclusion</label>
                                        @php 
                                        $fechaentrada = $personeria->fecha_conclusion ? $personeria->fecha_conclusion->format('Y-m-d') : '';
                                        @endphp
                                        <input type="date" name="fecha_conclusion" class="form-control"  value="{{old('fecha_conclusion') ? : $fechaentrada}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        @if ($errors->has('nombre'))
                                            <span class="alert-danger">
                                            <strong>{{ $errors->first('nombre')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }} <i class="voyager-check"></i> </button>
                            </div>
                        </div>
                    </div>
                </form>
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