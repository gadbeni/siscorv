@extends('layouts.template-print-alt')

@section('page_title', 'Personas Externas')

@section('content')
    <table width="100%">
        <tr>
            <td style="width: 20%"><img src="{{ asset('images/report.png') }}" alt="GADBENI" width="100px"></td>
            <td style="text-align: center; width:60%">
                <h4 style="margin-bottom: 0px; margin-top: 5px">SISTEMA SISCOR</h4>
                <h3 style="margin-bottom: 0px; margin-top: 5px">
                    REPORTE DE PERSONAS EXTERNAS<br>
                </h3>
                <small style="margin-bottom: 0px; margin-top: 5px">
                    @if ($estado === 'activo')
                        Estado: Activos
                    @elseif ($estado === 'inactivo')
                        Estado: Inactivos
                    @else
                        Estado: Todos
                    @endif
                </small>
            </td>
            <td style="text-align: right; width:20%">
                <small style="font-size: 11px; font-weight: 100">Impreso por: {{ Auth::user()->name }} <br> {{ date('d/M/Y H:i:s') }}</small>
            </td>
        </tr>
    </table>
    <table style="width: 100%; font-size: 10px" border="1" cellspacing="0" cellpadding="4">
        <thead>
            <tr>
                <th style="width:5px">N&deg;</th>
                <th>C.I.</th>
                <th>Funcionario</th>
                <th>Cargo</th>
                <th>Direccion</th>
                <th>Unidad</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @forelse ($data as $item)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ optional($item->person)->ci }}</td>
                    <td>{{ optional($item->person)->first_name }} {{ optional($item->person)->middle_name }} {{ optional($item->person)->paternal_surname }} {{ optional($item->person)->maternal_surname }} {{ optional($item->person)->married_surname }}</td>
                    <td>{{ $item->cargo }}</td>
                    <td>{{ $item->direccion_nombre }}</td>
                    <td>{{ $item->unidad_nombre }}</td>
                    <td>{{ $item->status == 1 ? 'Activo' : 'Inactivo' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <h5 class="text-center" style="margin-top: 50px; text-align: center">
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
        @page {
            size: landscape;
            margin: 8mm;
        }
        table, th, td {
            border-collapse: collapse;
        }
        th {
            background-color: #1b9c85;
            color: #fff;
        }
    </style>
@stop
