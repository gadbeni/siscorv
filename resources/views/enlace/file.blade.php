@extends('voyager::master')

@section('page_title', 'Ver Ingresos')

@if(auth()->user()->hasPermission('browse_enlacefile'))

    @section('page_header')
        <div class="col-md-6 col-xs-6" style="margin-top: 20px;">
            <a href="{{ route('voyager.enlaces.index') }}" class="btn btn-default"><i class="voyager-angle-left"></i> Volver</a>
        </div>
        <div class="col-md-6 col-xs-6 text-right" style="margin-top: 20px;">
           
        </div>
    @stop

    @section('content')
        <div class="page-content read container-fluid div-phone">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h3 class="panel-title">Archivos</h3>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            @if (auth()->user()->hasPermission('add_enlacefile'))                                                
                                                <a href="#" data-toggle="modal" data-target="#modal-upload" class="btn btn-success" style="margin: 15px;">
                                                    <span class="voyager-plus"></span>&nbsp;
                                                    Agregar nuevo
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>N&deg;</th>
                                                    <th>Título</th>
                                                    <th>Adjuntado por</th>
                                                    <th>Fecha de registro</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $cont = 1;
                                                @endphp
                                                @forelse ($enlace as $item)
                                                    <tr>
                                                        <td>{{ $cont }}</td>
                                                        <td>
                                                            {{ $item->nombre_origen }}
                                                        </td>
                                                        <td>{{ $item->user->name ?? '' }}</td>
                                                        <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br><small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></td>
                                                        <td>
                                                            @if(auth()->user()->hasPermission('read_enlacefile'))
                                                                <a href="{{ url('storage/'.$item->ruta) }}" class="btn btn-sm btn-info" target="_blank"> <i class="voyager-eye"></i> Ver</a>
                                                            @endif
                                                            @if(auth()->user()->hasPermission('delete_enlacefile'))                                                          
                                                                <button type="button" data-toggle="modal" data-target="#delete-file-modal" data-id="{{ $item->id }}" class="btn btn-danger btn-sm btn-delete-file"><span class="voyager-trash"></span></button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $cont++;
                                                    @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="6"><h5 class="text-center">No hay archivos guardados</h5></td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr style="margin:0;">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        
      

        <form action="{{ route('enlaces-file.store') }}" method="POST" class="" id="my-awesome-dropzone " enctype="multipart/form-data">
            <div class="modal modal-success fade" tabindex="-1" id="modal-upload" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="voyager-upload"></i> Agregar archivo
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="text" name="enlace_id" value="{{$enlace_id}}">
                            <input type="file" name="archivos[]" multiple class="form-control" accept="image/jpeg,image/jpg,image/png,application/pdf">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Subir archivo</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal modal-danger fade" tabindex="-1" id="delete-file-modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-trash"></i> Desea eliminar el archivo?</h4>
                    </div>
                    <div class="modal-footer">
                        <p></p>
                        <form id="delete_file_form" action="{{ route('enlaces-file.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="enlace_id" value="{{ $enlace_id }}">
                            <input type="hidden" name="id">
                            <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, eliminar">
                        </form>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

    @stop

    @section('css')
    <style>
        .select2-container {
            width: 100% !important;
        }
        /* CSS to style Treeview menu  */
        ol.tree {
                    padding: 0 0 0 30px;
                    /* width: 500px; */
            }
            .li { 
                    position: relative; 
                    margin-left: -15px;
                    list-style: none;
            }      
            .li input {
                    position: absolute;
                    left: 0;
                    margin-left: 0;
                    opacity: 0;
                    z-index: 2;
                    cursor: pointer;
                    height: 1em;
                    width: 1em;
                    top: 0;
            }
            .li input + ol {
                    background: url({{asset("/images/treeview/toggle-small-expand.png")}}) 40px 0 no-repeat;
                    margin: -1.600em 0px 8px -44px; 
                    height: 1em;
            }
            .li input + ol > .li { 
                    display: none; 
                    margin-left: -14px !important; 
                    padding-left: 1px; 
            }
            .li label {
                    background: url({{asset("/images/treeview/default.png")}}) 15px 1px no-repeat;
                    cursor: pointer;
                    display: block;
                    padding-left: 37px;
            }
            .li input:checked + ol {
                    background: url({{asset("images/treeview/toggle-small.png")}}) 40px 5px no-repeat;
                    margin: -1.96em 0 0 -44px; 
                    padding: 1.563em 0 0 80px;
                    height: auto;
            }
            .li input:checked + ol > .li { 
                    display: block; 
                    margin: 8px 0px 0px 0.125em;
            }
            .li input:checked + ol > .li:last-child { 
                    margin: 8px 0 0.063em;
            }
    </style>
    @endsection

    @section('javascript')
    <script>
        $(document).ready(function () {
        $('.btn-delete-file').click(function(){
            let id = $(this).data('id');
            $('#delete_file_form input[name="id"]').val(id);
        });
    });
    </script>
    @stop

@else
    @section('content')
        @include('errors.403')
    @stop
@endif
