
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
                        <th style="text-align: center">ID</th>
                        <th style="text-align: center">FECHA DE REGISTRO</th>
                        <th style="text-align: center">NRO DE CITE</th>
                        <th style="text-align: center">REMITENTE</th>
                        <th style="text-align: center">DESTINATARIO</th>
                        <th style="text-align: center">REFERENCIA</th>
                        <th style="text-align: center">NOTA</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @forelse ($data as $item)
                        <tr>
                            @php
                                $i++;
                            @endphp
                            <td>{{ $i }}</td>
                            <td>{{ $item->id }}</td>
                            <td>
                                @if ($item->created_at)
                                {{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                                @else
                                No definida
                                @endif
                            </td>
                            <td>
                                {{ $item->cite }} <br>
                            </td>
                           
                            <td>{{ $item->remitente }}</td>
                            <td>{{ $item->person ? $item->person->first_name.' '.$item->person->last_name : '' }}</td>
                            <td>{{ $item->referencia }}</td>
                            <td>
                                {!! $item->detalles !!}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
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