@php
    $hijos = $childrenMap->get($node->id, collect());
    $esActual = !$node->via && $node->ok == 'NO';
    $clases = 'deriv-node';
    if ($node->via) $clases .= ' deriv-node-via';
    elseif ($node->rechazo) $clases .= ' deriv-node-rechazo';
    if ($node->ok == 'ARCHIVADO') $clases .= ' deriv-node-archivado';
    if ($esActual) $clases .= ' deriv-node-actual';
@endphp
<li>
    <div class="{{ $clases }}">
        @if ($esActual)
            <span class="deriv-badge-actual"><i class="voyager-location"></i> La nota está aquí</span>
        @endif
        <strong class="deriv-node-nombre">{{ $node->funcionario_nombre_para }}</strong>
        @if ($node->funcionario_cargo_para)
            <small class="deriv-node-cargo">{{ $node->funcionario_cargo_para }}</small>
        @endif
        <small class="deriv-node-unidad">
            {{ $node->funcionario_direccion_para }}@if ($node->funcionario_unidad_para) — {{ Str::upper($node->funcionario_unidad_para) }}@endif
        </small>
        <div class="deriv-node-meta">
            <span class="deriv-node-fecha" title="{{ \Carbon\Carbon::parse($node->created_at)->diffForHumans() }}">
                {{ date('d/m/Y H:i', strtotime($node->created_at)) }}
            </span>
            @if ($node->via)
                <span class="label label-default">Vía</span>
            @endif
            @if ($node->rechazo)
                <span class="label label-danger">Devuelto</span>
            @endif
            @if ($node->ok == 'ARCHIVADO')
                <span class="label label-primary">Archivado</span>
            @endif
            @if ($node->visto)
                <i class="fa-solid fa-eye" style="color: rgb(9,132,41)" data-toggle="tooltip" title="Derivación abierta"></i>
            @else
                <i class="fa-solid fa-eye-slash" data-toggle="tooltip" title="Derivación no abierta"></i>
            @endif
        </div>
    </div>
    @if ($hijos->count() > 0)
        <ul>
            @foreach ($hijos as $hijo)
                @include('entradas.partials.derivation-node', ['node' => $hijo, 'childrenMap' => $childrenMap])
            @endforeach
        </ul>
    @endif
</li>
