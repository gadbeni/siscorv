@extends('voyager::master')

@section('page_title', 'Historial de cambios del usuario')

@php
    $avatarUrl = function ($u) {
        if (!$u || empty($u->avatar)) {
            return asset('images/usuario.png');
        }
        return filter_var($u->avatar, FILTER_VALIDATE_URL)
            ? $u->avatar
            : Voyager::image($u->avatar);
    };

    $acciones = [
        'creado'       => ['titulo' => 'Usuario creado',      'color' => '#22c55e', 'icono' => 'voyager-plus'],
        'actualizado'  => ['titulo' => 'Datos actualizados',  'color' => '#3b82f6', 'icono' => 'voyager-edit'],
        'activado'     => ['titulo' => 'Usuario activado',    'color' => '#10b981', 'icono' => 'voyager-check'],
        'desactivado'  => ['titulo' => 'Usuario desactivado', 'color' => '#f59e0b', 'icono' => 'voyager-ban'],
        'eliminado'    => ['titulo' => 'Usuario eliminado',   'color' => '#ef4444', 'icono' => 'voyager-trash'],
        'restaurado'   => ['titulo' => 'Usuario restaurado',  'color' => '#8b5cf6', 'icono' => 'voyager-refresh'],
    ];
@endphp

@section('css')
    <style>
        .hist-header {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        .hist-header img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e5e7eb;
        }
        .hist-header .hist-nombre {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }
        .hist-header .hist-email {
            color: #6b7280;
            margin: 2px 0 0;
        }
        .hist-timeline {
            position: relative;
            margin: 25px 0 0;
            padding-left: 46px;
        }
        .hist-timeline::before {
            content: '';
            position: absolute;
            left: 17px;
            top: 8px;
            bottom: 8px;
            width: 3px;
            background: #e5e7eb;
            border-radius: 3px;
        }
        .hist-evento {
            position: relative;
            margin-bottom: 28px;
        }
        .hist-punto {
            position: absolute;
            left: -46px;
            top: 0;
            width: 37px;
            height: 37px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 17px;
            box-shadow: 0 0 0 4px #fff;
        }
        .hist-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 15px 18px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        }
        .hist-titulo {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }
        .hist-fecha {
            color: #6b7280;
            font-size: 13px;
            margin: 3px 0 0;
        }
        .hist-chip-user {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f3f4f6;
            border-radius: 999px;
            padding: 3px 12px 3px 4px;
            font-size: 13px;
            margin-top: 8px;
        }
        .hist-chip-user img {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
        }
        .hist-resumen {
            margin: 12px 0 0;
            font-size: 13px;
            color: #374151;
        }
        .hist-chip-campo {
            display: inline-block;
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            border-radius: 999px;
            padding: 1px 10px;
            font-size: 12px;
            margin: 2px 2px 0 0;
        }
        .hist-tabla {
            margin-top: 12px;
            width: 100%;
            font-size: 13px;
            border-collapse: collapse;
        }
        .hist-tabla th, .hist-tabla td {
            border: 1px solid #e5e7eb;
            padding: 6px 10px;
            text-align: left;
            vertical-align: top;
        }
        .hist-tabla th {
            background: #f9fafb;
            font-weight: 600;
        }
        .hist-fila-cambio {
            background: #fefce8;
        }
        .hist-sin-cambio {
            color: #9ca3af;
        }
        .hist-antes {
            color: #dc2626;
            text-decoration: line-through;
        }
        .hist-despues {
            color: #16a34a;
            font-weight: 600;
        }
        .hist-vacio {
            text-align: center;
            padding: 40px 0;
            color: #9ca3af;
        }
    </style>
@stop

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-book"></i> Historial de cambios
        </h1>
        <a href="{{ route('voyager.users.index') }}" class="btn btn-warning">
            <i class="voyager-double-left"></i> <span>Volver a usuarios</span>
        </a>
        @if ($user->trashed() && auth()->user()->hasPermission('edit_users'))
            <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-success"
                        onclick="return confirm('¿Está seguro de restaurar este usuario?')">
                    <i class="voyager-refresh"></i> <span>Restaurar usuario</span>
                </button>
            </form>
        @endif
    </div>
