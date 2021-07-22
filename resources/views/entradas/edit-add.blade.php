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
                    <form action="{{ route('entradas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Tipo</label>
                                        <select name="tipo" class="form-control select2" id="select-tipo" required>
                                            <option value="I">Interno</option>
                                            <option value="E" @if (Auth::user()->role_id != 2) disabled @endif>Externo</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Nro de cite</label>
                                        <input type="text" name="cite" maxlength="50" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Remitente</label>
                                        <div id="div-remitente">
                                            <select name="funcionario_id_remitente" class="form-control select2">
                                                <option value="{{ $funcionario ? $funcionario->funcionario_id : 844 }}">{{ $funcionario ? $funcionario->full_name : 'Admin' }}</option>
                                            </select>
                                        </div>
                                        <input type="text" name="remitente" id="input-remitente" maxlength="150" style="display: none" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Nro. de Hojas/Anexas</label>
                                        <input type="number" step="1" min="0" name="nro_hojas" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6" id="div-entity_id" style="display: none">
                                        <label class="control-label">Origen</label>
                                        <select name="entity_id" class="form-control select2">
                                            <option value="">Selecciona el origen</option>
                                            @foreach (\App\Models\Entity::where('estado', 'activo')->where('deleted_at', NULL)->get() as $item)
                                            <option value="{{ $item->id }}">{{ $item->sigla ? $item->sigla.' -' : '' }} {{ $item->nombre }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6" id="div-destinatario">
                                        <label class="control-label">Destinatario</label>
                                        <select name="funcionario_id_destino" class="form-control" id="select-funcionario_id_destino"></select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Archivos</label>
                                        <input type="file" name="archivos[]" multiple class="form-control" accept="application/pdf">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Referencia</label>
                                        <textarea name="referencia" class="form-control" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group col-md-12" id="div-detalle">
                                        {{-- <label class="control-label">Referencia</label> --}}
                                        <textarea class="form-control richTextBox" name="detalle"></textarea>
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

                $('#select-tipo').change(function(){
                    let tipo = $('#select-tipo option:selected').val();
                    if(tipo == 'E'){
                        $('#div-remitente').fadeOut();
                        $('#input-remitente').fadeIn();
                        $('#div-detalle').fadeOut();
                        $('#div-entity_id').fadeIn();
                        $('#div-destinatario').fadeOut();
                    }else{
                        $('#div-remitente').fadeIn();
                        $('#input-remitente').fadeOut();
                        $('#div-detalle').fadeIn();
                        $('#div-entity_id').fadeOut();
                        $('#div-destinatario').fadeIn();
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