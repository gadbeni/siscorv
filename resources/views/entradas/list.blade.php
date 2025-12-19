<div class="table-responsive">
    <table id="dataTable" class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                {{-- <th>Tipo</th> --}}
                <th style="width: 200px">Fecha de registro</th>
                <th>Nro. de cite</th>
                <th>Origen</th>
                <th>Remitente</th>
                <th>Destinatario</th>
                <th>Referencia</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    {{-- <td>{{ $item->tipo == 'I' ? 'Interna' : 'Externa' }}</td> --}}
                    <td>
                        @if ($item->created_at)
                        {{ date('d/m/Y H:i:s', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                        @else
                        No definida
                        @endif
                        @if ($item->personeria== 1)
                            <br>
                            <label class="label label-info">Personeria Juridica</label>
                        @endif
                    </td>
                    <td>
                        {{ $item->cite }} <br>
                        {!! $item->tipo == 'I' ? '<label class="label label-info">Interna</label>' : '<label class="label label-success">Externa</label>' !!}
                    </td>
                    <td>
                        @if ($item->tipo == 'E')
                            {{ $item->entity->nombre ?? 'Sin entidad' }}
                        @else
                            {{ $item->direccion_nombre }} {{ $item->unidad_nombre }}
                        @endif
                    </td>
                    <td>{{ $item->remitente }}</td>
                    <td>{{ $item->person_full_name }}</td>
                    <td>{{ $item->referencia }}</td>
                    <td>{{ $item->estado->nombre }}</td>
                    <td class="no-sort no-click bread-actions text-right">
                        {{-- @if ($item->derivaciones_count == 0)
                            <button data-toggle="modal" data-target="#modal-derivar" onclick="derivacionItem({{ $item->id }}, {{ $item->people_id_para }})" title="Derivar" class="btn btn-sm btn-dark view" style="border: 0px">
                                <i class="voyager-forward"></i> <span class="hidden-xs hidden-sm">Derivar</span>
                            </button>
                        @endif --}}
                        @if (auth()->user()->hasRole('admin'))
                            <button title="Cambio de fecha del trámite" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal-change-date" onclick="dateItem('{{ route('entradas-date.update', ['id'=>$item->id]) }}')">
                                <i class="voyager-calendar"></i> <span class="hidden-xs hidden-sm">Cambiar fecha</span>
                            </button>
                        @endif
                        <a href="{{ route('entradas.show', ['entrada' => $item->id]) }}" title="Ver" class="btn btn-sm btn-warning view">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                        </a>
                        @if ($item->derivaciones_count == 0 || auth()->user()->hasRole('admin'))
                        <a href="{{ route('entradas.edit', ['entrada' => $item->id]) }}" title="Editar" class="btn btn-sm btn-info">
                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                        </a>
                        @endif
                        
                        @if ($item->derivaciones_count <= 1)
                        <button title="Anular" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#delete_modal" onclick="deleteItem('{{ url('admin/entradas/'.$item->id) }}')">
                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Anular</span>
                        </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">
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
        @if(count($data)>0)
            <p class="text-muted">Mostrando del {{$data->firstItem()}} al {{$data->lastItem()}} registros.</p>
        @endif
    </div>
    <div class="col-md-8" style="overflow-x:auto">
        <nav class="text-right">
            {{ $data->links() }}
        </nav>
    </div>
</div>

