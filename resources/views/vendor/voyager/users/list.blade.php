<div class="table-responsive">
    <table id="dataTable" class="table table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th style="width: 180px">Creado</th>
                <th>Celular</th>
                <th>Role</th>
                <th>Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        @if ($item->created_at)
                            {{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br>
                            <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                        @else
                            No definida
                        @endif
                    </td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->role->display_name ?? '' }}</td>
                    <td>
                        @if ($item->status)
                            <label class="label label-success">Activo</label>
                        @else
                            <label class="label label-danger">Inactivo</label>
                        @endif
                    </td>
                    <td class="no-sort no-click bread-actions text-right">
                        <a href="{{ route('voyager.users.show', $item->id) }}" title="Ver" class="btn btn-sm btn-warning view">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                        </a>
                        <a href="{{ route('voyager.users.edit', $item->id) }}" title="Editar" class="btn btn-sm btn-info">
                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                        </a>
                        <a href="{{ route('users.historial', $item->id) }}" title="Historial" class="btn btn-sm btn-primary">
                            <i class="voyager-book"></i> <span class="hidden-xs hidden-sm">Historial</span>
                        </a>
                        @if ($item->status)
                            <a href="{{ route('users.toggle-status', $item->id) }}" title="Desactivar" class="btn btn-sm btn-dark">
                                <i class="voyager-ban"></i> <span class="hidden-xs hidden-sm">Desactivar</span>
                            </a>
                        @else
                            <a href="{{ route('users.toggle-status', $item->id) }}" title="Activar" class="btn btn-sm btn-success">
                                <i class="voyager-check"></i> <span class="hidden-xs hidden-sm">Activar</span>
                            </a>
                        @endif
                        <button title="Borrar" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#delete_modal" onclick="deleteItem('{{ url('admin/users/' . $item->id) }}')">
                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                        </button>
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

<div class="col-md-12">
    <div class="col-md-4" style="overflow-x:auto">
        @if (count($data) > 0)
            <p class="text-muted">Mostrando del {{ $data->firstItem() }} al {{ $data->lastItem() }} de {{ $data->total() }} registros.</p>
        @endif
    </div>
    <div class="col-md-8" style="overflow-x:auto">
        <nav class="text-right">
            {{ $data->links() }}
        </nav>
    </div>
</div>

<script>
    $('.page-link').click(function(e) {
        e.preventDefault();
        let link = $(this).attr('href');
        if (link) {
            page = link.split('=')[1];
            list(page);
        }
    });
</script>
