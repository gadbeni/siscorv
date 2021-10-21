@extends('voyager::master')

@section('page_title', 'Tramites')

@if(auth()->user()->hasPermission('browse_bandeja'))

    @section('content')
        <div class="page-content browse container-fluid">
            @include('voyager::alerts')
            <div class="row">
                <div class="col-md-12 div-phone">
                    <div class="panel panel-bordered">
                        <div class="panel-body">

                            <div class="alert alert-info" style="padding: 5px 10px; display: none" role="alert" id="alert-new">
                                <div class="row">
                                    <div class="col-md-8" style="margin: 0px">
                                    <p style="margin-top: 10px"><b>Atención!</b> Tienes una nueva derivación, refresca la página para actualizar la lista.</p></div>
                                    <div class="col-md-4 text-right" style="margin: 0px"><button class="btn btn-default" onclick="location.reload()">Refrescar <i class="voyager-refresh"></i></button></div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div id="tramite" class="tab-pane fade in active">
                                    <div class="table-responsive">
                                        <tramites
                                            :labels="{{json_encode([
                                                'tipo' => __("Tipo"),
                                                'cite' => __("HR|NCI"),
                                                'remitente' => __("Remitente"),
                                                'referencia' => __("Referencia"),
                                                'estado_id' => __("Estado"),
                                                ])}}"
                                                route="{{ route('tramites_json')}}"
                                            >
                                        <tramites>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('css')
        <style>
            .entrada:hover{
                cursor: pointer;
                opacity: .7;
            }
            .unread{
                background-color: rgba(9,132,41,0.2) !important
            }
        </style>
    @endsection

    @section('javascript')
        <script src="{{ asset('js/app.js')}}"></script>
    @stop
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif