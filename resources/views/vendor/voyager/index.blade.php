@extends('voyager::master')

@section('page_title', 'Inicio')

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12 div-phone">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{ Str::upper('Hola, '.Auth::user()->name) }}</h3>
                            </div>
                            @php
                                $funcionario = App\Models\Persona::where('user_id', Auth::user()->id)->first();
                                $derivaciones = App\Models\Derivation::where('people_id_para', $funcionario ? $funcionario->people_id : null)
                                                ->whereHas('entrada', function($q){
                                                    $q->whereNotIn('estado_id', [4, 6]);
                                                })
                                                ->get();
                            @endphp
                            <div class="col-md-4">
                                <div class="panel panel-bordered panel-option" style="border-left: 5px solid #52BE80">
                                    <div class="panel-body" style="height: 100px;padding: 15px 20px">
                                        <div class="col-md-9">
                                            <h5>Derivaciones</h5>
                                            <h2>{{ $derivaciones->count() }}</h2>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <i class="icon voyager-mail" style="color: #52BE80"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-bordered panel-option" style="border-left: 5px solid #3498DB">
                                    <div class="panel-body" style="height: 100px;padding: 15px 20px">
                                        <div class="col-md-9">
                                            <h5>Pendientes</h5>
                                            <h2>{{ $derivaciones->where('visto', NULL)->where('ok', 'NO')->count() }}</h2>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <i class="icon voyager-bell" style="color: #3498DB"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-bordered panel-option" style="border-left: 5px solid #f14646">
                                    <div class="panel-body" style="height: 100px;padding: 15px 20px">
                                        <div class="col-md-9">
                                            <h5>Urgentes</h5>
                                            <h2>{{ $derivaciones->where('visto', NULL)->where('ok', 'NO')->where('entrada.urgent', 1)->count() }}</h2>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <i class="icon voyager-warning" style="color: #f01a1a"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection

 @section('css')
    <style>
        .icon{
            font-size: 35px
        }
        /* .panel-option {
            cursor: pointer;
        } */
        .panel-option:hover {
            background: rgb(247, 247, 247);
            border: 1px solid rgb(228, 228, 228);
        }
    </style>
@endsection