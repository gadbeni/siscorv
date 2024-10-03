<div class="container mt-5">
    <h2>Directorio Telefónico</h2>
    @foreach($directorio as $direccionId => $items)
        <h3>{{ $items->first()->direccion_administrativa->nombre }}</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cargo Responsable</th>
                    <th>Nombre</th>
                    <th>Número Interno</th>
                    <th>Unidad Administrativa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->cargo_responsable }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->numero_interno }}</td>
                        <td>{{ $item->unidad_administrativa->nombre ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>