
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
                            <th>N&deg;</th>
                            <th>HR|NCI</th>
                            <th>FECHA</th>
                            <th>DESTINATARIO</th>
                            <th>ORIGEN</th>
                            <th>REMITENTE</th>
                            <th>REFERENCIA</th>
                            <th>ACCION</th>
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
                                <td class="no-sort no-click bread-actions text-right">
                                    <a href="{{route('entradas.show', $item->id)}}" target="_blank" title="Ver" class="btn btn-sm btn-warning view">
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