@stop

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

        {{-- Cabecera con datos del usuario --}}
        <div class="panel panel-bordered">
            <div class="panel-body hist-header">
                <img src="{{ $avatarUrl($user) }}" alt="Avatar">
                <div>
                    <p class="hist-nombre">{{ $user->name }}</p>
                    <p class="hist-email">{{ $user->email }} &middot; {{ $user->role->display_name ?? 'Sin rol' }}</p>
                </div>
                <div style="margin-left:auto">
                    @if ($user->trashed())
                        <span class="label label-danger" style="font-size:13px">Eliminado</span>
                        @if ($user->deletedBy)
                            <p class="hist-fecha">por {{ $user->deletedBy->name }}</p>
                        @endif
                    @elseif ($user->status)
                        <span class="label label-success" style="font-size:13px">Activo</span>
                    @else
                        <span class="label label-danger" style="font-size:13px">Inactivo</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Linea de tiempo --}}
        <div class="panel panel-bordered">
            <div class="panel-body">
                @if ($historial->isEmpty())
                    <div class="hist-vacio">
                        <i class="voyager-book" style="font-size:40px"></i>
                        <p>Este usuario todavía no tiene eventos registrados.</p>
                    </div>
                @else
                    <div class="hist-timeline">
                        @foreach ($historial as $evento)
                            @php
                                $meta = $acciones[$evento->accion] ?? ['titulo' => ucfirst($evento->accion), 'color' => '#6b7280', 'icono' => 'voyager-list'];
                                $cambios = $evento->cambios;
                                $antes = $evento->antes ?? [];
                                $despues = $evento->despues ?? [];
                                $campos = array_unique(array_merge(array_keys($antes), array_keys($despues)));
                            @endphp
                            <div class="hist-evento">
                                <div class="hist-punto" style="background: {{ $meta['color'] }}">
                                    <i class="{{ $meta['icono'] }}"></i>
                                </div>
                                <div class="hist-card">
                                    <p class="hist-titulo">{{ $meta['titulo'] }}</p>
                                    <p class="hist-fecha">
                                        {{ $evento->created_at->isoFormat('D [de] MMMM [de] YYYY [a las] HH:mm') }}
                                        &middot; {{ $evento->created_at->diffForHumans() }}
                                    </p>

                                    <span class="hist-chip-user">
                                        <img src="{{ $avatarUrl($evento->changedBy) }}" alt="">
                                        {{ $evento->changedBy->name ?? 'Sistema' }}
                                    </span>

                                    @if ($evento->accion === 'actualizado')
                                        <p class="hist-resumen">
                                            @if (count($cambios))
                                                Se modificaron <strong>{{ count($cambios) }}</strong> {{ count($cambios) === 1 ? 'campo' : 'campos' }}:
                                                @foreach ($cambios as $campo => $valores)
                                                    <span class="hist-chip-campo">{{ $campo }}</span>
                                                @endforeach
                                            @else
                                                Se guardó sin modificaciones.
                                            @endif
                                        </p>
                                    @endif

                                    @if (count($campos))
                                        <table class="hist-tabla">
                                            <thead>
                                                <tr>
                                                    <th style="width:25%">Campo</th>
                                                    <th style="width:37%">Antes</th>
                                                    <th style="width:38%">Después</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($campos as $campo)
                                                    @php
                                                        $cambio = array_key_exists($campo, $cambios);
                                                        $valorAntes = $antes[$campo] ?? null;
                                                        $valorDespues = $despues[$campo] ?? null;
                                                    @endphp
                                                    <tr class="{{ $cambio ? 'hist-fila-cambio' : '' }}">
                                                        <td class="{{ $cambio ? '' : 'hist-sin-cambio' }}">{{ $campo }}</td>
                                                        @if ($cambio)
                                                            <td><span class="hist-antes">{{ $valorAntes ?? '—' }}</span></td>
                                                            <td><span class="hist-despues">→ {{ $valorDespues ?? '—' }}</span></td>
                                                        @else
                                                            <td class="hist-sin-cambio">{{ $valorAntes ?? '—' }}</td>
                                                            <td class="hist-sin-cambio">{{ $valorDespues ?? '—' }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-right">
                        {{ $historial->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
