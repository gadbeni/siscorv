@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', 'Añadir Ingreso')

@if(auth()->user()->hasPermission('add_entradas') || auth()->user()->hasPermission('edit_entradas'))

    @section('page_header')
        <div class="row">
            <div class="col-md-10 col-sm-6" style="margin: 0px">
                <h1 class="page-title">
                    <i class="voyager-credit-cards"></i>
                    Añadir 
                    @if (auth()->user()->hasRole('funcionario'))
                        NCI
                    @elseif(auth()->user()->hasRole('ventanilla'))
                        Correspondencia
                    @else
                        Correspondencia/NCI
                    @endif
                </h1>
            </div>
            <div class="col-md-2 col-sm-6 text-right" style="margin: 0px; padding-top: 30px">
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
                                    <div id="divcite" class="form-group tip col-md-6">
                                        <label class="control-label">Nro de cite</label>
                                        <input type="text" id="input1" maxlength="50" class="form-control input1" onkeypress="return check(event)" style="text-transform:uppercase" placeholder="DF-1/2022">
                                        <input type="text" id="input2" maxlength="50" class="form-control input2" style="text-transform:uppercase" placeholder="1/2022">
                                        <span id="icon"  style="display: none; color:red">
                                            <b>El cite  ya se encuentra registrado</b>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6">
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
                                                <option value="{{ $funcionario ? $funcionario->id_funcionario : NULL }}">{{ $funcionario ? $funcionario->nombre.' '.$funcionario->cargo: 'Admin' }}</option>
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
                                                                <td><input type="file" name="solicitud_p" id="solicitud_p" class="form-control" accept="image/jpeg,image/jpg,image/png,application/pdf"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>CI</b></td>
                                                                <td><input type="file" name="carnet_p" id="carnet_p" class="form-control" accept="image/jpeg,image/jpg,image/png,application/pdf"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Deposito bancario</b></td>
                                                                <td><input type="file" name="deposito_p" id="deposito_p" class="form-control" accept="image/jpeg,image/jpg,image/png,application/pdf"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Poder (Opcional)</b></td>
                                                                <td><input type="file" name="poder_p" id="poder_p" class="form-control" accept="image/jpeg,image/jpg,image/png,application/pdf"></td>
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
            input1.oninput = function() {
                var cite ="";
                var aux = '';
                var i =0;
                cite = input1.value;
                while(i < cite.length){
                    if(cite.charAt(i) == '/'){
                        aux = aux + '&';   
                    }
                    else{
                        aux = aux + cite.charAt(i);
                    }
                    i++;
                }
                if(!entrada_id){
                    entrada_id=1;
                }
                $.get('{{route('cite.get')}}/'+entrada_id+'/'+aux, function(data){ 
                    if(data == 1){
                        $('#icon').fadeIn('fast');         
                        $('#btn_save').attr('disabled', true);           
                    }      
                    else{
                        $('#icon').fadeOut('fast');
                        $('#btn_save').attr('disabled', false);
                    }
                });
            };
            input2.oninput = function() {
                var cite ="";
                var aux = '';
                var i =0;
                cite = input2.value;

                while(i < cite.length){
                    if(cite.charAt(i) == '/'){
                        aux = aux + '&';   
                    }
                    else
                    {
                        aux = aux + cite.charAt(i);
                    }
                    i++;
                }
                if(!entrada_id)
                {
                    entrada_id=1;
                }
                $.get('{{route('cite.get')}}/'+entrada_id+'/'+aux, function(data){ 
                    if(data == 1)
                    {
                        $('#icon').fadeIn('fast');         
                        $('#btn_save').attr('disabled', true);           
                    }      
                    else
                    {
                        $('#icon').fadeOut('fast');
                        $('#btn_save').attr('disabled', false);
                    }
                });
            };

            var okletra = true;
            var oknumero = true;
            var auxl=0;
            var auxn=0;
            $(document).ready(function(){

                // Por defecto muestra el formulario de "Entrada Externa"
                setTimeout(() => {
                    cambiarTipo('E');
                }, 0);

                // Si es funcionario se habilita (Interno)
                @if (auth()->user()->hasRole('funcionario'))
                    $('#toggleswitch-tipo').bootstrapToggle('on');
                @endif
                // Si no es administrador se deshabilita
                @if (!auth()->user()->hasRole('admin'))
                    $('#toggleswitch-tipo').attr('disabled', 'disabled');
                @endif

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
                        auxn =0;
                        auxl=0;
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
            $(document).on('change','.imageLength',function(){
                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;
                
                    // recuperamos la extensión del archivo
                    var ext = fileName.split('.').pop();
                    
                    // Convertimos en minúscula porque 
                    // la extensión del archivo puede estar en mayúscula
                    ext = ext.toLowerCase();
                    // console.log(ext);
                    switch (ext) {
                        case 'jpg':
                        case 'jpeg':
                        case 'png': 
                        case 'pdf': break;
                        default:
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'El archivo no tiene la extensión adecuada!'
                            })
                            this.value = ''; // reset del valor
                            this.files[0].name = '';
                    }
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

            function validarFormulario(evento) {
                evento.preventDefault();
                
                if (auxl>=2 && auxn>=5) {
                    this.submit();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "El Campo Nro. CITE tiene que tener minimo 2 letras y 5 numeros.\nEjemplo: DF-1/2022",
                    })
                    div = document.getElementById('flotante');
                    div.style.display = '';
                    return;
                }
            }

            function cambiarTipo(tipo){
                $('#input-tipo').val(tipo);
                if(tipo == 'E'){
                    $('#div-remitente').fadeOut('fast');
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
                    $('#input-remitente').fadeOut('fast');
                    $('#div-detalle').fadeIn('fast');
                    $('#div-entity_id').fadeOut('fast');
                    $('#input1').fadeIn('fast');
                    $('#input1').attr('required', 'required');
                    $('#input1').attr('name', 'cite');

                    $('#input2').fadeOut('fast');
                    $('#input2').removeAttr('required');
                    $('#input2').removeAttr('name', 'cite');
                    auxn =0;
                    auxl=0;

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