@extends('layouts.template-print-legal')

@section('page_title', 'REPORTE DE INGRESOS A RDE')

@section('content')
    <div class="content">
        <table width="100%">
            <tr>
                <td><img src="{{ asset('images/icon.png') }}" alt="GADBENI" width="70px"></td>
                <td style="text-align: right">
                    <h2 style="margin-bottom: -10px; margin-top: 10px">REPORTE DE INGRESOS A RDE</h2>
                    <small>
                         <br>
                        @php
                            $months = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                        @endphp
                        {{-- <small>RECURSOS HUMANOS</small> <br> --}}
                        <small style="font-size: 11px; font-weight: 100">Impreso por: {{ Auth::user()->name }} <br> {{ date('d/M/Y H:i:s') }}</small>
                    </small>
                </td>
            </tr>
            <tr>
                <tr></tr>
            </tr>
        </table>
        <br>
        <table border="1" cellpadding="5" class="table-register">
            <thead>
                <tr>
                    <th>N&deg;</th>
                    <th>HR|NCI</th>
                    <th>FECHA</th>
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
                        <td colspan="7"><h4 class="text-center">No hay resultados</h4></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('css')
    <style>
        .content {
            padding: 0px 34px;
            font-size: 12px;
        }
        .table-register {
            width: 100%;
            border-collapse: collapse;
        }
        @media print{
            .table-register th{
                font-size: 9px
            }
            .table-register td {
                font-size: 10px
            }
        }
    </style>
@endsection

@section('script')
    <script>

    </script>
@endsection