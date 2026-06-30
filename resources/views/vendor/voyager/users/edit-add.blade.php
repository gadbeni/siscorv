@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">
    <style>
        .password-group {
            display: flex;
            align-items: stretch;
        }
        .password-group .form-control {
            flex: 1;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .password-group .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            margin: 0;
        }
    </style>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add form-submit" role="form"
              action="@if(!is_null($dataTypeContent->getKey())){{ route('update.users', $dataTypeContent->getKey()) }}@else{{ route('store.users') }}@endif"
              method="POST" enctype="multipart/form-data" autocomplete="off">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-bordered">
                    {{-- <div class="panel"> --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label">INTERNO</label>
                                <span class="voyager-question text-info pull-left" data-toggle="tooltip" data-placement="left" title=" Seleccione no si el funcionario es externo."></span>
                                <input 
                                    type="checkbox" 
                                    name="tipo"
                                    id="toggleswitch" 
                                    data-toggle="toggle" 
                                    data-on="Sí" 
                                    data-off="No"
                                    checked 
                                    >
                            </div>
                            @php
                                $personaUser = isset($dataTypeContent->id)
                                    ? \App\Models\Persona::where('user_id', $dataTypeContent->id)->where('tipo', 'user')->first()
                                    : null;
                            @endphp
                            <div class="form-group">
                                <label for="funcionario_id">Funcionario</label>
                                <select
                                    name="people_id"
                                    id="getfuncionario"
                                    class="form-control"
                                    @unless(isset($dataTypeContent->id)) required @endunless
                                    @if(isset($dataTypeContent->id)) disabled @endif>
                                    @if($personaUser && $personaUser->people_id)
                                        <option value="{{ $personaUser->people_id }}" selected>{{ $personaUser->full_name }}</option>
                                    @endif
                                </select>
                            </div>
                            <input type="hidden" id="nombre" name="first_name" value="{{ $personaUser->first_name ?? '' }}">
                            <input type="hidden" id="apellido" name="last_name" value="{{ $personaUser->last_name ?? '' }}">

                            <!-- <input type="hidden" id="ap_paterno" name="ap_paterno">
                            <input type="hidden" id="ap_materno" name="ap_materno"> -->
                            <input type="hidden" id="ci" name="ci" value="{{ $personaUser->ci ?? '' }}">
                            <!-- <input type="hidden" id="alfanum" name="alfanum">
                            <input type="hidden" name="departamento_id" id="departamento_id"> -->
                            <div class="form-group">
                                <label for="email">{{ __('Usuario') }}</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('voyager::generic.email') }}" value="{{ old('email', $dataTypeContent->email ?? '') }}" @if(isset($dataTypeContent->id)) readonly @endif>
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('voyager::generic.password') }}</label>
                                <div class="password-group">
                                    <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
                                    <button class="btn btn-default" type="button" id="togglePassword" tabindex="-1" title="Mostrar/ocultar contraseña">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @if(isset($dataTypeContent->password))
                                    <small class="text-muted">{{ __('voyager::profile.password_hint') }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">Celular</label>
                                <input type="phone" class="form-control" name="phone" value="{{ old('phone', $dataTypeContent->phone ?? '') }}">
                            </div>

                            @can('editRoles', $dataTypeContent)
                                <div class="form-group">
                                    <label for="default_role">{{ __('voyager::profile.role_default') }}</label>
                                    @php
                                        $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                        $row     = $dataTypeRows->where('field', 'user_belongsto_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                                <div class="form-group">
                                    @php
                                        if($dataTypeContent->getKey()){
                                            $user = \App\Models\User::find($dataTypeContent->id);
                                        }
                                    @endphp
                                    <label for="default_role">{{ __('Almacen') }}</label>
                                    <select name="warehouses[]" class="form-control select2">
                                        <option value="" selected>Seleccione</option>
                                        @foreach (\App\Models\Warehouse::orderBy('name')->pluck('name','id') as $id => $warehouse)
                                        @if(!is_null($dataTypeContent->getKey()))
                                            <option {{collect(old('warehouses', $user->warehouses->pluck('id')))->contains($id) ? 'selected' : ''  }} value="{{ $id }}">{{ $warehouse }} </option>
                                        @else
                                         <option value="{{ $id }}">{{ $warehouse }} </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="additional_roles">{{ __('voyager::profile.roles_additional') }}</label>
                                    @php
                                        $row     = $dataTypeRows->where('field', 'user_belongstomany_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                            @endcan

                            @if(isset($dataTypeContent->id))
                                <div class="form-group">
                                    <label class="control-label">Estado</label>
                                    <span class="voyager-question text-info pull-left" data-toggle="tooltip" data-placement="left" title="Active o desactive el acceso del usuario al sistema."></span>
                                    <input type="hidden" name="status" value="0">
                                    <input
                                        type="checkbox"
                                        name="status"
                                        id="statusswitch"
                                        value="1"
                                        data-toggle="toggle"
                                        data-on="Activo"
                                        data-off="Inactivo"
                                        data-onstyle="success"
                                        data-offstyle="danger"
                                        {{ old('status', $dataTypeContent->status ?? 1) ? 'checked' : '' }}>
                                </div>
                            @endif

                            @php
                            if (isset($dataTypeContent->locale)) {
                                $selected_locale = $dataTypeContent->locale;
                            } else {
                                $selected_locale = config('app.locale', 'en');
                            }
                            @endphp
                            
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-body">
                            <div class="form-group">
                                @if(isset($dataTypeContent->avatar))
                                    <img src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image( $dataTypeContent->avatar ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                                @endif
                                <input type="file" data-name="avatar" name="avatar">
                                @if(isset($dataTypeContent->id) && $dataTypeContent->avatar !== asset('images/usuario.png'))
                                    <div class="checkbox" style="margin-top:10px;">
                                        <label>
                                            <input type="checkbox" name="remove_avatar" value="1"> Quitar foto (usar imagen por defecto)
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary pull-right btn-submit save">
                {{ __('voyager::generic.save') }}
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>
@stop

@section('javascript')
<script src="{{ asset('js/select2.min.js')}}"></script>
<script>

    var tipouser = 1;

    $('document').ready(function () {
        $('.toggleswitch').bootstrapToggle();
        $('#toggleswitch').on('change', function() {
            if (this.checked) {
                 tipouser = 1;
            } else {
                 tipouser = 0;
            }
        });

         ruta = "{{ route('user.getFuncionario') }}";
        $('#getfuncionario').select2({
            placeholder: '<i class="fa fa-search"></i> Buscar...',
            escapeMarkup : function(markup) {
                return markup;
            },
            language: {
                inputTooShort: function (data) {
                    return `Por favor ingrese ${data.minimum - data.input.length} o más caracteres`;
                },
                noResults: function () {
                    return `<i class="far fa-frown"></i> No hay resultados encontrados`;
                }
            },
            quietMillis: 250,
            minimumInputLength: 4,
            
            ajax: {
                url: ruta,
                type: "get",
                dataType: 'json',
                data:  (params) =>  {
                    var query = {
                        search: params.term,
                        type: tipouser
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            // templateResult: formatResultLandingPage,
            templateSelection: (opt) => opt.text
        });

        $('#togglePassword').on('click', function () {
            var input = $('#password');
            var icon = $(this).find('i');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
            // mantener estilo solid en ambos estados
            icon.addClass('fas');
        });

        $('#getfuncionario').on('select2:select', function (e) {
           
            var data = e.params.data;
            if (data) {
                document.getElementById("nombre").value = data.nombre;
                document.getElementById("apellido").value = data.apellido;
                // document.getElementById("ap_materno").value = data.ap_materno;
                document.getElementById("ci").value = data.ci;
                // document.getElementById("alfanum").value = data.alfanum;
                // document.getElementById("departamento_id").value = data.departamento_id;
            }					
		});

    });
    
</script>
@stop
