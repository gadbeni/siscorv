@extends('layouts.template-print-alt')

@section('page_title', 'Reporte')

@section('content')

    <table width="100%">
        <tr>
            <td><img src="{{ asset('images/report.png') }}" alt="GADBENI" width="120px"></td>
            <td style="text-align: right">
                <h3 style="margin-bottom: 0px; margin-top: 5px">
                    REPORTE {{$name}} <br>
                   
                    {{-- <small style="font-size: 11px; font-weight: 100">Impreso por: {{ Auth::user()->name }} <br> {{ date('d/M/Y H:i:s') }}</small> --}}
                </h3>
            </td>
        </tr>
        <tr>
            <tr></tr>
        </tr>
    </table>
    <br><br>
    <table style="width: 100%; font-size: 12px" border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                            <th>N&deg;</th>
                            <th>HR|NCI</th>
                            <th>F. INGRESO</th>
                            <th>DESTINATARIO</th>
                            <th>ORIGEN</th>
                            <th>REMITENTE</th>
                            <th>REFERENCIA</th>
                   
            </tr>
        </thead>
        <tbody>
                        @php
                            $cont = 1;
                        @endphp
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $cont }}</td>
                                <td>{{ $item->cite }}</td>                               
                                <td>{{date('d/m/Y H:i:s', strtotime($item->fecha_registro))}}</td>                               
                                <td>{{ $item->first_name }} {{ $item->last_name }} <br>{{ $item->job_para }}</td>                               
                               
                                <td>{{ $item->entidad }}</td>                               
                                <td>{{ $item->remitente }}</td>                               
                                <td>{{ $item->referencia }}</td>                                
                                                            
                            </tr>
                            @php
                                $cont++;
                            @endphp
                        @empty
                            <tr>
                                <td colspan="13"><h4 class="text-center">No hay resultados</h4></td>
                            </tr>
                        @endforelse
        </tbody>
    </table>

@endsection