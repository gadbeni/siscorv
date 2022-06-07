@extends('voyager::master')

@section('page_title', 'Reporte de aniversarios')
@if(auth()->user()->hasPermission('browse_report_list-document'))
@section('page_header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body" style="padding: 0px">
                        <div class="col-md-8" style="padding: 0px">
                            <h1 class="page-title">
                                <i class="voyager-calendar"></i> Reporte
                            </h1>
                            {{-- <div class="alert alert-info">
                                <strong>Información:</strong>
                                <p>Puede obtener el valor de cada parámetro en cualquier lugar de su sitio llamando <code>setting('group.key')</code></p>
                            </div> --}}
                        </div>
                        <div class="col-md-4" style="margin-top: 30px">
                            <form name="form_search" id="form-search" action="{{ route('prinft.list-document') }}" method="POST">
                                @csrf
                                <input type="hidden" name="print">
                                <div class="form-group">
                                    {{-- Nota: En caso de obtener estos datos en más de una consulta se debe hacer un metodo para hacerlo --}}
                                    <input type="datetime-local" name="start" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="datetime-local" name="finish" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                {{-- <div class="form-group">
                                    
                                    <select name="category_id" class="form-control select2" required>
                                        <option value=""  selected disabled>Tipo Trámite</option>
                                        <option value="0">Todo los Tipo de Trámite</option>
                                        @foreach($categoria as $item)
                                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <br>
                                    <select name="origen" class="form-control select2" required>
                                        <option value=""  selected disabled>Origen</option>
                                        <option value="0">Todos los Origen</option>
                                        @foreach($entidad as $item)
                                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" style="padding: 5px 10px"> <i class="voyager-settings"></i> Generar</button>
                                </div>
                                <br>
                            </form>
                        </div>
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
            <div id="div-results" style="min-height: 100px"></div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('javascript')
    <script src="{{ url('js/main.js') }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.js"></script> -->
    <script>
        $(document).ready(function() {

            $('#form-search').on('submit', function(e){
                
                e.preventDefault();
                $('#div-results').empty();
                // alert('Generando Reporte...');

                $('#div-results').html('<div class="loading"><img src="https://w7.pngwing.com/pngs/477/964/png-transparent-wait-load" alt="loading" /><br/>Un momento, por favor...</div>');
                $('#div-results').html('<div class="loader"></div>');
                // $('#div-results').loading({message: 'Cargando...'});
                $.post($('#form-search').attr('action'), $('#form-search').serialize(), function(res){
                    $('#div-results').html(res);
                })
                .fail(function() {
                    toastr.error('Ocurrió un error!', 'Oops!');
                })
                .always(function() {
                    $('#div-results').loading('toggle');
                    $('html, body').animate({
                        scrollTop: $("#div-results").offset().top - 70
                    }, 500);
                });
            });
        });

        function report_print(){
            $('#form-search').attr('target', '_blank');
            $('#form-search input[name="print"]').val(1);
            window.form_search.submit();
            $('#form-search').removeAttr('target');
            $('#form-search input[name="print"]').val('');
        }
    </script>
@stop
@else
    @section('content')
        @include('errors.403')
    @stop
@endif