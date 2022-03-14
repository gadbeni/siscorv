
<div class="col-md-12 text-right">

        <button type="button" onclick="report_print()" class="btn btn-danger"><i class="glyphicon glyphicon-print"></i> Imprimir</button>

</div>
<div class="col-md-12">
    <div class="panel panel-bordered">
        <div class="panel-body">
            <div class="table-responsive">
                <table style="width:100%"  class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="width:5%">ID&deg;</th>
                            <th style="width:5%">HR|NCI</th>
                            <th style="width:15%">F. INGRESO</th>
                            <th style="width:25%">ORIGEN</th>
                            <th style="width:15%">REMITENTE</th>
                            <th style="width:25%">REFERENCIA</th>
                            <th style="width:10%">ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cont = 1;
                        @endphp
                        @forelse ($data as $item)
                            <tr>
                                <td style="width:5%">{{ $item->id }}</td>
                                <td style="width:5%">{{ $item->cite }}</td>                               
                                <td style="width:15%">{{date('d/m/Y H:i:s', strtotime($item->fecha_registro))}}<br><small>{{\Carbon\Carbon::parse($item->fecha_registro)->diffForHumans()}}</td>                               
                                <td style="width:25%">{{ $item->entidad }}</td>                               
                                <td style="width:15%">{{ $item->remitente }}</td>                               
                                <td style="width:25%">{{ $item->referencia }}</td>                               
                                <td style="width:10%">
                                    <a href="{{route('entradas.show', $item->id)}}" target="_blank" title="Ver" class="btn btn-sm btn-info view">
                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                    </a>
                                </td>                               
                            </tr>
                            @php
                                $cont++;
                            @endphp
                        @empty
                            <tr>
                                <td colspan="13"><h4 class="text-center">No hay resultados</h4></td>
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