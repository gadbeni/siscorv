@extends('layouts.template-print-alt')

@section('page_title', 'Reporte')

@section('content')
@php
$months = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');    
@endphp

    <table width="100%">
        <tr>
            <td style="width: 20%"><img src="{{ asset('images/report.png') }}" alt="GADBENI" width="100px"></td>
            <td style="text-align: center;  width:70%">
                <h3 style="margin-bottom: 0px; margin-top: 5px">
                    REPORTE DE DOCUMENTOS CREADOS<br>
                </h3>
                <small style="margin-bottom: 0px; margin-top: 5px">
                    @if ($start == $finish)
                        {{ date('d', strtotime($start)) }} de {{ $months[intval(date('m', strtotime($start)))] }} de {{ date('Y', strtotime($start)) }}
                    @else
                        {{ date('d', strtotime($start)) }} de {{ $months[intval(date('m', strtotime($start)))] }} de {{ date('Y', strtotime($start)) }} Al {{ date('d', strtotime($finish)) }} de {{ $months[intval(date('m', strtotime($finish)))] }} de {{ date('Y', strtotime($finish)) }}
                    @endif
                </small>
                <br>
                <Small>
                    {{$people->first_name}}
                    {{$people->last_name}}
                </Small>
            </td>
            <td style="text-align: right; width:30%">
                <h3 style="margin-bottom: 0px; margin-top: 5px">
                   
                    <small style="font-size: 11px; font-weight: 100">Impreso por: {{ Auth::user()->name }} <br> {{ date('d/M/Y H:i:s') }}</small>
                </h3>
            </td>
        </tr>
    </table>
    <table style="width: 100%; font-size: 10px" border="1" cellspacing="0" cellpadding="4">
        <thead>
            <tr>
                <th style="width:5px">N&deg;</th>
                <th style="text-align: center">ID</th>
                <th style="text-align: center">FECHA DE REGISTRO</th>
                <th style="text-align: center">NRO DE CITE</th>
                <th style="text-align: center">REMITENTE</th>
                <th style="text-align: center">DESTINATARIO</th>
                <th style="text-align: center">REFERENCIA</th>
                <th style="text-align: center">NOTA</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=0;
            @endphp
            @forelse ($data as $item)
                <tr>
                    @php
                        $i++;
                    @endphp
                    <td>{{ $i }}</td>
                    <td>{{ $item->id }}</td>
                    <td>
                        @if ($item->created_at)
                        {{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                        @else
                        No definida
                        @endif
                    </td>
                    <td>
                        {{ $item->cite }} <br>
                    </td>
                   
                    <td>{{ $item->remitente }}</td>
                    <td>{{ $item->person ? $item->person->first_name.' '.$item->person->last_name : '' }}</td>
                    <td>{{ $item->referencia }}</td>
                    <td>
                        {!! $item->detalles !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <h5 class="text-center" style="margin-top: 50px">
                            <img src="{{ asset('images/empty.png') }}" width="120px" alt="" style="opacity: 0.5"> <br>
                            No hay resultados
                        </h5>
                    </td>
                </tr>
            @endforelse
        </tbody>
       
    </table>

@endsection
@section('css')
    <style>
        table, th, td {
            border-collapse: collapse;
        }
          
    </style>
@stop