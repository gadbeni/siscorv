@extends('voyager::master')

@section('page_title', 'Viendo Cargos Adicional')

@if(auth()->user()->hasPermission('browse_additional_jobs'))

    @section('page_header')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body" style="padding: 0px">
                            <div class="col-md-8" style="padding: 0px">
                                <h1 class="page-title">
                                <i class="voyager-pen"></i> Cargos Adicionales
                                </h1>
                                {{-- <div class="alert alert-info">
                                    <strong>Información:</strong>
                                    <p>Puede obtener el valor de cada parámetro en cualquier lugar de su sitio llamando <code>setting('group.key')</code></p>
                                </div> --}}
                            </div>
                            @if(auth()->user()->hasPermission('add_additional_jobs'))
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
                                            <th>Funcionario</th>
                                            <th>Cargo</th>
                                            <th>Observación</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{$item->id}}</td>
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
                        <h4 class="modal-title"><i class="voyager-plus"></i>Registrar Cargos Adicionales</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    {!! Form::open(['route' => 'additional_jobs.store','class' => 'was-validated'])!!}
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


        <div class="modal fade" role="dialog" id="delete_editar">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header btn-success">
                        <h4 class="modal-title"><i class="voyager-edit"></i>Editar Planilla</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    {!! Form::open(['route' => 'people_exts.store','class' => 'was-validated'])!!}
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>CI:</b></span>
                            </div>
                            <input type="text" class="form-control" id="ci" name="ci"required>
                            </div>
                            <div class="col-md-8">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Funcionario:</b></span>
                            </div>
                            <input type="text" class="form-control" id="funcionario" name="funcionario" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><b>Sueldo Bs:</b></span>
                                </div>
                                <input type="number" step="any" class="form-control" id="sueldo" name="sueldo" required>
                            </div>
                            <div class="col-md-8">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Cargo:</b></span>
                            </div>
                            <input type="text" class="form-control" id="cargo" name="cargo"required>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><b>Dias Trabajados:</b></span>
                                </div>
                                <input type="number" step="any" class="form-control" id="dia" name="dia" required>
                            </div>
                            <div class="col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Monto Factura:</b></span>
                            </div>
                            <input type="number" step="any" class="form-control" id="montofactura" name="montofactura"required>
                            </div> 
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><b>RC-IVA:</b></span>
                                </div>
                                <input type="number" step="any" class="form-control" id="rciva" name="rciva"required>
                            </div>                
                        </div>
                        <div class="row">    
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><b>Total:</b></span>
                                </div>
                                <input type="number" step="any" class="form-control" id="total" name="total"required>
                            </div>        
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><b>Liquido Pagable:</b></span>
                                </div>
                                <input type="number" step="any" class="form-control" id="liqpagable" name="liqpagable"required>
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

        {{-- Single delete modal --}}
        <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['route' => 'people_exts.store', 'method' => 'DELETE']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-trash"></i> Desea eliminar el siguiente registro?</h4>
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
        <script src="{{ url('js/main.js') }}"></script>
        <script>
            $(document).ready(() => {
                $('#dataTable').DataTable({
                    language
                });
            });

           

        </script>
    @stop

@else
    @section('content')
        <h1>No tienes permiso</h1>
    @stop
@endif