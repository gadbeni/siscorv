<div class="table-responsive">
    <table class="dataTable table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>HR</th>
                <th style="width: 200px">Fecha de derivación</th>
                <th>Nro. de cite</th>
                <th>Remitente</th>
                <th>Referencia</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($derivaciones as $item)
                <tr class="entrada @if(!$item->visto) unread @endif" title="Ver" onclick="read({{ $item->id }})">
                    <td>{{ $item->entrada->id }}</td>
                    <td style="min-width: 100px !important">{{ $item->entrada->tipo.'-'.$item->entrada->gestion.'-'.$item->entrada->id }}</td>
                    <td>{{ date('d/m/Y H:i:s', strtotime($item->entrada->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->entrada->created_at)->diffForHumans() }}</small></td>
                    <td>{{ $item->entrada->cite }}</td>
                    <td>{{ $item->entrada->remitente }}</td>
                    <td>{{ $item->entrada->referencia }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
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
        @if(count($derivaciones)>0)
            <p class="text-muted">Mostrando del {{$derivaciones->firstItem()}} al {{$derivaciones->lastItem()}} registros.</p>
        @endif
    </div>
    <div class="col-md-8" style="overflow-x:auto">
        <nav class="text-right">
            {{ $derivaciones->links() }}
        </nav>
    </div>
</div>

