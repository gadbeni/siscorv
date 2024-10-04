@extends('layouts.template-print')

@section('page_title', 'Hoja de Ruta')

@section('content')
<table width="100%" style="margin-bottom: 3px">
    <tr>
        @if (setting('nci.activate_logo'))
            <td width="150px">
                <img src="{{ Voyager::image( Voyager::setting('nci.imagen'),asset('images/bicentenariobo.png')) }}" width="100px" alt="logo adicional">
            </td>
            <td>
                <h2 style="margin: 0px; margin-bottom: 10px; text-align:center">GOBIERNO AUTÓNOMO <br> DEPARTAMENTAL DEL BENI <br>
                
                </h2>
            </td>
            
            <td width="150px">
                <img src="{{ asset('images/lg.png') }}" width="100px" alt="logo">
            </td>
            
        @else
            <td width="150px">
                <img src="{{ asset('images/lg.png') }}" width="100px" alt="logo">
            </td>
        
            <td align="right">
                <h3 style="margin: 0px; margin-bottom: 10px">GOBIERNO AUTÓNOMO DEPARTAMENTAL DEL BENI <br>
                
                </h3>
            </td>
        @endif
    </tr>
</table>
<div style="margin-top: 20px; position: relative;">
    @for ($i = 0; $i < 3; $i++)
    <div class="bordered" style="margin-top: 5px">
        <table width="100%">
            <tr>
                <td width="110px" height="50px">Fecha de salidad</td>
                <td width="100px">....../....../............</td>
                <td width="50px">Hora</td>
                <td width="80px">...... : ......</td>
                <td width="100px">Recibido por: </td>
                <td></td>
            </tr>
            <tr>
                <td>A</td>
                <td class="bordered" colspan="5" height="20px"></td>
            </tr>
            <tr>
                <td>DE</td>
                <td class="bordered" colspan="5" height="20px"></td>
            </tr>
            <tr>
                <td>REF</td>
                <td class="bordered" colspan="5" height="20px"></td>
            </tr>
            <tr>
                <td height="100px" colspan="6">
                    NOTA: <br>
                    _______________________________________________________________________________________<br>
                    _______________________________________________________________________________________<br>
                    _______________________________________________________________________________________<br>
                    _______________________________________________________________________________________<br>
                </td>
            </tr>
            <tr>
                <td width="110px" height="50px">Fecha de salidad</td>
                <td width="100px">....../....../............</td>
                <td width="50px">Plazo</td>
                <td width="100px">....../....../............</td>
                <td width="90px">Firma y sello</td>
                <td></td>
            </tr>
        </table>
    </div>
    @endfor

    {{-- Pie de página --}}
    
</div>
<div style="text-align: end; position: absolute; bottom:0; right:5px">
    @php
        $persona = \App\Models\Persona::where('user_id', Auth::user()->id)->first();
    @endphp
    <p style="font-size: 12px">Fecha y hora de impresión: {{ date('d/m/Y H:i:s') }} <br>
        @if (!auth()->user()->hasRole('admin'))
            <small style="font-size: 11px">Por: {{ $persona->full_name ?? auth()->user()->name }}</small>
        @endif
    </p>
</div>

@endsection
@section('css')
<style>
    body{
        margin: 0px;
        padding: 0px
    }
    .bordered{
        border: 1px solid black
    }
</style>
@endsection