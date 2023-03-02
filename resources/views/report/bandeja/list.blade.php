
<div class="col-md-12 text-right">

    {{-- <button type="button" onclick="report_excel()" class="btn btn-success"><i class="fa-solid fa-file-excel"></i> Excel</button> --}}
    <button type="button" onclick="report_print()" class="btn btn-dark"><i class="glyphicon glyphicon-print"></i> Imprimir</button>

</div>
<div class="col-md-12">
<div class="panel panel-bordered">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="dataStyle" style="width:100%"  class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="width:5px">N&deg;</th>
                        <th>ID</th>
                        <th>HR</th>
                        <th style="width: 200px">Fecha de derivación</th>
                        <th>Nro. de cite</th>
                        <th>Remitente</th>
                        <th>Referencia</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i =0;
                    @endphp
                    @forelse ($data as $item)
                    @php
                        $i++;
                    @endphp
                        <tr >
                            <td>{{ $i }}</td>
                            <td>{{ $item->entrada->id }}</td>
                            <td style="min-width: 100px !important">
                                {{ $item->entrada->tipo.'-'.$item->entrada->gestion.'-'.$item->entrada->id }}
                            </td>
                            <td>
                                @if ($item->created_at)
                                {{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}
                                @else
                                No definida
                                @endif
                            </td>
                            <td>{{ $item->entrada->cite }}</td>
                            <td>{{ $item->entrada->remitente }}</td>
                            <td>{{ $item->entrada->referencia }}</td>
                            <td>
                                {!! $item->entrada->detalles !!}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <h5 class="text-center" style="margin-top: 50px">
                                    <img src="{{ asset('images/empty.png') }}" width="120px" alt="" style="opacity: 0.5"> <br>
                                    No hay resultados
                                </h5>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
$(document).ready(function(){

})
</script>