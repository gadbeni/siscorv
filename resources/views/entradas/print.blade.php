<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hoja de rura</title>
    <!-- Favicon -->
    <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
    @if($admin_favicon == '')
        <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/png">
    @else
        <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
    @endif
</head>
<body>
    @if($entrada->urgent)
     <div id="watermark">
        <img src="{{ asset('images/urgente.jpg') }}" height="100%" width="100%" /> 
    </div>
    @endif
    <table width="100%" style="margin-bottom: 3px">
        <tr>
            <td width="150px">
                <img src="{{ asset('images/lg.png') }}" width="100px" alt="logo">
            </td>
            <td align="right">
                <h3 style="margin: 0px; margin-bottom: 8px">GOBIERNO AUTÓNOMO DEPARTAMENTAL DEL BENI <br> 
                    @if($entrada->tipo == 'E')
                    <small>HOJA DE RUTA N°:</small>
                    @else
                     <small>NOTA DE COMUNICACIÓN INTERNA</small> 
                    @endif
                </h3>
                <h4 class="bordered" style="margin-top: 20px; min-width: 200px; float:right">&nbsp;&nbsp;{{ $entrada->tipo.'-'.$entrada->cite }}&nbsp;&nbsp;</h4>
            </td>
        </tr>
    </table>
    <div class="bordered" style="margin-top: 8px; padding-button: 3px">
        <table width="100%" cellspacing="10" style="font-size: 13px">
            <tr>
                <td width="30px">FECHA</td>
                <td width="3px">:</td>
                <td width="20px" class="bordered">{{ date('d/m/Y', strtotime($entrada->created_at)) }}</td>
                @if($entrada->tipo == 'E')
                <td width="10px">HORA</td>
                <td width="3px">:</td>
                <td width="20px" class="bordered">{{ date('H:i', strtotime($entrada->created_at)) }}</td>
                <td width="70px">Nº HOJAS</td>
                <td width="3px">:</td>
                <td class="bordered">{{ $entrada->nro_hojas }}</td>
                @endif
            </tr>
            <tr>
                <td width="30px">{{($entrada->tipo == 'E') ? 'DESTINATARIO' : 'A'}}</td>
                <td>:</td>
                <td class="bordered" colspan="7">
                    {{$entrada->derivaciones[0]->funcionario_nombre_para }}. <br>
                    <b>{{$entrada->derivaciones[0]->funcionario_cargo_para }}</b>
                </td>
            </tr>
            <tr>
                <td>{{($entrada->tipo == 'E') ? 'ORIGEN' : 'DE'}}</td>
                <td>:</td>
                <td class="bordered" colspan="7">
                    {{$entrada->entity->nombre}}.
                </td>
            </tr>
            @if($entrada->tipo == 'E')
            <tr>
                <td width="50px">REMITENTE</td>
                <td>:</td>
                <td class="bordered" colspan="7">
                    {{$entrada->remitente}}.
                </td>
            </tr>
            @endif
            <tr>
                <td>REF</td>
                <td>:</td>
                <td class="bordered" colspan="7">
                    <b>{{$entrada->referencia}}</b>
                </td>
            </tr>
        </table>
        <table width="100%" cellspacing="2">
            <tr>
                <td style="height: 70px" colspan="6">
                    <p style="padding: 20px"></p>
                </td>
            </tr>
            <tr>
                <td width="110px" height="30px">Fecha de salidad</td>
                <td width="100px">{{ date('d/m/Y', strtotime($entrada->derivaciones[0]->created_at)) }}</td>
                <td width="50px">Plazo</td>
                <td width="100px">{{ $entrada->deadline ? date('d/m/Y', strtotime($entrada->deadline)) : '....../....../............' }}</td>
                <td width="90px">Firma y sello</td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="bordered" style="margin-top: 8px">
        <table width="100%">
            <tr>
                <td width="110px" height="40px">Fecha de salidad</td>
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
                    _______________________________________________________________________________________<br>
                </td>
            </tr>
            <tr>
                <td width="110px" height="30px">Fecha de salidad</td>
                <td width="100px">....../....../............</td>
                <td width="50px">Plazo</td>
                <td width="100px">....../....../............</td>
                <td width="90px">Firma y sello</td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="bordered" style="margin-top: 8px">
        <table width="100%">
            <tr>
                <td width="110px" height="40px">Fecha de salidad</td>
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
                    _______________________________________________________________________________________<br>
                </td>
            </tr>
            <tr>
                <td width="110px" height="30px">Fecha de salidad</td>
                <td width="100px">....../....../............</td>
                <td width="50px">Plazo</td>
                <td width="100px">....../....../............</td>
                <td width="90px">Firma y sello</td>
                <td></td>
            </tr>
        </table>
    </div>
    {{-- Pie de página --}}
    <div style="position: fixed; bottom: 15px; right: -20px; text-align: right">
        @php
            $persona = \App\Models\Persona::where('user_id', Auth::user()->id)->first();
        @endphp
        <p style="font-size: 12px">Fecha y hora de impresión: {{ date('d/m/Y H:i:s') }} <br> <small style="font-size: 11px">Por: {{ $persona->full_name ?? auth()->user()->name }}</small></p>
    </div>

    <style>
        body{
            margin: 0px;
            padding: 0px
        }
        .bordered{
            border: 1px solid black
        }
        #watermark {
                position: fixed;
                opacity: 0.3;
                /** 
                    Establece una posición en la página para tu imagen
                    Esto debería centrarlo verticalmente
                **/
                bottom:   10cm;
                left:     5.5cm;

                /** Cambiar las dimensiones de la imagen **/
                width:    8cm;
                height:   8cm;

                /** Tu marca de agua debe estar detrás de cada contenido **/
                z-index:  -1000;
            }
    </style>
</body>
</html>