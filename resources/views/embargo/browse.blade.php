@extends('voyager::master')

@section('page_title', 'Viendo Ingresos')

@if(auth()->user()->hasPermission('browse_embargos'))

    @section('page_header')
        <div class="container-fluid div-phone">
            <div class="row">
                    <div class="col-md-6">
                        <h1 class="page-title">
                            <i class="fa-solid fa-square-pen"></i> Embargos
                        </h1>
                        @if(auth()->user()->hasPermission('add_embargos'))
                            <a data-toggle="modal" data-target="#myModal" class="btn btn-success btn-add-new">
                                <i class="fa-solid fa-file-import"></i> <span>Importar</span>
                            </a>
                        @endif
                    </div>
                
                <div class="col-md-6">
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
                                                <th rowspan="2" style="text-align: center">Id&deg;</th>
                                                {{-- <th rowspan="2" style="text-align: center">Nro</th> --}}
                                                {{-- <th rowspan="2" style="text-align: center">Nro Piet</th> --}}
                                                <th rowspan="2" style="text-align: center">Fecha Piet</th>
                                                <th rowspan="2" style="text-align: center">Rut / Nit</th>
                                                <th rowspan="2" style="text-align: center">Ci</th>
                                                <th rowspan="2" style="text-align: center">Nombre</th>
                                                <th colspan="2" style="text-align: center">Embargo</th>
                                                <th colspan="2" style="text-align: center">Levantamiento</th>
                                                <th rowspan="2" style="text-align: center">Estado</th>
                                                <th rowspan="2" style="text-align: right">Aciones</th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center">Monto</th>
                                                <th style="text-align: center">Nota</th>
                                                <th style="text-align: center">Monto</th>
                                                <th style="text-align: center">Nota</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($embargo as $item)
                                                <tr>
                                                    <th style="text-align: center">{{$item->id}}</th>
                                                    {{-- <th style="text-align: center">{{$item->nro}}</th> --}}
                                                    {{-- <th style="text-align: center">{{$item->nroPiet}}</th> --}}
                                                    <th style="text-align: center">{{$item->fechaPiet}}</th>
                                                    <th style="text-align: center">{{$item->rutNit}}</th>
                                                    <th style="text-align: center">{{$item->ci}}</th>
                                                    <th style="text-align: center">{{$item->nombre}}</th>
                                                    <th style="text-align: center">{{$item->montoEmbargo}}</th>
                                                    <th style="text-align: center">{{$item->notaEmbargo}}</th>
                                                    <th style="text-align: center">{{$item->montoLevantamiento}}</th>
                                                    <th style="text-align: center">{{$item->notaLevantamiento}}</th>
                                                    <td style="text-align: center">
                                                        @if ($item->status == 1)
                                                            <label class="label label-success">Activo</label>
                                                        @else
                                                            <label class="label label-danger">Inactivo</label>
                                                        @endif
                                                    </td>
                                                    <td style="text-align: right">
                                                        <div class="no-sort no-click bread-actions text-right">
                                                            @if(auth()->user()->hasPermission('read_embargos'))
                                                                <a href="{{ route('voyager.embargos.show', $item->id) }}" title="Ver" class="btn btn-sm btn-info view">
                                                                    <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                </a>
                                                            @endif
                                                            @if(auth()->user()->hasPermission('statu_embargos'))                                                            
                                                                @if($item->status == 1)
                                                                    <a data-toggle="modal" data-target="#modal-inhabilitar" title="Inhabilitar Dirección" data-id="{{$item->id}}" class="btn btn-sm btn-warning view">
                                                                        <i class="fa-solid fa-thumbs-down"></i> <span class="hidden-xs hidden-sm">Inhabilitar</span>
                                                                    </a>                                                          
                                                                @else
                                                                    <a data-toggle="modal" data-target="#modal-habilitar" title="Habilitar Dirección" data-id="{{$item->id}}" class="btn btn-sm btn-success view">
                                                                        <i class="fa-solid fa-thumbs-up"></i> <span class="hidden-xs hidden-sm">Habilitar</span>
                                                                    </a> 
                                                                @endif                                                            
                                                            @endif
                                                        </div>
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

            <form action="{{ route('embargos-embargo.excel') }}" enctype="multipart/form-data" method="post">
            @csrf
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content modal-success">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa-solid fa-file-import"></i> Importar archivo excel</h4>
                        </div>
                        <div class="modal-body">
                        <div class="form-group">
                            <input id="archivo" type="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-add-new"><i class="fa-solid fa-file-import"></i> <span>Importar archivo</span></button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </form>


            {{-- modal para inhabilitar --}}
            <div class="modal modal-warning fade" tabindex="-1" id="modal-inhabilitar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        {!! Form::open(['route' => 'embargos-list.inhabilitar', 'method' => 'POST']) !!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa-solid fa-triangle-exclamation"></i> Desea Inhabilitar?</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="text-center" style="text-transform:uppercase">
                                <i class="fa-solid fa-triangle-exclamation" style="color: #fabe28; font-size: 5em;"></i>
                                <br>
                                
                                <p><b>Desea inhabilitar el siguiente registro?</b></p>
                            </div>
                        </div>                
                        <div class="modal-footer">
                            
                                <input type="submit" class="btn btn-warning pull-right delete-confirm" value="Sí, Inhabilitar">
                            
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                        </div>
                        {!! Form::close()!!} 
                    </div>
                </div>
            </div>
           
            {{-- modal para habilitar --}}
            <div class="modal fade" tabindex="-1" id="modal-habilitar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content modal-success">
                        {!! Form::open(['route' => 'embargos-list.habilitar', 'method' => 'POST']) !!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa-solid fa-check"></i> Desea Habilitar?</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="text-center" style="text-transform:uppercase">
                                <i class="fa-solid fa-check" style="color: #42d07e; font-size: 5em;"></i>
                                <br>
                                
                                <p><b>Desea habilitar el siguiente registro?</b></p>
                            </div>
                        </div>                
                        <div class="modal-footer">
                            
                                <input type="submit" class="btn btn-success pull-right delete-confirm" value="Sí, Habilitar">
                            
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                        </div>
                        {!! Form::close()!!} 
                    </div>
                </div>
            </div>
    @stop

    @section('css')
    @stop

    @push('javascript')
        <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>
        <script src="{{ asset('vendor/loading_overlay/loadingoverlay.min.js') }}"></script>

        <script>
            $(document).ready(() => {
                $('#dataTable').DataTable({
                    language: {
                            // "order": [[ 0, "desc" ]],
                            sProcessing: "Procesando...",
                            sLengthMenu: "Mostrar _MENU_ registros",
                            sZeroRecords: "No se encontraron resultados",
                            sEmptyTable: "Ningún dato disponible en esta tabla",
                            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                            sSearch: "Buscar:",
                            sInfoThousands: ",",
                            sLoadingRecords: "Cargando...",
                            oPaginate: {
                                sFirst: "Primero",
                                sLast: "Último",
                                sNext: "Siguiente",
                                sPrevious: "Anterior"
                            },
                            oAria: {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            },
                            buttons: {
                                copy: "Copiar",
                                colvis: "Visibilidad"
                            }
                        },
                        order: [[ 0, 'desc' ]],
                });

                $('#modal-inhabilitar').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) //captura valor del data-empresa=""

                    var id = button.data('id')

                    var modal = $(this)
                    modal.find('.modal-body #id').val(id)
                    
                });
                $('#modal-habilitar').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) //captura valor del data-empresa=""

                    var id = button.data('id')

                    var modal = $(this)
                    modal.find('.modal-body #id').val(id)
                    
                });

            });

            $(document).on('change','#archivo',function(){
                // alert(2)
                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;

                if(fileSize > 5000000){
                    alert('El archivo no debe superar los 3MB');
                    this.value = '';
                    this.files[0].name = '';
                }else{
                    // recuperamos la extensión del archivo
                    var ext = fileName.split('.').pop();
                    
                    // Convertimos en minúscula porque 
                    // la extensión del archivo puede estar en mayúscula
                    ext = ext.toLowerCase();
                
                    // console.log(ext);
                    switch (ext) {
                        case 'xlsx': break;
                        default:
                            alert('El archivo no tiene la extensión adecuada');
                            this.value = ''; // reset del valor
                            this.files[0].name = '';
                    }
                }
            });
        </script>
    @endpush
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif
