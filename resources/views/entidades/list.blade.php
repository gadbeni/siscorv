<div class="col-md-12">
    <div class="table-responsive">
        <table id="dataTable" class="table dataTable table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Sigla</th>
                    <th>Nombre</th>     
                    <th>Estado</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->sigla }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td style="text-align: center">
                        @if ($item->estado=='activo')
                            <label class="label label-success">Activo</label>
                        @endif
                        @if ($item->estado=='inactivo')
                            <label class="label label-warning">Inactivo</label>
                        @endif                        
                    </td>
                    <td class="no-sort no-click bread-actions text-right">

                        @if (auth()->user()->hasPermission('read_entities'))
                            <a href="{{ route('voyager.entities.show', ['id' => $item->id]) }}" title="Ver" class="btn btn-sm btn-warning view">
                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('edit_entities'))
                            <a href="{{ route('voyager.entities.edit', ['id' => $item->id]) }}" title="Editar" class="btn btn-sm btn-primary edit">
                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                    <tr style="text-align: center">
                        <td colspan="7" class="dataTables_empty">No hay datos disponibles en la tabla</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-4" style="overflow-x:auto">
        @if(count($data)>0)
            <p class="text-muted">Mostrando del {{$data->firstItem()}} al {{$data->lastItem()}} de {{$data->total()}} registros.</p>
        @endif
    </div>
    <div class="col-md-8" style="overflow-x:auto">
        <nav class="text-right">
            {{ $data->links() }}
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