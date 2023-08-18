@extends('voyager::master')

@section('page_title', 'Documentos')
@if(auth()->user()->hasPermission('browse_report_list-document'))
@section('page_header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body" style="padding: 0px">
                        <div class="col-md-8" style="padding: 0px">
                            <h1 class="page-title">
                                <i class="voyager-news"></i> Documentos
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
                                    <input type="date" name="start" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="date" name="finish" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary btn-submit" style="padding: 5px 10px"> <i class="voyager-settings"></i> Generar</button>
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
            <div id="div-results" style="min-height: 100px">
                
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .bread-actions .btn{
            margin: 5px 0px;
            padding: 5px 10px;
            font-size: 12px;
            text-decoration: none
        }
    </style>
@stop

@section('javascript')
    <script src="{{ url('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#form-search').on('submit', function(e){
                $('.btn-submit').html('<i class="voyager-settings"></i> Generando...');
                e.preventDefault();
                $('#div-results').empty();
                $.post($('#form-search').attr('action'), $('#form-search').serialize(), function(res){
                    $('#div-results').html(res);
                })
                .fail(function() {
                    toastr.error('Ocurrió un error!', 'Oops!');
                })
                .always(function() {
                    $('html, body').animate({
                        scrollTop: $("#div-results").offset().top - 70
                    }, 500);
                    $('.btn-submit').html('<i class="voyager-settings"></i> Generar');
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