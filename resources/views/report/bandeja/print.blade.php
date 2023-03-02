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
                    REPORTE DE DOCUMENTOS RECIBIDOS<br>
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
                {{-- <th>ID</th> --}}
                <th>HR</th>
                <th style="width: 200px">Fecha de derivación</th>
                <th>Nro. de cite</th>
                <th>Remitente</th>
                <th>Referencia</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i =0;
            @endphp
            @forelse ($data as $item)
            @php
                $i++;
            @endphp
                <tr >
                    <td>{{ $i }}</td>
                    {{-- <td>{{ $item->entrada->id }}</td> --}}
                    <td style="min-width: 100px !important">
                        {{ $item->entrada->tipo.'-'.$item->entrada->gestion.'-'.$item->entrada->id }}
                    </td>
                    <td>
                        @if ($item->created_at)
                        {{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}
                        @else
                        No definida
                        @endif
                    </td>
                    <td>{{ $item->entrada->cite }}</td>
                    <td>{{ $item->entrada->remitente }}</td>
                    <td>{{ $item->entrada->referencia }}</td>
                    <td>
                        {!! $item->entrada->detalles !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
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