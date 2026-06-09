@php
    $permisoEditarOBorrrar = auth()->user()->hasPermission('delete_directorio_telefonico') or auth()->user()->hasPermission('edit_directorio_telefonico')
@endphp

<style>
    .dir-grupo-card { margin-bottom: 24px; border-radius: 4px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.12); }
    .dir-grupo-header { background-color: #00874C !important; color: #fff !important; padding: 10px 16px; font-size: 15px; font-weight: 600; letter-spacing: .5px; }
    .dir-grupo-header i { margin-right: 6px; }
    .dir-grupo-table { margin-bottom: 0; }
    .dir-grupo-table thead tr th { background-color: #f5f5f5; font-size: 12px; text-transform: uppercase; color: #555; padding: 8px 12px; }
    .dir-grupo-table tbody tr:hover { background-color: #f0faf5; }
    .dir-numero { display: inline-block; background: #e8f5e9; color: #00874C; border: 1px solid #a5d6a7; border-radius: 12px; padding: 2px 10px; font-weight: 600; font-size: 13px; letter-spacing: 1px; }
    .dir-numero i { font-size: 11px; }
</style>

@foreach($directorio as $directorio_grupo_id => $items)
    <div class="dir-grupo-card">
        <div class="dir-grupo-header">
            <i class="voyager-telephone"></i>
            {{ $items->first()->directorio_grupo->nombre ?? 'Sin grupo' }}
        </div>
        <table class="table dir-grupo-table">
            <thead>
                <tr>
                    <th>Cargo Responsable</th>
                    <th>Nombre</th>
                    <th style="width:160px;">Número Interno</th>
                    @if($permisoEditarOBorrrar)
                    <th style="width:140px;" class="text-right">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->cargo_responsable }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>
                            <span class="dir-numero">
                                <i class="voyager-telephone"></i> {{ $item->numero_interno }}
                            </span>
                        </td>
                        @if($permisoEditarOBorrrar)
                            <td class="text-right" style="white-space:nowrap;">
                                @if(auth()->user()->hasPermission('edit_directorio_telefonico'))
                                    <a href="{{ route('directorio-telefonico.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="voyager-edit"></i> Editar
                                    </a>
                                @endif
                                @if(auth()->user()->hasPermission('delete_directorio_telefonico'))
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_modal"
                                        onclick="deleteItem('{{ route('directorio-telefonico.delete', $item->id) }}')">
                                        <i class="voyager-trash"></i> Borrar
                                    </button>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endforeach

<div class="row" style="margin-top:10px;">
    <div class="col-md-4">
        @if(count($data) > 0)
            <p class="text-muted">
                Mostrando del {{ $data->firstItem() }} al {{ $data->lastItem() }} de {{ $data->total() }} registros.
            </p>
        @endif
    </div>
    <div class="col-md-8 text-right">
        <nav>{{ $data->links() }}</nav>
    </div>
</div>

<script>
    $('.page-link').click(function(e){
        e.preventDefault();
        var link = $(this).attr('href');
        if(link){ list(link.split('=')[1]); }
    });
</script>
