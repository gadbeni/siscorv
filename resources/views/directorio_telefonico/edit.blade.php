@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', 'Actualizar registro Telefónico')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-telephone"></i>
        Actualizar registro Telefónico
    </h1>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="funcionario_id">Funcionario</label>
                            <select 
                                name="people_id" 
                                id="getfuncionario"
                                class="form-control">
                            </select>
                        </div>
                        {{-- <input type="" id="nombre" name="first_name"> --}}
                        {{-- <input type="" id="apellido" name="last_name"> --}}
                        <button type="button" class="btn btn-primary" id="cargarDatos">Cargar datos</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div>
                            <form action="{{route('directorio-telefonico.update', $directorio->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="cargo_responsable">Cargo responsable</label>
                                    <input type="text" class="form-control" name="cargo_responsable" id="cargo_responsable" placeholder="Cargo responsable" value="{{$directorio->cargo_responsable}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{$directorio->nombre}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="numero_interno">Telefono interno</label>
                                    <input type="text" class="form-control" name="numero_interno" id="numero_interno" placeholder="Telefono interno" value="{{$directorio->numero_interno}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="DirectorioGrupo">Directorio Grupo</label>
                                    <select name="directorio_grupo_id" id="directorio_grupo_id" class="form-control select2" required>
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($directorioGrupos as $item)
                                            <option value="{{ $item->id}}"
                                                @if ($item->id == $directorio->directorio_grupo_id)
                                                    selected
                                                @endif
                                                >
                                                {{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group hidden">
                                    <label for="DireccionAdministrativa">Dirección administrativa</label>
                                    <select name="direccion_id" id="direccion_id" class="form-control select2">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($direccionesAdministrativas as $item)
                                            <option value="{{ $item->id}}"
                                                @if ($item->id == $directorio->direccion_id)
                                                    selected
                                                @endif
                                                >{{$item->nombre}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group hidden">
                                    <label for="UnidadAdministrativa">Unidad Administrativa</label>
                                    <select name="unidad_id" id="unidad_id" class="form-control select2">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($unidadesAdministrativas as $item)
                                            <option value="{{ $item->id}}"
                                                @if ($item->id == $directorio->unidad_id)
                                                    selected
                                                @endif
                                                >{{$item->nombre}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        var tipouser = 1;
        $(document).ready(function(){
            ruta = "{{ route('user.getFuncionarioAll') }}";
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

            // button cargar datos
            $('#cargarDatos').on('click', function(){
                var data = $('#getfuncionario').select2('data')[0];
                if (data) {
                    console.log('data', data);
                    document.getElementById("cargo_responsable").value = data.cargo;
                    document.getElementById("nombre").value = data.nombre + ' ' + data.apellido;
                    // change : select2 direccion_id for data.direccion_id seleccionando la direccion administrativa que coincida
                    $('#direccion_id').val(data.direccion_id).trigger('change');

                    // change : select2 unidad_id for data.unidad_id seleccionando la unidad administrativa que coincida
                    actualizarUnidades(data.direccion_id).then(function() {
                        $('#unidad_id').val(data.unidad_id).trigger('change');
                    });
                }
            });

            // UNIDADES ADMINISTRATIVAS
            $('#direccion_id').on('change', function() {
                var direccionId = $(this).val();
                actualizarUnidades(direccionId);
            });

            function actualizarUnidades(direccionId) {
                return new Promise(function(resolve, reject) {
                    var ruta = "{{ route('directorio-telefonico.get-unidades', ['direccion_id' => ':direccionId']) }}";
                    ruta = ruta.replace(':direccionId', direccionId);
                    console.log('ruta', ruta);
                    if (direccionId) {
                        $.ajax({
                            url: ruta,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#unidad_id').empty();
                                $('#unidad_id').append('<option value="">Seleccione una opción</option>');
                                console.log('data', data);
                                $.each(data, function(key, value) {
                                    console.log('value', value);
                                    $('#unidad_id').append('<option value="' + value.id + '">' + value.nombre + '</option>');
                                });
                                $('#unidad_id').trigger('change'); // Para actualizar Select2
                                resolve();
                            },
                            error: function(error) {
                                reject(error);
                            }
                        });
                    } else {
                        $('#unidad_id').empty();
                        $('#unidad_id').append('<option value="">Seleccione una opción</option>');
                        $('#unidad_id').trigger('change'); // Para actualizar Select2
                        resolve();
                    }
                });
            }
        });
    </script>
@stop