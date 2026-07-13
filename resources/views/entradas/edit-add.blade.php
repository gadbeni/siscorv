@extends('voyager::master')

@section('css')
    <style>
    .page-title{
        line-height:1.5rem;
        max-width: 320px
    }

    @media (max-width: 767px) {
        .container-toggle-nci {
            text-align: left !important;
        }
    }
    /* Estado interactivo del Nro. de cite */
    #divcite.has-error .form-control { border-color:#d9534f; box-shadow:0 0 0 2px rgba(217,83,79,.15); }
    #divcite.has-success .form-control { border-color:#5cb85c; box-shadow:0 0 0 2px rgba(92,184,92,.15); }
    #icon { transition: opacity .2s ease; }
    #icon i { vertical-align: middle; }
    .cite-spinner { display:inline-block; width:12px; height:12px; border:2px solid #ccc; border-top-color:#3097D1; border-radius:50%; animation:citeSpin .6s linear infinite; vertical-align:middle; }
    @keyframes citeSpin { to { transform: rotate(360deg); } }
    @keyframes citeShake { 0%,100%{transform:translateX(0)} 20%{transform:translateX(-5px)} 40%{transform:translateX(5px)} 60%{transform:translateX(-3px)} 80%{transform:translateX(3px)} }
    .cite-shake { animation: citeShake .35s ease; }
    /* Requisitos faltantes del cite (en vivo) */
    .cite-reqs { display:flex; gap:8px; flex-wrap:wrap; align-items:center; margin-top:7px; opacity:0; max-height:0; overflow:hidden; transition:opacity .2s ease, max-height .25s ease; }
    .cite-reqs.is-visible { opacity:1; max-height:44px; }
    .cite-reqs-label { font-size:12px; color:#9aa0a6; font-weight:500; letter-spacing:.2px; }
    .cite-chip { display:inline-flex; align-items:center; gap:7px; font-size:12.5px; font-weight:500; color:#8a6d3b; background:#fcf8e3; border:1px solid #f5e6b8; padding:4px 12px; border-radius:999px; }
    .cite-chip-ico { width:6px; height:6px; border-radius:50%; background:#e0a800; flex:none; box-shadow:0 0 0 3px rgba(224,168,0,.15); }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', 'Añadir Ingreso')

@if(auth()->user()->hasPermission('add_entradas') || auth()->user()->hasPermission('edit_entradas'))

    @section('page_header')
        <div class="row">
            <div class="col-md-10 col-sm-6" style="margin: 0px">
                <h1 class="page-title">
                    <i class="voyager-credit-cards"></i>
                    @if ($entrada->id)
                        Editar
                    @else
                        Añadir
                    @endif
                    
                    @if (auth()->user()->hasRole('funcionario') && auth()->user()->hasRole('ventanilla'))
                        Correspondencia/NCI 
                    @elseif (auth()->user()->hasRole('funcionario'))
                        NCI
                    @elseif(auth()->user()->hasRole('ventanilla'))
                        Correspondencia
                    @else
                        Correspondencia/NCI
                    @endif
                </h1>
            </div>
            <div class="col-md-2 col-sm-6 text-right container-toggle-nci" style="margin: 0px; padding-top: 30px; margin-bottom: 30px;">
                <input 
                    type="checkbox" 
                    id="toggleswitch-tipo"
                    data-toggle="toggle" 
                    data-on="NCI" 
                    data-off="Externa"
                    data-onstyle="success"
                >
            </div>
        </div>
    @stop

    @section('content')
        <div class="page-content edit-add container-fluid">
            <div class="row">
                <div class="col-md-12 div-phone">
                    <form 
                        action="{{ ! $entrada->id ? route('entradas.store') : route('entradas.update',$entrada->id) }}" 
                        method="POST" 
                        enctype="multipart/form-data"
                        id="formulario"
                        class="form-submit"
                    >
                        @if($entrada->id)
                            @method('PUT')
                        @endif
                        @csrf
                        <input type="hidden" name="tipo" id="input-tipo">
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                                <div class="row">
                                    {{-- <div class="form-group col-md-6">
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
                                    </div> --}}
                                    <div id="div_category" @if(auth()->user()->hasRole(['ventanilla'])) class="form-group col-md-4" @else class="form-group col-md-6" @endif>
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
                                    @if (auth()->user()->hasRole(['ventanilla']))
                                        <div class="form-group col-md-2">
                                        <br>
                                            <a href="#" title="Nuevo cliente" data-target="#modal-create-customer" data-toggle="modal" class="btn btn-primary">
                                                <i class="voyager-plus"></i><span> Nuevo</span>
                                            </a>
                                        </div>
                                    @endif
                                    <div id="divcite" class="form-group tip col-md-3">
                                        <label class="control-label">Nro de cite</label>
                                        <input type="text" id="input1" maxlength="50" class="form-control input1" onkeypress="return check(event)" style="text-transform:uppercase" placeholder="DF-1/2022" value="{{ old('cite') ?? $entrada->cite }}">
                                        <input type="text" id="input2" maxlength="50" class="form-control input2" style="text-transform:uppercase" placeholder="1/2022" value="{{ old('cite') ?? $entrada->cite }}">
                                        <span id="icon" class="help-block" style="display: none; margin-top: 4px;"></span>
                                        <div id="cite-reqs" class="cite-reqs"></div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Fecha Registro <span class="voyager-info-circled" data-toggle="tooltip" data-placement="top" title="Si seleccionona una fecha anterior estara registrando un tramite con fecha atrasada"></span></label>
                                        @php 
                                        $dt = new DateTime();
                                        $dt= $dt->format('Y-m-d\TH:i:s'); 
                                        $fechaeregistro = $entrada->fecha_registro ? $entrada->fecha_registro : $dt;
                                        @endphp
                                        <input type="datetime-local" name="fecha_registro" class="form-control"  value="{{old('fecha_registro') ? : date('Y-m-d\TH:i', strtotime($fechaeregistro))}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Remitente</label>
                                        <div id="div-remitente" style="{{ $entrada->tipo == null || $entrada->tipo === 'I' ? 'display: block' : 'display: none' }}">
                                            <select name="funcionario_id_remitente" class="form-control select2">
                                                {{-- <option value="{{ $funcionario ? $funcionario->id_funcionario : NULL }}">{{ $funcionario ? $funcionario->nombre.' '.$funcionario->cargo: 'Admin' }}</option> --}}
                                                <option value="{{ $funcionario ? $funcionario->id_funcionario : NULL }}">{{ $funcionario ? $funcionario->nombre: 'Admin' }}</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="remitent_interno" value="{{ $funcionario ? $funcionario->nombre : null}}">
                                        <input
                                            type="text"
                                            name="remitente"
                                            id="input-remitente"
                                            maxlength="150"
                                            style="{{ $entrada->tipo === 'E' ? 'display: block' : 'display: none' }}"
                                            class="form-control"
                                            value="{{old('remitente') ? :$entrada->remitente}}">
                                    </div>
                                    <div class="form-group col-md-6" id="div-cargo-remitente" style="{{ $entrada->tipo == null || $entrada->tipo === 'I' ? 'display: block' : 'display: none' }}">
                                        <label class="control-label">Cargo del remitente</label>
                                        <select name="cargo_de" id="select-cargo_de" class="form-control select2" required>
                                            <option value="" selected disabled>Seleccione el cargo</option>
                                            @php
                                                $cargo_actual = old('cargo_de') ?: $entrada->job_de;
                                                $opciones_cargo = collect();
                                                if ($funcionario) {
                                                    if (!empty($funcionario->cargo)) {
                                                        $opciones_cargo->push($funcionario->cargo);
                                                    }
                                                }
                                                $opciones_cargo = $opciones_cargo->merge($cargos_adicionales)->filter()->map(function ($cargo) {
                                                    return mb_strtoupper($cargo, 'UTF-8');
                                                })->unique();
                                                $cargo_actual = $cargo_actual ? mb_strtoupper($cargo_actual, 'UTF-8') : $cargo_actual;
                                                if ($cargo_actual && !$opciones_cargo->contains($cargo_actual)) {
                                                    $opciones_cargo->push($cargo_actual);
                                                }
                                            @endphp
                                            @foreach ($opciones_cargo as $cargo)
                                                <option value="{{ $cargo }}" {{ $cargo_actual === $cargo ? 'selected' : '' }}>{{ $cargo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Nro. de Hojas/Anexos <span class="voyager-info-circled" data-toggle="tooltip" data-placement="top" title="Describa el material físico que contiene la NCI/Correspondencia"></span></label>
                                        <input type="text" name="nro_hojas" class="form-control" value="{{old('nro_hojas') ? : $entrada->nro_hojas}}" placeholder="3 hojas y 1 CD">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Plazo <span class="voyager-info-circled" data-toggle="tooltip" data-placement="top" title="Fecha límite para ejecutar la petición de la NCI/Correspondencia, si la tuviera"></span></label>
                                        @php 
                                        $fechaentrada = $entrada->deadline ? $entrada->deadline->format('Y-m-d') : '';
                                        @endphp
                                        <input type="date" name="deadline" class="form-control"  value="{{old('deadline') ? : $fechaentrada}}">
                                    </div>
                                    <div class="form-group col-md-6" id="div-entity_id" style="{{ $entrada->tipo === 'E' ? 'display: block' : 'display: none' }}">
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
                                        <div class="input-group">
                                            <select name="funcionario_id_destino" class="form-control" id="select-funcionario_id_destino" style="text-transform: uppercase;" required></select>
                                            <span class="input-group-btn">
                                                <input 
                                                    type="checkbox" 
                                                    id="toggleswitch-type" 
                                                    data-toggle="toggle" 
                                                    data-on="Interno" 
                                                    data-off="Externo"
                                                    checked 
                                                >
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Archivos</label>
                                        <input type="file" name="archivos[]" multiple class="form-control imageLength" accept="image/jpeg,image/jpg,image/png,application/pdf">
                                    </div>
                                    <div id="div-personeria">
                                        <label class="control-label">Personería jurídica</label> <br>
                                        <input 
                                            type="checkbox" 
                                            id="toggleswitch-personeria"
                                            data-toggle="toggle" 
                                            data-on="Si" 
                                            data-off="No"
                                            data-onstyle="success"
                                        > 
                                        <a href="#" class="btn btn-link btn-agregar-personeria" style="display: none" data-toggle="modal" data-target="#modal-personeria">Editar</a>
                                    </div>

                                    {{-- Modal personería --}}
                                    <div class="modal fade" tabindex="-1" id="modal-personeria" role="dialog" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog modal-success">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><i class="voyager-certificate"></i> Datos de personería jurídica</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group col-md-12">
                                                        <label class="control-label">Nombre de personeria</label>
                                                        <input type="text" id="namePersoneria" name="namePersoneria" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="control-label">Nombre completo del solicitante</label>
                                                        <input type="text" id="nameSolicitante" name="nameSolicitante" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="control-label">Celular de responsable</label>
                                                        <input type="number" id="cellPersoneria" name="cellPersoneria" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <table style="width: 100%">
                                                            <tr>
                                                                <td><b>Solicitud</b></td>
                                                                <td><input type="file" name="solicitud_p" id="solicitud_p" class="form-control imageLength" accept="image/jpeg,image/jpg,image/png,application/pdf"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>CI</b></td>
                                                                <td><input type="file" name="carnet_p" id="carnet_p" class="form-control imageLength" accept="image/jpeg,image/jpg,image/png,application/pdf"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Deposito bancario</b></td>
                                                                <td><input type="file" name="deposito_p" id="deposito_p" class="form-control imageLength" accept="image/jpeg,image/jpg,image/png,application/pdf"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Poder (Opcional)</b></td>
                                                                <td><input type="file" name="poder_p" id="poder_p" class="form-control imageLength" accept="image/jpeg,image/jpg,image/png,application/pdf"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default btn-cancelar-personeria">Cancelar</button>
                                                    <button type="button" class="btn btn-success btn-validar-personeria">Aceptar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Referencia</label>
                                        <textarea name="referencia" class="form-control" rows="3" required>{{old('referencia') ? : $entrada->referencia}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12" id="div-detalle" style="{{ auth()->user()->hasRole(['funcionario']) || $entrada->tipo == 'I' ? 'display: block' : 'display: none' }}">
                                        {{-- <label class="control-label">Cuerpo</label> --}}
                                        <textarea class="form-control richTextBox" id="bloquear" name="detalles">{{old('detalles') ? : $entrada->detalles}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="urgent" value="1" @if($entrada->urgent) checked @endif>Urgente <span class="voyager-info-circled" data-toggle="tooltip" data-placement="top" title="Seleccionar la opción en caso de que sea urgente"></span>
                                </label> <br> <br>
                                <button type="submit" id="btn_save" class="btn btn-primary btn-submit save">{{ __('voyager::generic.save') }} <i class="voyager-check"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <form action="{{route('categories.store')}}" id="form-create-customer" method="POST">
            <div class="modal fade" tabindex="-1" id="modal-create-customer" role="dialog">
                <div class="modal-dialog modal-primary">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa-solid fa-person-circle-plus"></i> Agregar Tipos de Tramites</h4>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <small>Categoría</small>
                                        <select name="organization_id" id="organization_id" class="form-control select2"  required>
                                            <option value="" selected>Seleccione el tipo</option>
                                            @foreach (\App\Models\Organization::where('tipo','tptramites')->get() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre}}</option> 
                                            @endforeach                                        
                                        </select>
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <small>Nombre</small>
                                        <input type="text" name="nombre" id="nombre" class="form-control">
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-save-customer">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @stop

    @section('javascript')
        <script>
            var entrada_id = "{{ $entrada->id }}";
            var id_funcionario = "{{ $funcionario ? $funcionario->id_funcionario : '' }}";
            // ===== Nro. de CITE: feedback en vivo (requisitos + disponibilidad) =====
            var citeTimer = null;
            var citeDup = false; // false=libre | true=duplicado | 'checking'

            function citeInputActivo() {
                return $('#input1, #input2').filter(':visible').first();
            }

            function citeReqChip(faltan, singular, plural) {
                var palabra = faltan === 1 ? singular : plural;
                return '<span class="cite-chip"><span class="cite-chip-ico"></span>' + faltan + ' ' + palabra + '</span>';
            }

            // Pinta los chips de Letras/Numeros al instante mientras se escribe.
            function renderCiteReqs(valor) {
                var $reqs = $('#cite-reqs');
                var faltantes = [];
                if (valor && valor.trim()) {
                    var letras = (valor.match(/[A-Za-z]/g) || []).length;
                    var numeros = (valor.match(/[0-9]/g) || []).length;
                    var esInterno = $('#input-tipo').val() === 'I';
                    if (esInterno && letras < 2) { faltantes.push(citeReqChip(2 - letras, 'letra', 'letras')); }
                    if (numeros < 5) { faltantes.push(citeReqChip(5 - numeros, 'n&uacute;mero', 'n&uacute;meros')); }
                }
                if (faltantes.length === 0) {
                    $reqs.removeClass('is-visible');
                    setTimeout(function () { if (!$reqs.hasClass('is-visible')) { $reqs.empty(); } }, 220);
                    return;
                }
                $reqs.html('<span class="cite-reqs-label">Falta:</span>' + faltantes.join('')).addClass('is-visible');
            }

            // Habilita Guardar solo si el formato cumple y el cite no esta duplicado.
            function actualizarBotonCite() {
                var valor = citeInputActivo().val() || '';
                var ok = citeFormatoOk(valor) && citeDup === false;
                $('#btn_save').attr('disabled', !ok);
            }

            // Linea de disponibilidad (#icon). Estados: idle | checking | taken | available
            function setCiteState(state) {
                var $grupo = $('#divcite');
                var $icon = $('#icon');
                $grupo.removeClass('has-error has-success');
                $('#input1, #input2').removeClass('cite-shake');

                if (state === 'checking') {
                    citeDup = 'checking';
                    $icon.stop(true, true)
                        .html('<span class="cite-spinner"></span> Verificando disponibilidad...')
                        .css('color', '#777').show();
                } else if (state === 'taken') {
                    citeDup = true;
                    $grupo.addClass('has-error');
                    $icon.stop(true, true)
                        .html('<i class="voyager-warning"></i> <b>Este Nro. de cite ya esta registrado.</b> Usa uno diferente.')
                        .css('color', '#d9534f').show();
                    var $a = citeInputActivo();
                    if ($a.length) { void $a[0].offsetWidth; $a.addClass('cite-shake'); }
                } else if (state === 'available') {
                    citeDup = false;
                    $grupo.addClass('has-success');
                    $icon.stop(true, true)
                        .html('<i class="voyager-check"></i> Nro. de cite disponible.')
                        .css('color', '#5cb85c').show();
                } else {
                    citeDup = false;
                    $icon.stop(true, true).fadeOut('fast');
                }
                actualizarBotonCite();
            }

            function citeVerificarDuplicado(valor) {
                var aux = (valor || '').replace(/\//g, '&');
                if (!aux) { setCiteState('idle'); return; }
                var id = entrada_id || 1;
                $.get("{{ route('cite.get') }}/" + id + "/" + encodeURIComponent(aux), function (data) {
                    if (data == 1) {
                        setCiteState('taken');
                    } else {
                        setCiteState(citeFormatoOk(valor) ? 'available' : 'idle');
                    }
                }).fail(function () { setCiteState('idle'); });
            }

            // 'input' cubre tambien el pegado. Chips al instante; duplicado con debounce.
            $('#input1, #input2').on('input', function () {
                var valor = this.value;
                renderCiteReqs(valor);
                clearTimeout(citeTimer);
                if (!valor.trim()) { setCiteState('idle'); return; }
                setCiteState('checking');
                citeTimer = setTimeout(function () {
                    citeVerificarDuplicado(valor);
                }, 350);
            });

            var okletra = true;
            var oknumero = true;
            var auxl=0;
            var auxn=0;
            let bolFuncionario = false;
            let bolVentanilla = false;
            let boladmin = false;
            $(document).ready(function(){

                // Por cambiar el tipo de entrada inicial dependiendo del rol
                // se necesita inicializar desde aqui
                setTimeout(() => {
                    //  en caso de edit
                    @if ($entrada->id)
                        let tipoedit = '{{ $entrada->tipo }}';
                        cambiarTipo(tipoedit);
                        if(tipoedit == 'I'){
                            $('#toggleswitch-tipo').bootstrapToggle('on');
                        }else{
                            $('#toggleswitch-tipo').bootstrapToggle('off');
                        }
                        $('#toggleswitch-tipo').attr('disabled', 'disabled');
                    @else
                        @if (auth()->user()->hasRole('funcionario'))
                            cambiarTipo('I');
                            $('#toggleswitch-tipo').bootstrapToggle('on');
                            bolFuncionario = true;
                        @endif
                        @if (auth()->user()->hasRole('ventanilla'))
                            cambiarTipo('E');
                            $('#toggleswitch-tipo').bootstrapToggle('off');
                            bolVentanilla = true;
                        @endif
                        @if (auth()->user()->hasRole('admin'))
                            cambiarTipo('E');
                            $('#toggleswitch-tipo').bootstrapToggle('off');
                            boladmin = true;
                        @endif

                        //desabilitar el toggle si no es funcionario y ventanilla
                        if(!(bolFuncionario && bolVentanilla)){
                            $('#toggleswitch-tipo').attr('disabled', 'disabled');
                        }
                        // habilitar el toggle si es admin
                        if(boladmin){
                            $('#toggleswitch-tipo').removeAttr('disabled');
                        }
                    @endif

                    
                }, 0);
                

                $("#bloquear").on('paste', function(e){
                    e.preventDefault();
                })                
                $("#bloquear").on('copy', function(e){
                    e.preventDefault();
                })

                $('#form-create-customer').submit(function(e){
                    e.preventDefault();
                    $('.btn-save-customer').attr('disabled', true);
                    $('.btn-save-customer').val('Guardando...');
                    $.post($(this).attr('action'), $(this).serialize(), function(data){
                        if(data.category.id){
                            toastr.success('Categoria Registrada..', 'Éxito');
                            $(this).trigger('reset');
                        }else{
                            toastr.error(data.error, 'Error');
                        }
                    })
                    .always(function(){
                        $('.btn-save-customer').attr('disabled', false);
                        $('.btn-save-customer').val('Guardar');
                        $('#nombre').val('');
                        $('#organization_id').val('').trigger('change');
                        $('#modal-create-customer').modal('hide');
                    });
                });

                ruta = "{{ route('mamore.getpeople') }}";
                intern_externo=1;
                $("#select-funcionario_id_destino").select2({
                    ajax: { 
                        allowClear: true,
                        url: ruta,
                        type: "get",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                externo: intern_externo
                            };
                        },
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        }
                    }
                });
                $('#toggleswitch-type').on('change', function() {
                    if (this.checked) {
                        intern_externo = 1;
                    } else {
                        intern_externo = 0;
                    }
                });

                $('#toggleswitch-personeria').on('change', function() {
                    if (this.checked) {
                        $('#modal-personeria').modal('show');
                        $('.btn-agregar-personeria').fadeIn('fast');

                        $('#namePersoneria').attr('required', 'required');
                        $('#cellPersoneria').attr('required', 'required');
                        $('#nameSolicitante').attr('required', 'required');
                        $('#solicitud_p').attr('required', 'required');
                        $('#carnet_p').attr('required', 'required');   
                        $('#deposito_p').attr('required', 'required');
                    }else{
                        $('.btn-agregar-personeria').fadeOut('fast');
                        $('#namePersoneria').removeAttr('required');
                        $('#cellPersoneria').removeAttr('required');
                        $('#nameSolicitante').removeAttr('required');
                        $('#solicitud_p').removeAttr('required');
                        $('#carnet_p').removeAttr('required');
                        $('#deposito_p').removeAttr('required');
                    }
                });

                var additionalConfig = {
                    selector: 'textarea.richTextBox[name="detalles"]',
                    toolbar: 'bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
                    setup: function (editor) {
                        editor.on('paste', function (e) {
                            e.preventDefault();
                            var text = (e.originalEvent || e).clipboardData.getData('text/plain');
                            editor.insertContent(text);
                            console.log('Pegado con éxito: Formato eliminado mediante script propio.');
                        });
                    }
                }

                edit = "{{ $entrada->id }}";
                if(edit){
                    tipo = "{{ $entrada->tipo }}";
                    if(tipo == 'I'){
                        $('#input2').fadeOut('fast');
                        $('#input2').removeAttr('required');
                        $('#input2').removeAttr('name', 'cite');
                        $('#input1').fadeIn('fast');
                        $('#input1').attr('required', 'required');
                        $('#input1').attr('name', 'cite');
                        var citeVal = '{{ $entrada->cite }}';
                        auxl = (citeVal.match(/[a-zA-Z]/g) || []).length;
                        auxn = (citeVal.match(/[0-9]/g) || []).length;
                    }else{
                        $('#input1').fadeOut('fast');
                        $('#input1').removeAttr('required');
                        $('#input1').removeAttr('name', 'cite');
                        $('#input2').fadeIn('fast');
                        $('#input2').attr('required', 'required');
                        $('#input2').attr('name', 'cite');
                        auxn =5;
                        auxl=5;
                    }
                }else{
                    $('#input1').fadeIn('fast');
                    $('#input2').fadeOut('fast');
                }

                tinymce.init(window.voyagerTinyMCE.getConfig(additionalConfig));
                
                $('#toggleswitch-tipo').change(function(){
                    cambiarTipo($(this).is(':checked') ? 'I' : 'E');
                });

                $('.btn-validar-personeria').click(function(){
                    if($("#namePersoneria").val() && $("#nameSolicitante").val() && $("#cellPersoneria").val()){
                        $('#modal-personeria').modal('hide');
                    }else{
                        toastr.error('Debes completar la información', 'Error');
                    }
                });

                $('.btn-cancelar-personeria').click(function(){
                    $('#modal-personeria').modal('hide');
                    $('#toggleswitch-personeria').bootstrapToggle('off');
                });
            });
        
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("formulario").addEventListener('submit', validarFormulario); 
            });

            // Para validar los archivos Extenciones y Tamaño
            $(document).on('change', '.imageLength', function () {
                var input = this;
                var MAX_MB = 5;
                var MAX_BYTES = MAX_MB * 1024 * 1024;
                var permitidas = ['jpg', 'jpeg', 'png', 'pdf'];
                var archivos = Array.prototype.slice.call(input.files);
                if (!archivos.length) { return; }

                function rechazar(titulo, htmlBody) {
                    Swal.fire({ icon: 'error', title: titulo, html: htmlBody, confirmButtonText: 'Entendido', confirmButtonColor: '#3097D1' });
                    input.value = '';
                }

                // Detecta el tipo real leyendo los primeros bytes (firma del archivo).
                function tipoReal(file) {
                    return new Promise(function (resolve) {
                        var fr = new FileReader();
                        fr.onloadend = function () {
                            var b = new Uint8Array(fr.result);
                            if (b[0] === 0x25 && b[1] === 0x50 && b[2] === 0x44 && b[3] === 0x46) { return resolve('pdf'); }
                            if (b[0] === 0x89 && b[1] === 0x50 && b[2] === 0x4E && b[3] === 0x47) { return resolve('png'); }
                            if (b[0] === 0xFF && b[1] === 0xD8 && b[2] === 0xFF) { return resolve('jpg'); }
                            resolve(null);
                        };
                        fr.onerror = function () { resolve(null); };
                        fr.readAsArrayBuffer(file.slice(0, 8));
                    });
                }

                (function validar(i) {
                    if (i >= archivos.length) { return; } // todos validos
                    var file = archivos[i];
                    var ext = (file.name.split('.').pop() || '').toLowerCase();

                    // 1) Extension permitida
                    if (permitidas.indexOf(ext) === -1) {
                        rechazar('Formato no permitido',
                            'El archivo <b>' + file.name + '</b> no es una imagen ni un PDF.<br>' +
                            'Solo se aceptan <b>JPG, PNG o PDF</b>.');
                        return;
                    }

                    // 2) Tamano maximo
                    if (file.size > MAX_BYTES) {
                        var mb = (file.size / 1024 / 1024).toFixed(1);
                        var limitPct = Math.max(3, Math.min(100, (MAX_BYTES / file.size) * 100)).toFixed(0);
                        Swal.fire({
                            icon: 'warning',
                            title: 'Archivo muy pesado',
                            html:
                                '<div style="max-width:300px;margin:0 auto">' +
                                    '<div style="display:flex;align-items:center;gap:8px;justify-content:center;color:#555;font-size:13px;margin-bottom:14px">' +
                                        '<i class="voyager-file-text" style="color:#d9534f;font-size:16px"></i>' +
                                        '<span style="word-break:break-all">' + file.name + '</span>' +
                                    '</div>' +
                                    '<div style="position:relative;height:10px;border-radius:999px;background:#f2dede;overflow:hidden">' +
                                        '<div style="height:100%;width:' + limitPct + '%;background:#5cb85c;border-radius:999px"></div>' +
                                    '</div>' +
                                    '<div style="display:flex;justify-content:space-between;font-size:11.5px;margin-top:6px">' +
                                        '<span style="color:#3c763d;font-weight:600">Permitido: ' + MAX_MB + ' MB</span>' +
                                        '<span style="color:#a94442;font-weight:600">Tu archivo: ' + mb + ' MB</span>' +
                                    '</div>' +
                                    '<p style="margin:16px 0 0;color:#777;font-size:13px">Comprimi el archivo o subilo dividido en partes de menos de ' + MAX_MB + ' MB.</p>' +
                                '</div>',
                            confirmButtonText: 'Entendido',
                            confirmButtonColor: '#3097D1'
                        });
                        input.value = '';
                        return;
                    }

                    // 3) El contenido real (firma) debe coincidir con la extension
                    tipoReal(file).then(function (real) {
                        var esperado = (ext === 'jpeg') ? 'jpg' : ext;
                        if (real === null || real !== esperado) {
                            rechazar('Archivo no valido',
                                'El archivo <b>' + file.name + '</b> no es un ' + ext.toUpperCase() + ' real; ' +
                                'su contenido no coincide con la extension.<br>' +
                                'Sube una imagen <b>JPG/PNG</b> o un <b>PDF</b> valido.');
                            return;
                        }
                        validar(i + 1);
                    });
                })(0);
            });

            function check(e) {   
                tecla = (document.all) ? e.keyCode : e.which;
                //Tecla de retroceso para borrar, siempre la permite
                if (tecla == 8) {
                    return true;
                }
                var numero = 0;
                var letra = 0;
                // Patron de entrada, en este caso solo acepta numeros y letras
                patron = /[A-Za-z0-9-/-]/;
                tecla_final = String.fromCharCode(tecla);
                if(patron.test(tecla_final)){
                    var contenido =document.getElementsByClassName("input1")[0].value;
                    var cadena =  contenido+tecla_final;
                    for(var i = 0; i < (contenido+tecla_final).length; i++){
                        if((cadena[i]>="a" && cadena[i]<="z")||(cadena[i]>="A" && cadena[i]<="Z")){
                            letra= letra+1;
                        } 
                        if(cadena[i] >= 0 && cadena[i]<= 9){
                            numero= numero+1;
                        }   
                    }
                    auxl=letra;
                    auxn=numero;
                    if(letra <= 12){
                        okletra = true;
                    }

                    var num ="0123456789";
                    if (!(num.indexOf(tecla_final.charAt(0),0)!=-1)){
                        if(letra <= 12 && okletra == true){
                            if(letra == 12){
                                okletra = false;
                            }else{
                                okletra = true;
                            }
                            return true;
                        }else{
                            okletra = false;
                            return false;
                        }
                    }
                    

                    if(numero <= 7){
                        oknumero = true;
                    }

                    if(numero <= 7 && oknumero == true){
                        if(numero == 7){
                            oknumero = false;
                        }else{
                            oknumero = true;
                        }
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }               
            }

            function citeFormatoOk(valor) {
                var letras = (valor.match(/[A-Za-z]/g) || []).length;
                var numeros = (valor.match(/[0-9]/g) || []).length;
                var esInterno = $('#input-tipo').val() === 'I';
                return (!esInterno || letras >= 2) && numeros >= 5;
            }

            function citeReqFila(ok, label, actual, req) {
                var color = ok ? '#5cb85c' : '#d9534f';
                var bg = ok ? 'rgba(92,184,92,.10)' : 'rgba(217,83,79,.10)';
                var icono = ok ? '&#10003;' : '&#10007;';
                return '<div style="display:flex;justify-content:space-between;align-items:center;' +
                    'padding:7px 12px;margin:5px 0;border-radius:6px;background:' + bg + '">' +
                    '<span style="color:' + color + ';font-weight:600">' + icono + ' ' + label + '</span>' +
                    '<span style="color:#555;font-size:13px">' + actual + ' / ' + req + '</span>' +
                    '</div>';
            }

            function validarFormulario(evento) {
                evento.preventDefault();

                var valor = ($('#input1, #input2').filter(':visible').first().val() || '');

                if (citeFormatoOk(valor)) {
                    this.submit();
                    return;
                }

                var letras = (valor.match(/[A-Za-z]/g) || []).length;
                var numeros = (valor.match(/[0-9]/g) || []).length;
                var esInterno = $('#input-tipo').val() === 'I';
                var ejemplo = esInterno ? 'DF-1/2022' : '1/2022';

                var filas = '';
                if (esInterno) {
                    filas += citeReqFila(letras >= 2, 'Letras', letras, 2);
                }
                filas += citeReqFila(numeros >= 5, 'N&uacute;meros', numeros, 5);

                Swal.fire({
                    icon: 'warning',
                    title: 'Nro. de CITE incompleto',
                    html:
                        '<p style="margin:0 0 10px;color:#555">Falta completar para poder guardar:</p>' +
                        '<div style="max-width:250px;margin:0 auto">' + filas + '</div>' +
                        '<p style="margin:14px 0 0;color:#888;font-size:13px">Ejemplo v&aacute;lido: <b>' + ejemplo + '</b></p>',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#3097D1'
                });
            }

            function cambiarTipo(tipo){
                $('#input-tipo').val(tipo);
                if(tipo == 'E'){
                    $('#div-remitente').fadeOut('fast');
                    $('#div-cargo-remitente').fadeOut('fast');
                    $('#select-cargo_de').removeAttr('required');
                    $('#input-remitente').fadeIn('fast');
                    $('#div-detalle').fadeOut('fast');
                    $('#div-entity_id').fadeIn('fast');
                    $('#input2').fadeIn('fast');
                    $('#input2').attr('required', 'required');
                    $('#input2').attr('name', 'cite');
                    $('#input1').fadeOut('fast');
                    $('#input1').removeAttr('required');
                    $('#input1').removeAttr('name', 'cite');
                    auxn =5;
                    auxl=5;
                    $('#div-personeria').fadeIn('fast');

                    // name Person
                    $('#namePersoneria').removeAttr('required');
                    $('#cellPersoneria').removeAttr('required');
                    $('#nameSolicitante').removeAttr('required');
                    $('#solicitud_p').removeAttr('required');
                    $('#carnet_p').removeAttr('required');
                    $('#deposito_p').removeAttr('required');

                    $('.form-submit .btn-submit').removeAttr('disabled')
                }else{
                    $('#div-remitente').fadeIn('fast');
                    $('#div-cargo-remitente').fadeIn('fast');
                    $('#select-cargo_de').attr('required', 'required');
                    $('#input-remitente').fadeOut('fast');
                    $('#div-detalle').fadeIn('fast');
                    $('#div-entity_id').fadeOut('fast');
                    $('#input1').fadeIn('fast');
                    $('#input1').attr('required', 'required');
                    $('#input1').attr('name', 'cite');

                    $('#input2').fadeOut('fast');
                    $('#input2').removeAttr('required');
                    $('#input2').removeAttr('name', 'cite');
                    var currentCite = $('#input1').val();
                    auxl = (currentCite.match(/[a-zA-Z]/g) || []).length;
                    auxn = (currentCite.match(/[0-9]/g) || []).length;

                    $('#div-personeria').fadeOut('fast');
                    $('#namePersoneria').removeAttr('required');
                    $('#cellPersoneria').removeAttr('required');
                    $('#nameSolicitante').removeAttr('required');
                    $('#solicitud_p').removeAttr('required');
                    $('#carnet_p').removeAttr('required');
                    $('#deposito_p').removeAttr('required');

                    if(id_funcionario != ''){
                        $('.form-submit .btn-submit').removeAttr('disabled')
                    }else{
                        $('.form-submit .btn-submit').attr('disabled', 'disabled')
                    }
                }
            }
        </script>
    @stop
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif
