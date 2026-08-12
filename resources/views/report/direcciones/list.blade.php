@php
    $cols   = $columnas['columnas'];
    $titulo = $columnas['titulo'];
    $color  = $columnas['color'];
    $alerta = $columnas['alerta'];
    $total  = $columnas['total'];
    $ancho  = 2 + count($cols);
@endphp

<div class="col-md-12 text-right">
    <button type="button" onclick="report_print(false)" class="btn btn-dark">
        <i class="glyphicon glyphicon-print"></i> Imprimir
    </button>
    <button type="button" onclick="report_print(true)" class="btn btn-dark"
            title="Agrega, debajo del resumen, la lista de los registros de cada dirección">
        <i class="glyphicon glyphicon-print"></i> Imprimir con detalle
    </button>
</div>

<div class="col-md-12">
    <div class="panel panel-bordered">
        <div class="panel-body">
            <div class="table-responsive">
                <table style="width:100%" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width:5px; vertical-align: middle">N&deg;</th>
                            <th rowspan="2" style="vertical-align: middle">{{ $etiquetaGrupo }}</th>
                            <th colspan="{{ count($cols) }}" class="text-center" style="background:{{ $color }}">{{ $titulo }}</th>
                        </tr>
                        <tr>
                            @foreach ($cols as $label)
                                <th class="text-center" style="background:{{ $color }}">{{ $label }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item->grupo }}</td>

                                {{-- Cada cifra mayor a cero abre el detalle de esa celda.
                                     data-columna es la clave que el controlador usa para
                                     saber que registros listar; data-grupo identifica la
                                     fila (direccion o unidad, segun el nivel). --}}
                                @foreach ($cols as $key => $label)
                                    <td class="text-center">
                                        @if($item->$key > 0)
                                            <a href="#" class="celda-detalle"
                                               data-fila="{{ $i }}"
                                               data-grupo="{{ $item->grupo_id }}"
                                               data-direccion="{{ $direccionId }}"
                                               data-por-unidad="{{ $porUnidad ? 1 : 0 }}"
                                               data-columna="{{ $key }}"
                                               data-titulo="{{ $item->grupo }} · {{ $label }}"
                                               title="Ver los registros">
                                                @if($key === $alerta)
                                                    <strong style="color:#d9534f">{{ $item->$key }}</strong>
                                                @elseif($key === $total)
                                                    <strong>{{ $item->$key }}</strong>
                                                @else
                                                    {{ $item->$key }}
                                                @endif
                                            </a>
                                        @else
                                            <span class="text-muted">{{ $item->$key }}</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                            <tr class="fila-detalle" id="detalle-fila-{{ $i }}" style="display:none">
                                <td colspan="{{ $ancho }}" style="padding:0; border-top:0"></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $ancho }}">
                                    <h5 class="text-center" style="margin-top: 50px">
                                        <img src="{{ asset('images/empty.png') }}" width="120px" alt="" style="opacity: 0.5"> <br>
                                        No hay resultados con esos filtros
                                    </h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if($data->count())
                        <tfoot>
                            <tr style="background:#f5f5f5; font-weight:bold">
                                <td colspan="2" class="text-right">TOTAL</td>
                                @foreach ($cols as $key => $label)
                                    <td class="text-center">{{ $totales->$key }}</td>
                                @endforeach
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>

            <small class="text-muted">
                @if($alerta === 'entradas_pendientes')
                    <strong>Entradas:</strong> agrupadas por la {{ strtolower($etiquetaGrupo) }} que registró la nota.
                    "Pendientes" son las creadas que todavía no se derivaron.
                @else
                    <strong>Bandeja:</strong> agrupada por la {{ strtolower($etiquetaGrupo) }} que recibió la derivación.
                    Excluye transferidas, personerías y trámites cerrados, igual que la bandeja del funcionario.
                @endif
                <br>
                Con un estado concreto elegido en los filtros, no se listan las filas que
                quedan en cero en las columnas mostradas.
                @if($porUnidad)
                    <br>
                    La unidad no está cargada en todos los trámites; los que no la tienen se agrupan
                    en <strong>Sin unidad</strong>. Los totales cierran igual con los de la dirección.
                @endif
            </small>
        </div>
    </div>
</div>
