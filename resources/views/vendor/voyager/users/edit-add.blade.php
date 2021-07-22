@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
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
                                <label for="funcionario_id">Funcionario</label>
                                <select 
                                    name="funcionario_id" 
                                    id="getfuncionario"
                                    class="form-control">
                                </select>
                            </div>
                            <input type="hidden" id="nombre" name="nombre">
                            <input type="hidden" id="ap_paterno" name="ap_paterno">
                            <input type="hidden" id="ap_materno" name="ap_materno">
                            <input type="hidden" id="ci" name="ci">
                            <input type="hidden" id="alfanum" name="alfanum">
                            <input type="hidden" name="departamento_id" id="departamento_id">
                            <div class="form-group">
                                <label for="email">{{ __('Usuario') }}</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('voyager::generic.email') }}"
                                       value="{{ old('email', $dataTypeContent->email ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('voyager::generic.password') }}</label>
                                @if(isset($dataTypeContent->password))
                                    <br>
                                    <small>{{ __('voyager::profile.password_hint') }}</small>
                                @endif
                                <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right save">
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
    $('document').ready(function () {
        $('.toggleswitch').bootstrapToggle();

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
                url: function (params) {
                    let url = '{{ url("admin/search/") }}'
                    return `${url}/${escape(params.term)}`;
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

        $('#getfuncionario').on('select2:select', function (e) {
           
				var data = e.params.data;
                 console.log(data)
				if (data) {
					document.getElementById("nombre").value = data.nombre;
					document.getElementById("ap_paterno").value = data.ap_paterno;
					document.getElementById("ap_materno").value = data.ap_materno;
					document.getElementById("ci").value = data.ci;
                    document.getElementById("alfanum").value = data.alfanum;
                    document.getElementById("departamento_id").value = data.departamento_id;
				}					
			});
    });
</script>
@stop
