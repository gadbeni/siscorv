{!! Form::open(['route' => 'exchange-search.transfer', 'id' => 'form-pagars', 'method' => 'POST']) !!}  

<div class="col-md-12 text-right">

    {{-- <button type="button" onclick="report_print()" class="btn btn-danger"><i class="glyphicon glyphicon-print"></i> Imprimir</button> --}}
    <a type="button" data-toggle="modal" data-target="#modal_solicituds" title="Enviar solicitud de trabajo" class="btn btn-success"><i class="fa-solid fa-file-export"></i> <span class="hidden-xs hidden-sm"> Transferir</span></a>

</div>

<div class="col-md-12">
    <div class="panel panel-bordered">
        <div class="panel-body">
            <div class="table-responsive">
                <table style="width:100%"  class="table dataTable table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th><label>
                                <input type="checkbox" value="" id="checkAll" onchange="toggleCheckbox(this)">
                                Marcar Todo
                            </label></th>
                            {{-- <th>Item</th> --}}
                            {{-- <th>ID</th> --}}
                            <th>HR</th>
                            <th>Fecha de derivación</th>
                            <th>Nro. de cite</th>
                            <th>Remitente</th>
                            <th>Referencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @forelse ($derivaciones as $item)
                                                    
                        @if ($item->entrada->estado_id != 6 && $item->entrada->estado_id != 4)
                            <tr class="entrada @if(!$item->visto) unread @endif" title="Ver" onclick="read({{ $item->id }})">
                                <td>
                                    <label>
                                        <input type="checkbox" name="derivation_id[]" id="{{ 'check-'.$i}}" value="{{$item->id}}">
                                    </label>
                                </td>
                                {{-- <td>{{ $i}}</td> --}}
                                {{-- <td>{{ $item->entrada->id }}</td> --}}
                                <td style="min-width: 100px !important">
                                    {{ $item->entrada->tipo.'-'.$item->entrada->gestion.'-'.$item->entrada->id }} <br>
                                    {{-- @if($item->okderivado > 0)
                                        <span class="badge badge-danger">Derivado</span>
                                    @endif --}}
                                    @if($item->derivation == 1)
                                        <span class="badge badge-danger">Derivado</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->created_at)
                                    {{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                                    @else
                                    No definida
                                    @endif
                                </td>
                                <td>{{ $item->entrada->cite }}</td>
                                <td>{{ $item->entrada->remitente }}</td>
                                <td>{{ $item->entrada->referencia }}</td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endif
                    @empty
                        
                    @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-primary fade" tabindex="-1" id="modal_solicituds" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
                 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa-solid fa-file-export"></i> Transferir Mensaje...?</h4>
            </div>
            <div class="modal-body">

                <div class="text-center" style="text-transform:uppercase">
                    <i class="fa-solid fa-file-export" style="color: rgb(87, 87, 87); font-size: 5em;"></i>
                    <br>
                    <p><b>Desea Trasferir los Mensajes...!</b></p>
                </div>
                <div class="row">   
                    <div class="col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Destino:</b></span>
                        </div>
                        <select name="people_id" id="person" class="form-control select2" required>
                            <option value=""  selected disabled>Origen</option>
                            @foreach($people as $item)
                                <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                            @endforeach
                        </select>
                    </div>                
                </div>

                <div class="row">   
                    <div class="col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Observacion:</b></span>
                        </div>
                        <textarea id="detail" class="form-control" name="detail" cols="77" rows="3"></textarea>
                    </div>                
                </div>
            </div>       
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-dark" value="Sí, Transferir Mensaje">
                {{-- <button type="button" class="btn btn-success btn-submit" onclick="sendForm('form-pagars', 'Mensaje enviado exitosamente.')">Sí, Enviar</button> --}}

            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
<script>
$(document).ready(function(){
    $('.dataTable').DataTable({
                    language: {
                        // "order": [[ 0, "desc" ]],
                        sProcessing: "Procesando...",
                        sLengthMenu: "Mostrar _MENU_ registros",
                        sZeroRecords: "No se encontraron resultados",
                        sEmptyTable: "Ningún dato disponible en esta tabla",
                        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                        sSearch: "Buscar:",
                        sInfoThousands: ",",
                        sLoadingRecords: "Cargando...",
                        oPaginate: {
                            sFirst: "Primero",
                            sLast: "Último",
                            sNext: "Siguiente",
                            sPrevious: "Anterior"
                        },
                        oAria: {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        buttons: {
                            copy: "Copiar",
                            colvis: "Visibilidad"
                        }
                    },
                    order: [[ 0, 'desc' ]],
                })
})
function toggleCheckbox(element)
    {
        var data = '{{$i}}';
        var j=0;
        if ($('#checkAll').is(':checked')) {
            
            while(j < data)
            {
                $('#check-'+j).prop('checked',true);
                j++;
            }
        }
        else
        {
            while(j < data)
            {
                $('#check-'+j).prop('checked',false);
                j++;
            }
        }

    }

</script>