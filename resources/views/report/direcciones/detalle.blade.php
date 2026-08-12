{{--
    Detalle de una celda del resumen. Se inyecta por AJAX dentro de la fila de la
    direccion, asi que no repite el layout: es solo el bloque.
--}}
<div class="panel panel-bordered" style="margin:0; background:#fbfbfb">
    <div class="panel-body" style="padding:10px">

        <div style="margin-bottom:8px">
            <strong>{{ $titulo }}</strong>
            <span class="text-muted">— {{ $data->total() }} {{ $data->total() == 1 ? 'registro' : 'registros' }}</span>
            <button type="button" class="btn btn-xs btn-default pull-right cerrar-detalle">
                <i class="voyager-x"></i> Cerrar
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-sm" style="width:100%; background:#fff">
                <thead>
                    <tr style="background:#f0f0f0">
                        <th style="width:5px">N&deg;</th>
                        <th style="width:95px">Fecha</th>
                        <th>Cite</th>
                        <th>Remitente</th>
                        <th>Referencia</th>
                        @if($esBandeja)
                            <th>Funcionario destino</th>
                            <th style="width:95px">Estado</th>
                        @else
                            <th style="width:95px">Estado</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $i => $item)
                        <tr>
                            <td>{{ $data->firstItem() + $i }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                            <td>
                                {{ $item->cite }}
                                @if($item->urgent)
                                    <span class="label label-danger" style="font-size:9px">URGENTE</span>
                                @endif
                            </td>
                            <td>{{ $item->remitente }}</td>
                            <td>{{ $item->referencia }}</td>
                            @if($esBandeja)
                                <td>
                                    {{ $item->funcionario_nombre_para }}
                                    @if($item->funcionario_cargo_para)
                                        <br><small class="text-muted">{{ $item->funcionario_cargo_para }}</small>
                                    @endif
                                </td>
                                <td>{{ $item->ok === 'NO' ? 'PENDIENTE' : ($item->ok === 'SI' ? 'DERIVADO' : $item->ok) }}</td>
                            @else
                                <td>{{ $item->estado }}</td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $esBandeja ? 7 : 6 }}" class="text-center text-muted" style="padding:20px">
                                No hay registros para esta celda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($data->lastPage() > 1)
            {{-- Paginado propio: los links de Laravel apuntan por GET y esto llega
                 por POST, asi que cada boton vuelve a disparar el AJAX. --}}
            <div class="text-center">
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default pagina-detalle"
                            data-pagina="{{ $data->currentPage() - 1 }}"
                            {{ $data->onFirstPage() ? 'disabled' : '' }}>&laquo;</button>

                    @foreach ($data->getUrlRange(max(1, $data->currentPage() - 2), min($data->lastPage(), $data->currentPage() + 2)) as $pagina => $url)
                        <button type="button"
                                class="btn {{ $pagina == $data->currentPage() ? 'btn-primary' : 'btn-default' }} pagina-detalle"
                                data-pagina="{{ $pagina }}">{{ $pagina }}</button>
                    @endforeach

                    <button type="button" class="btn btn-default pagina-detalle"
                            data-pagina="{{ $data->currentPage() + 1 }}"
                            {{ $data->currentPage() >= $data->lastPage() ? 'disabled' : '' }}>&raquo;</button>
                </div>
                <div><small class="text-muted">Página {{ $data->currentPage() }} de {{ $data->lastPage() }}</small></div>
            </div>
        @endif

    </div>
</div>
