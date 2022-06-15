@extends('voyager::master')

@section('page_title', 'Viendo People')

@if(auth()->user()->hasPermission('browse_people_exts'))

    @section('page_header')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body" style="padding: 0px">
                            <div class="col-md-8" style="padding: 0px">
                                <h1 class="page-title">
                                <i class="voyager-people"></i> Persona Externa
                                </h1>
                                {{-- <div class="alert alert-info">
                                    <strong>Información:</strong>
                                    <p>Puede obtener el valor de cada parámetro en cualquier lugar de su sitio llamando <code>setting('group.key')</code></p>
                                </div> --}}
                            </div>
                            @if(auth()->user()->hasPermission('add_people_exts'))
                                <div class="col-md-4 text-right" style="margin-top: 30px">
                                    <a type="button" data-toggle="modal" data-target="#modalRegistrar" class="btn btn-success">
                                        <i class="voyager-plus"></i> <span>Crear</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('content')
        <div class="page-content browse container-fluid">
            @include('voyager::alerts')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id&deg;</th>
                                            <th>C.I.</th>
                                            <th>Funcionario</th>
                                            <th>Cargo</th>
                                            <!-- <th>Direccion</th>
                                            <th>Unidad</th> -->
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->person->ci}}</td>
                                                    <td>{{$item->person->first_name}} {{$item->person->last_name}}</td>
                                                    <td>{{$item->cargo}}</td>
                                                    <td>{{$item->observacion}}</td>
                                                    <td>
                                                        @if ($item->status == 0)
                                                            <label class="label label-danger">Inactivo</label>
                                                        @else
                                                            <label class="label label-success">Activo</label>
                                                        @endif
                                                    </td>
                                                    <th style="text-align: right">
                                                        @if ($item->status == 1)
                                                            <a href="" data-toggle="modal" data-target="#modalBaja" data-id="{{$item->id}}" class="btn btn-sm btn-warning">
                                                                <i class="voyager-edit"></i> <span>Baja</span>
                                                            </a>
                                                            <a href="" data-toggle="modal" data-target="#modalDelete" data-id="{{$item->id}}" class="btn btn-sm btn-danger">
                                                                <i class="voyager-trash"></i> <span>Eliminar</span>
                                                            </a>
                                                        @endif
                                                        
                                                    </th>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Modal -->
        <div class="modal fade" role="dialog" id="modalRegistrar">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header btn-success">
                        <h4 class="modal-title"><i class="voyager-plus"></i>Registrar Personal Externo</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    {!! Form::open(['route' => 'people_exts.store','class' => 'was-validated'])!!}
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>Persona:</b></span>
                                    </div>
                                    <select name="person_id" class="form-control select2" required>
                                        <option value="">Seleccione una opcion</option>
                                        @foreach($people as $data)
                                            <option value="{{$data->id}}">{{$data->first_name}} {{$data->last_name}}</option>
                                        @endforeach
                                    </select>          
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>Direccion:</b></span>
                                    </div>
                                    <select name="direccion_id" class="form-control select2" required>
                                        <option value="">Seleccione una opcion</option>
                                        @foreach($direcciones as $data)
                                            <option value="{{$data->id}}">{{$data->nombre}}</option>
                                        @endforeach
                                    </select>          
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>Unidad:</b></span>
                                    </div>
                                    <select name="unidad_id" class="form-control select2" required>
                                        <option value="">Seleccione una opcion</option>
                                        @foreach($unidades as $data)
                                            <option value="{{$data->id}}">{{$data->nombre}}</option>
                                        @endforeach
                                    </select>          
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><b>Cargo:</b></span>
                                </div>
                                <input type="text" class="form-control" id="cargo" name="cargo" required>
                            </div>                      
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><b>Observación:</b></span>
                                </div>
                                <textarea name="observacion" id="observacion" class="form-control" rows="3"></textarea>
                            </div>             
                        </div>    
                        
                        
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-between">
                        <button type="button text-left" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Volver">Cancelar
                        </button>
                        <button type="submit" class="btn btn-success btn-sm" title="Registrar..">
                            Registrar
                        </button>
                    </div>
                    {!! Form::close()!!} 
                    
                </div>
            </div>
        </div>


        <div class="modal fade" role="dialog" id="modalBaja">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header btn-warning">
                        <h4 class="modal-title"><i class="voyager-edit"></i> Dar de Baja</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    {!! Form::open(['route' => 'people_exts.baja', 'class' => 'was-validated'])!!}
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="text-center" style="text-transform:uppercase">
                            <i class="voyager-warning" style="color: orange; font-size: 5em;"></i>
                            <br>
                            <p><b>Dar de Baja....!</b></p>
                        </div>                      
                        
                        
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-between">
                        <button type="button text-left" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Volver">Cancelar
                        </button>
                        <button type="submit" class="btn btn-warning btn-sm" title="Baja..">
                            Baja
                        </button>
                    </div>
                    {!! Form::close()!!} 
                    
                </div>
            </div>
        </div>

        <div class="modal fade modal-danger" tabindex="-1" id="modalDelete" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['route' => 'people_exts.delete', 'method' => 'DELETE']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-trash"></i> Eliminar</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">

                        <div class="text-center" style="text-transform:uppercase">
                            <i class="voyager-trash" style="color: red; font-size: 5em;"></i>
                            <br>
                            
                            <p><b>Desea eliminar el siguiente registro?</b></p>
                        </div>
                    </div>                
                    <div class="modal-footer">
                        
                            <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, eliminar">
                        
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                    {!! Form::close()!!} 
                </div>
            </div>
        </div>
    @stop

    @section('css')

    @stop

    @section('javascript')
        {{-- <script src="{{ url('js/main.js') }}"></script> --}}
        <script>
            $(document).ready(() => {
                $('#dataTable').DataTable({
                    language
                });
            });

            $('#modalBaja').on('show.bs.modal', function (event) {
                // alert('hola');
                var button = $(event.relatedTarget) 

                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
            });

            $('#modalDelete').on('show.bs.modal', function (event) {
                // alert('hola');
                var button = $(event.relatedTarget) 

                var id = button.data('id')
                // alert(34)

                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
            });
           

        </script>
    @stop

@else
    @section('content')
        <h1>No tienes permiso</h1>
    @stop
@endif