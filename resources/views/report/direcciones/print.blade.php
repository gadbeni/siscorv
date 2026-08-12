@extends('layouts.template-print-alt')

@section('page_title', 'Reporte por Dirección')

@section('content')
@php
    $months = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    $cols   = $columnas['columnas'];
    $titulo = $columnas['titulo'];
    $total  = $columnas['total'];
    $ancho  = 2 + count($cols);
@endphp

<table width="100%">
    <tr>
        <td style="width: 20%"><img src="{{ asset('images/report.png') }}" alt="GADBENI" width="100px"></td>
        <td style="text-align: center; width:50%">
            <h3 style="margin-bottom: 0px; margin-top: 5px">
                REPORTE POR DIRECCIÓN<br>
            </h3>
            <small style="margin-bottom: 0px; margin-top: 5px">
                {{ strtoupper($titulo) }}<br>
                @if ($start == $finish)
                    {{ date('d', strtotime($start)) }} de {{ $months[intval(date('m', strtotime($start)))] }} de {{ date('Y', strtotime($start)) }}
                @else
                    {{ date('d', strtotime($start)) }} de {{ $months[intval(date('m', strtotime($start)))] }} de {{ date('Y', strtotime($start)) }}
                    Al
                    {{ date('d', strtotime($finish)) }} de {{ $months[intval(date('m', strtotime($finish)))] }} de {{ date('Y', strtotime($finish)) }}
                @endif
            </small>
        </td>
        <td style="text-align: right; width:30%">
            <h3 style="margin-bottom: 0px; margin-top: 5px">
                <small style="font-size: 11px; font-weight: 100">
                    Impreso por: {{ Auth::user()->name }} <br> {{ date('d/M/Y H:i:s') }}
                </small>
            </h3>
        </td>
    </tr>
</table>

<table style="width: 100%; font-size: 10px" border="1" cellspacing="0" cellpadding="4">
    <thead>
        <tr>
            <th rowspan="2" style="width:5px">N&deg;</th>
            <th rowspan="2">{{ $etiquetaGrupo }}</th>
            <th colspan="{{ count($cols) }}" style="text-align:center">{{ $titulo }}</th>
        </tr>
        <tr>
            @foreach ($cols as $label)
                <th style="text-align:center">{{ $label }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->grupo }}</td>
                @foreach ($cols as $key => $label)
                    <td style="text-align:center">
                        @if($key === $total)<strong>{{ $item->$key }}</strong>@else{{ $item->$key }}@endif
                    </td>
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="{{ $ancho }}" style="text-align:center">No hay resultados con esos filtros</td>
            </tr>
        @endforelse
    </tbody>
    @if($data->count())
        <tfoot>
            <tr style="font-weight:bold">
                <td colspan="2" style="text-align:right">TOTAL</td>
                @foreach ($cols as $key => $label)
                    <td style="text-align:center">{{ $totales->$key }}</td>
                @endforeach
            </tr>
        </tfoot>
    @endif
</table>

<p style="font-size: 9px; margin-top: 10px">
    @if($columnas['alerta'] === 'entradas_pendientes')
        <strong>Entradas:</strong> agrupadas por la {{ strtolower($etiquetaGrupo) }} que registró la nota;
        "Pendientes" son las creadas que todavía no se derivaron.
    @else
        <strong>Bandeja:</strong> agrupada por la {{ strtolower($etiquetaGrupo) }} que recibió la derivación;
        excluye transferidas, personerías y trámites cerrados.
    @endif
    @if(!empty($porUnidad))
        Los trámites sin unidad cargada se agrupan en "Sin unidad".
    @endif
</p>

@if(!empty($detalleExcedido))
    <p style="font-size: 10px; margin-top: 15px; border: 1px solid #000; padding: 8px">
        <strong>El detalle no se incluyó.</strong> Supera los {{ number_format($maxDetalle ?? 3000, 0, ',', '.') }}
        registros que admite una impresión. Acote el rango de fechas, elija una dirección o un estado
        concreto, y vuelva a imprimir con detalle.
    </p>
@elseif(!empty($detalles) && $detalles->isNotEmpty())
    <h4 style="margin-top: 25px; margin-bottom: 5px; border-bottom: 1px solid #000; padding-bottom: 3px">
        DETALLE DE LOS REGISTROS — {{ strtoupper($detalleEtiqueta) }}
    </h4>

    @foreach ($data as $fila)
        @php $registros = $detalles[$fila->grupo_id ?? ''] ?? collect(); @endphp

        @if($registros->count())
            <div style="margin-top: 12px; page-break-inside: auto">
                <p style="font-size: 11px; font-weight: bold; margin: 0 0 3px 0">
                    {{ $loop->iteration }}. {{ $fila->grupo }}
                    <span style="font-weight: normal">({{ $registros->count() }})</span>
                </p>

                <table style="width: 100%; font-size: 9px" border="1" cellspacing="0" cellpadding="3">
                    <thead>
                        <tr>
                            <th style="width:20px">N&deg;</th>
                            <th style="width:60px">Fecha</th>
                            <th style="width:110px">Cite</th>
                            <th>Remitente</th>
                            <th>Referencia</th>
                            @if($esBandeja)
                                <th>Funcionario destino</th>
                            @endif
                            <th style="width:70px">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registros as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    {{ $item->cite }}
                                    @if($item->urgent)<strong> (U)</strong>@endif
                                </td>
                                <td>{{ $item->remitente }}</td>
                                <td>{{ $item->referencia }}</td>
                                @if($esBandeja)
                                    <td>{{ $item->funcionario_nombre_para }}</td>
                                @endif
                                <td>
                                    @if($esBandeja)
                                        {{ $item->ok === 'NO' ? 'PENDIENTE' : ($item->ok === 'SI' ? 'DERIVADO' : $item->ok) }}
                                    @else
                                        {{ $item->estado }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endforeach

    <p style="font-size: 9px; margin-top: 10px">
        <strong>(U)</strong> marca los trámites urgentes.
    </p>
@endif
@stop
