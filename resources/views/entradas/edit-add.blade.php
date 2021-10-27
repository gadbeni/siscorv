@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', 'Añadir Ingreso')

@if(auth()->user()->hasPermission('add_entradas') || auth()->user()->hasPermission('edit_entradas'))

    @section('page_header')
        <h1 class="page-title">
            <i class="voyager-credit-cards"></i>
            Añadir Ingreso
        </h1>
    @stop

    @section('content')
        <div class="page-content edit-add container-fluid">
            <div class="row">
                <div class="col-md-12 div-phone">
                    <form 
                        action="{{ ! $entrada->id ? route('entradas.store') : route('entradas.update',$entrada->id) }}" 
                        method="POST" 
                        enctype="multipart/form-data"
                    >
                        @if($entrada->id)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Tipo</label>
                                        <select name="tipo" class="form-control select2" id="select-tipo" required>
                                            <option value="" selected>Seleccione el tipo</option>
                                            <option {{old('tipo') === 'I' || $entrada->tipo === 'I' ? 'selected' : ''}} 
                                                value="I" 
                                                @if (!auth()->user()->hasRole('funcionario') && !auth()->user()->hasRole('admin')) 
                                                    disabled 
                                                @endif>
                                                Interno
                                            </option>
                                            <option {{old('tipo') === 'E' || $entrada->tipo === 'E' ? 'selected' : ''}} 
                                                value="E" 
                                                @if (!auth()->user()->hasRole(['ventanilla']) && !auth()->user()->hasRole('admin')) 
                                                    disabled 
                                                @endif>
                                                Externo
                                            </option>
                                        </select>
                                    </div>
                                    <div id="div_category" class="form-group col-md-5">
                                        <label class="control-label">Tipo Trámite</label>
                                        <select name="category_id" class="form-control select2" id="select-category" required>
                                            <option value="" selected>Seleccione el tipo</option>
                                            @foreach (\App\Models\Category::with(['organization' => function($q){
                                                $q->where('tipo','tptramites');
                                            }])->get() as $item)
                                            <option {{(int)old('category_id') === $item->id ||$entrada->category_id === $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ ($item->organization->count() > 0) ? substr($item->organization->nombre,0,4).' -' : '' }} {{ $item->nombre }}</option> 
                                            @endforeach                                        
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">Nro de cite</label>
                                        <input type="text" name="cite" maxlength="50" class="form-control" value="{{old('cite') ? : $entrada->cite}}" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">Urgente</label>
                                        <span class="voyager-question text-info pull-left" data-toggle="tooltip" data-placement="left" title="Este campo es obligatorio."></span>
                                        <input 
                                            type="checkbox" 
                                            name="urgent" 
                                            data-toggle="toggle" 
                                            data-on="Sí" 
                                            data-off="No"
                                            @if($entrada->urgent) checked @endif
                                            >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Remitente</label>
                                        <div id="div-remitente" style="{{$entrada->tipo == null ||$entrada->tipo === 'I' ? 'display: block' : 'display: none' }}">
                                            <select name="funcionario_id_remitente" class="form-control select2">
                                                <option value="{{ $funcionario ? $funcionario->id_funcionario : 844 }}">{{ $funcionario ? $funcionario->nombre : 'Admin' }}</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="remitent_interno" value="{{ $funcionario ? $funcionario->nombre.' '.$funcionario->cargo : null}}">
                                        <input 
                                            type="text" 
                                            name="remitente" 
                                            id="input-remitente" 
                                            maxlength="150" 
                                            style="{{$entrada->tipo === 'E' ? 'display: block' : 'display: none' }}" 
                                            class="form-control"
                                            value="{{old('remitente') ? :$entrada->remitente}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Nro. de Hojas/Anexas</label>
                                        <input type="text" name="nro_hojas" class="form-control" value="{{old('nro_hojas') ? : $entrada->nro_hojas}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Plazo</label>
                                        @php 
                                        $fechaentrada = $entrada->deadline ? $entrada->deadline->format('Y-m-d') : '';
                                        @endphp
                                        <input type="date" name="deadline" class="form-control"  value="{{old('deadline') ? : $fechaentrada}}">
                                    </div>
                                    <div class="form-group col-md-6" id="div-entity_id" style="{{$entrada->tipo === 'E' ? 'display: block' : 'display: none' }}">
                                        <label class="control-label">Origen</label>
                                        <select name="entity_id" class="form-control select2">
                                            <option value="">Selecciona el origen</option>
                                            @foreach (\App\Models\Entity::where('estado', 'activo')->where('deleted_at', NULL)->get() as $item)
                                            <option {{(int)old('entity_id') === $item->id ||$entrada->entity_id === $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->sigla ? $item->sigla.' -' : '' }} {{ $item->nombre }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6" id="div-destinatario" >
                                        <label class="control-label">Destinatario</label>
                                        <select name="funcionario_id_destino" class="form-control" id="select-funcionario_id_destino"></select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Archivos</label>
                                        <input type="file" name="archivos[]" multiple class="form-control" accept="application/pdf">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Referencia</label>
                                        <textarea name="referencia" class="form-control" rows="3" required>{{old('referencia') ? : $entrada->referencia}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12" id="div-detalle" style="{{ auth()->user()->hasRole(['funcionario']) || $entrada->tipo == 'I' ? 'display: block' : 'display: none' }}">
                                        <label class="control-label">Cuerpo</label> 
                                        <textarea class="form-control richTextBox" name="detalles">{{old('detalles') ? : $entrada->detalles}}</textarea>
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
                    selector: 'textarea.richTextBox[name="detalles"]',
                }
                
                tinymce.init(window.voyagerTinyMCE.getConfig(additionalConfig));
                
                $('#select-tipo').change(function(){
                    let tipo = $('#select-tipo option:selected').val();
                    if(tipo == 'E'){
                        $('#div-remitente').fadeOut();
                        $('#input-remitente').fadeIn();
                        $('#div-detalle').fadeOut();
                        $('#div-entity_id').fadeIn();
                    }else{
                        $('#div-remitente').fadeIn();
                        $('#input-remitente').fadeOut();
                        $('#div-detalle').fadeIn();
                        $('#div-entity_id').fadeOut();
                    }
                });

                $('#select-category').change(function(){
                    let type = $('#select-category option:selected').text();
                    let tipo = $('#select-tipo option:selected').val();
                    let tptramite ="PERS";
                    if (type.includes(tptramite) || tipo == 'I') {
                        $('#div-destinatario').fadeIn();
                    }else{
                        $('#div-destinatario').fadeOut();
                    }
                  
                });
            });
        </script>
    @stop
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif