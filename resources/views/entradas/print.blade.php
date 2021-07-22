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
    <table width="100%" style="margin-bottom: 3px">
        <tr>
            <td width="150px">
                <img src="{{ asset('images/logo2021.png') }}" width="100px" alt="logo">
            </td>
            <td align="right">
                <h3 style="margin: 0px; margin-bottom: 10px">GOBIERNO AUTÓNOMO DEPARTAMENTAL DEL BENI <br> <small>NOTA DE COMUNICACIÓN INTERNA</small> </h3>
                <h4 class="bordered" style="padding: 5px; margin: 0px; min-width: 200px; float:right">D.A.A.I. N&deg; 124/2021</h4>
            </td>
        </tr>
    </table>
    <div class="bordered" style="margin-top: 20px">
        <table width="100%" cellspacing="10" style="font-size: 13px">
            <tr>
                <td width="50px">FECHA</td>
                <td width="20px">:</td>
                <td class="bordered">
                    17 de Julio de 2021
                </td>
            </tr>
            <tr>
                <td>A</td>
                <td>:</td>
                <td class="bordered">
                    Ing. Mario Silvio Tanaka G. <br>
                    <b>DIRECTOR DEPARTAMENTAL DE SISTEMAS Y TELECOMUNICACIONES DEL GOBIERNO AUTÓNOMO DEPARTAMENTAL DEL BENI</b>
                </td>
            </tr>
            <tr>
                <td>DE</td>
                <td>:</td>
                <td class="bordered">
                    Lic. Gustavo Pedraza B. <br>
                    <b>DIRECTOR DEPARTAMENTAL DE AUDITORÍA INTERNA</b>
                </td>
            </tr>
            <tr>
                <td>REF</td>
                <td>:</td>
                <td class="bordered">
                    <b>SOLCITUD DE HABILIATCIÓN DE USUARIO</b>
                </td>
            </tr>
        </table>
        <hr>
        <table width="100%" cellspacing="2">
            <tr>
                <td style="height: 250px" colspan="6">
                    <p style="padding: 20px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
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

    {{-- Pie de página --}}
    <div style="position: fixed; bottom: 15px; right: -20px; text-align: right">
        @php
            $persona = \App\Models\Persona::where('user_id', Auth::user()->id)->first();
        @endphp
        <p style="font-size: 12px">Fecha y hora de impresión: {{ date('d/m/Y H:i:s') }} <br> <small style="font-size: 11px">Por: {{ $persona->full_name }}</small></p>
    </div>

    <style>
        body{
            margin: 0px;
            padding: 0px
        }
        .bordered{
            border: 1px solid black
        }
    </style>
</body>
</html>