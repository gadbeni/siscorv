<html mmoznomarginboxes="" mozdisallowselectionprint="">
    <head>
        <title>HR</title>
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
                border: 1px solid #000;
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
                    {{-- ENCABEZADO --}}
                    <table class="alltables text-center">
                        <tbody>
                            <tr>
                                <td><img src="{{ asset('images/lg.png') }}" width="100px"></td>
                                <td>
                                    <table class="alltables">
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <h4 style="font-size: 27px;"><strong>GOBIERNO AUTONOMO DEPARTAMENTAL DEL BENI</strong></h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" style="width: 45%">
                                                <span style="line-height: 8px; font-size: 25px;">
                                                    <strong>REPORTE DE TRAMITES</strong>
                                                </span>
                                            </td>
                                            
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="box-section">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>HR|CITE</th>
                                    <th>ORIGEN</th>
                                    <th>REMITENTE</th>
                                    <th>FECHA INGRESO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $item->cite}}</td>
                                        <td>{{ $item->entity->nombre ?? $item->remitente}}</td>
                                        <td>{{ $item->remitente}}</td>
                                        <td>
                                            {{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br> 
                                            <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>SIN DATOS</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- end section body --}}

                    <div class="text-center">
                        <p style="font-size: 13px;"><b>NOTA:</b> Este reporte muestra los tramites a 3 dias de expiracion desde la fecha actual.</p>
                    </div>
                    <div>
                        <table style="width: 100%;">
                            <tr>
                                <td class="text-left" style="font-size: 10px;">{{ 'Imprimido por: ' . auth()->user()->name }}</td>
                                <td class="text-right" style="font-size: 10px;">{{ 'Fecha y hora de impresión: ' . date('d/m/Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>