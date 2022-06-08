@extends('layouts.template-print-alt')

@section('page_title', 'Reporte')

@section('content')

    <table width="100%">
        <tr>
            <td style="width: 20%"><img src="{{ asset('images/report.png') }}" alt="GADBENI" width="100px"></td>
            <td style="text-align: center;  width:70%">
                <h3 style="margin-bottom: 0px; margin-top: 5px">
                    REPORTE DE DOCUMENTOS INGRESADOS<br>
                </h3>
            </td>
            <td style="text-align: right; width:30%">
                <h3 style="margin-bottom: 0px; margin-top: 5px">
                   
                    <small style="font-size: 11px; font-weight: 100">Impreso por: {{ Auth::user()->name }} <br> {{ date('d/M/Y H:i:s') }}</small>
                </h3>
            </td>
        </tr>
    </table>
    <br><br>
    <table style="width: 100%; font-size: 12px" border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>NRO&deg;</th>
                <th>FECHA</th>
                <th>CITE</th>
                <th>DESTINATARIO</th>
                <th>ORIGEN</th>
                <th>REMITENTE</th>
                <th>REFERENCIA</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = 1;
            @endphp
            @forelse ($data as $item)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>    
                    <td>{{ $item->cite }}</td>                            
                    <td>{{ $item->funcionario_nombre_para }} - {{ $item->funcionario_cargo_para }}</td>    
                    <td>{{ $item->origen }}</td>  
                    <td>{{ $item->remitente }}</td>                               
                    <td>{{ $item->referencia }}</td>                                                               
                </tr>
                @php
                    $count++;
                @endphp
            @empty
                <tr style="text-align: center">
                    <td colspan="6">No se encontraron registros.</td>
                </tr>
            @endforelse
            
        </tbody>
       
    </table>

@endsection