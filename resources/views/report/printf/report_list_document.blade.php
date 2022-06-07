
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
                            <th style="width:5%">NRO&deg;</th>
                            <th style="width:5%">FECHA</th>
                            <th style="width:25%">DESTINATARIO</th>
                            <th style="width:25%">ORIGEN</th>
                            <th style="width:15%">REMITENTE</th>
                            <th style="width:25%">REFERENCIA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @forelse ($data as $item)
                            <tr style="text-align: center">
                                <td>{{ $count }}</td>
                                <td>{{date('d/m/Y H:i:s', strtotime($item->fecha_registro))}}</td>                               
                                <td>{{ $item->funcionario_nombre_para }} - {{ $item->funcionario_cargo_para }}</td>    
                                <td>{{ $item->origen }}</td>  
                                <td>{{ $item->remitente }}</td>                               
                                <td>{{ $item->referencia }}</td>                                                               
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @empty
                            <tr style="text-align: center">
                                <td colspan="6">No se encontraron registros.</td>
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