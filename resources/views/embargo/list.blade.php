<div class="col-md-12">
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th colspan="5"></th>
                    <th colspan="2" class="text-center">Embargo</th>
                    <th colspan="2" class="text-center">Levantamiento</th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Fecha Piet</th>
                    <th>RUT/NIT</th>
                    <th>CI</th>
                    <th>Nombre</th>
                    <th>Monto</th>
                    <th>Nota</th>
                    <th>Monto</th>
                    <th>Nota</th>
                    <th>Estado</th>
                    <th rowspan="2" style="text-align: right">Aciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($embargo as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->fechaPiet }}</td>
                        <td>{{ $item->rutNit }}</td>
                        <td>{{ $item->ci }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->montoEmbargo }}</td>
                        <td>{{ $item->notaEmbargo }}</td>
                        <td>{{ $item->montoLevantamiento }}</td>
                        <td>{{ $item->notaLevantamiento }}</td>
                        <td>
                            @if ($item->status == 1)
                                <label class="label label-success">Activo</label>
                            @else
                                <label class="label label-danger">Inactivo</label>
                            @endif
                        </td>
                        <td style="text-align: right">
                            <div class="no-sort no-click bread-actions text-right">
                                @if(auth()->user()->hasPermission('read_embargos'))
                                    <a href="{{ route('voyager.embargos.show', $item->id) }}" title="Ver" class="btn btn-sm btn-warning view">
                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                    </a>
                                @endif
                                @if(auth()->user()->hasPermission('statu_embargos'))                                                            
                                    @if($item->status == 1)
                                        <a data-toggle="modal" data-target="#modal-inhabilitar" title="Inhabilitar Dirección" data-id="{{$item->id}}" class="btn btn-sm btn-danger view">
                                            <i class="fa-solid fa-thumbs-down"></i> <span class="hidden-xs hidden-sm">Inhabilitar</span>
                                        </a>                                                          
                                    @else
                                        <a data-toggle="modal" data-target="#modal-habilitar" title="Habilitar Dirección" data-id="{{$item->id}}" class="btn btn-sm btn-success view">
                                            <i class="fa-solid fa-thumbs-up"></i> <span class="hidden-xs hidden-sm">Habilitar</span>
                                        </a> 
                                    @endif                                                            
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach                      
            </tbody>
        </table>
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-4" style="overflow-x:auto">
        @if(count($embargo)>0)
            <p class="text-muted">Mostrando del {{$embargo->firstItem()}} al {{$embargo->lastItem()}} de {{$embargo->total()}} registros.</p>
        @endif
    </div>
    <div class="col-md-8" style="overflow-x:auto">
        <nav class="text-right">
            {{ $embargo->links() }}
        </nav>
    </div>
</div>

<script>
    var page = "{{ request('page') }}";
    $(document).ready(function(){
        $('.page-link').click(function(e){
            e.preventDefault();
            let link = $(this).attr('href');
            if(link){
                page = link.split('=')[1];
                list(page);
            }
        });
    });
</script>