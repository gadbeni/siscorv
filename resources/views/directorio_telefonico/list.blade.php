<div class="mt-5">
    @php
        $permisoEditarOBorrrar = auth()->user()->hasPermission('delete_directorio_telefonico') or auth()->user()->hasPermission('edit_directorio_telefonico')
    @endphp
    @foreach($directorio as $directorio_grupo_id => $items)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th 
                        @if($permisoEditarOBorrrar)
                            colspan="4"
                        @else
                            colspan="3"
                        @endif
                    >
                        <h4 class="text-center">{{ $items->first()->directorio_grupo->nombre }}</h4>
                    </th>
                </tr>
                <tr>
                    <th>Cargo Responsable</th>
                    <th>Nombre</th>
                    <th>Número Interno</th>
                    {{-- <th>Unidad Administrativa</th> --}}
                    @if($permisoEditarOBorrrar)
                    <th>Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->cargo_responsable }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->numero_interno }}</td>
                        {{-- <td>{{ $item->unidad_administrativa->nombre ?? 'N/A' }}</td> --}}
                        @if($permisoEditarOBorrrar)
                            <td class="no-sort no-click bread-actions text-right">
                                @if (auth()->user()->hasPermission('edit_directorio_telefonico'))
                                    <a href="{{route('directorio-telefonico.edit',$item->id)}}" title="Editar" class="btn btn-sm btn-info">
                                        <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                                    </a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_directorio_telefonico'))
                                    {{-- {{ url('admin/directorio_telefonico/'.$item->id) }} --}}
                                    <button title="Anular" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#delete_modal" onclick="deleteItem('{{route('directorio-telefonico.delete',$item->id)}}')">
                                        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                                    </button>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
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
    $('.page-link').click(function(e){
        e.preventDefault();
        let link = $(this).attr('href');
        if(link){
            page = link.split('=')[1];
            list(page);
        }
    });
</script>
<style>
    .btn-sm{
        font-size: 12px;
        padding: 5px 10px;
    }
</style>