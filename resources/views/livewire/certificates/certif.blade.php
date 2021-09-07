<html mmoznomarginboxes="" mozdisallowselectionprint="">
    <head>
        <title>CERT</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/print.style.css') }}" media="print">
        <style type="text/css">
            html
            {
                background-color: #FFFFFF; 
                margin: 0px;  /* this affects the margin on the html before sending to printer */
            }
            body {
                font-size: 14px !important;
            }
            table {
                font-size: 14px !important;
            }
            .centrar{
                width: 240mm;
                margin-left: auto;
                margin-right: auto;
                /*border: 1px solid #777;*/
                display: grid;
                padding: 10mm !important;
                -webkit-box-shadow: inset 2px 2px 46px 1px rgba(209,209,209,1);
                -moz-box-shadow: inset 2px 2px 46px 1px rgba(209,209,209,1);
                box-shadow: inset 2px 2px 46px 1px rgba(209,209,209,1);
            }

            /*For each sections*/
            .box-section {
                margin-top: 1mm;
                border: 1px solid #000;
                padding: 8px;
            }
            .alltables {
                width: 100%;
            }
            .alltables td{
                padding: 2px;
            }
            .box-margin {
                border: 1px solid #000;
                width: 120px;
            }
            .caja {
                padding-left: 10px;
                padding-right: 10px;
            }
            .codeqr {
                text-align: right;
            }
            .timbre {
                background-color: lightgrey;
                width: 165px;
                height: 205px;
                border: 1px solid black;
                padding: 5px;
                margin: 5px;
            }
        </style>
    </head>
    <body>
        <div class="noImprimir text-center">
            <button onclick="javascript:window.print()" class="btn btn-link">
                IMPRIMIR
            </button>
        </div>
        <div class="centrar">
            <div id="marcaAgua">
                <div id="encabezado" style="padding:1">
                @php
                    $qr = 'Codigo:'.$certificado->codigo.' '.'Costo Certificado:'.$certificado->price.' '.'Tipo Certificado:'.$certificado->type.' '.'Monto Deuda:'.number_format($certificado->monto_deuda, 2, '.', '').' '.'Carnet Beneficiario:'.$certificado->ci;
                 @endphp
                <table class="alltables">
                    <thead>
                        <th>
                            <strong>CODIGO: {{$certificado->codigo}}</strong>
                            @if ($certificado->price > 0)
                                <h3><strong>Bs.{{$certificado->price}}</strong> </h3>
                            @endif
                        </th>
                        <th>
                            <table class="alltables">
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <img src="{{ asset('images/logo2021.png') }}" width="150px">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <span style="line-height: 8px; font-size: 14px;">
                                        <strong>GOBIERNO AUTONOMO DEPARTAMENTAL DEL BENI </strong>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <span style="line-height: 8px; font-size: 14px;">
                                        <strong>SECRETARIA DEPARTAMENTAL DE ADMINISTRACION Y FINANZAS </strong>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <span style="line-height: 8px; font-size: 14px;">
                                        <strong>BENI-BOLIVIA </strong>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </th>
                        <th class="timbre codeqr">
                            
                        </th>
                    </thead>
                </table>
                    {{-- ENCABEZADO --}}
                    <br><br><br>
                    {{-- Primera seccion --}}
                    <div class="caja">
                        <div class="text-center">
                            <H1>CERTIFICADO DE NO ADEUDO</H1><br>
                            <h6>RESOLUCION DE GOBERNACION N° 137/2018</h6>
                        </div>
                        <br>
                        <div>
                            <p>
                                LA SECRETARIA DEPARTAMENTAL DE ADMINISTRACION FINANZAS, DEL GOBIERNO AUTONOMO DEPARTAMENTAL DEL BENI, A TRAVEZ DE LA SECCION CIERRE DE CARGO DEPENDIENTE DE LA UNIDAD DE CONTABILIDAD;
                            </p>
                            <br>
                            <H3><strong>CERTIFICA:</strong></H3>
                            <br>
                            @php
                                $alfanumerico = ($certificado->alfanum) ? '-'.$certificado->alfanum : ''; 
                            @endphp
                            <p>
                               Que revisado los archivos contables ingresados al sistema de gestion Pública (SIGEP) 
                               a la fecha de presentación del presente documento; se constata que el (la) ciudadano (a): 
                            </p>
                        </div>
                        <br>
                        <div class="text-center">
                            <strong>
                                <h3>
                                  <strong>{{$certificado->full_name}}</strong> 
                                </h3>
                            </strong>
                            <strong>{{$certificado->ci}}{{$alfanumerico}} {{$certificado->sigla}}</strong>
                        </div><br><br>
                        <p>
                            <strong>{{$certificado->descripcion}}</strong>
                        </p>
                    </div>
                    <br>
                    <br>
                    <br>
                    <table class="alltables text-center">
                        <tr>
                            <td class="">
                            {!! QrCode::size(105)->generate("$qr"); !!}
                            </td>
                            <td class="" style="padding-top: 60px;">
                                <p>---------------------------------</p>
                                <b>Firma o Sello</b>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <br>
                    <div class="text-center">
                        <p style="font-size: 13px;"><b>NOTA:</b>El presente informe queda nulo y sin valor legal alguno si contiene enmiendas,
                            borrones o superposiciones.</p>
                    </div>
                    <br>
                    <div>
                        <table style="width: 100%;">
                            <tr>
                                <td class="text-left" style="font-size: 10px;"></td>
                                <td class="text-right" style="font-size: 10px;">{{ 'Fecha y hora de impresión: ' . date('d/m/Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>