@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', 'Añadir Ingreso')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-credit-cards"></i>
        Añadir Ingreso
    </h1>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('entradas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Tipo</label>
                                    <select name="tipo" class="form-control select2" required>
                                        <option value="I">Interno</option>
                                        <option value="E">Externo</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Nro de cite</label>
                                    <input type="text" name="cite" maxlength="50" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Nro. de Hojas/Anexas</label>
                                    <input type="number" step="1" min="1" name="nro_hojas" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Origen</label>
                                    <select name="entity_id" class="form-control select2" required>
                                        <option value="">Selecciona el origen</option>
                                        @foreach (\App\Models\Entity::where('estado', 'activo')->where('deleted_at', NULL)->get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->sigla ? $item->sigla.' -' : '' }} {{ $item->nombre }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Remitente</label>
                                    <input type="text" name="remitente" maxlength="150" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Archivos</label>
                                    <input type="file" name="archivos[]" multiple class="form-control" accept="application/pdf">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Referencia</label>
                                    <textarea name="referencia" class="form-control" rows="3" required></textarea>
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

        });
    </script>
@stop
