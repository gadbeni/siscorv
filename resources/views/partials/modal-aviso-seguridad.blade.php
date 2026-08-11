{{-- Aviso que se muestra una vez por inicio de sesion, SOLO si el funcionario
     tiene tramites pendientes de derivar. Con la bandeja vacia no se emite nada:
     ni modal ni JS, para no interrumpir sin motivo.
     El nombre del archivo quedo de cuando el aviso era un recordatorio de
     seguridad; hoy su unico contenido son los tramites pendientes.
     Los numeros salen de Derivation::resumenPara(), la misma consulta que usa el
     tablero, para que nunca muestren cifras distintas.
     El flag de sesion lo limpia VoyagerAuthController::authenticated(). --}}

@php
    $funcionarioId = \App\Models\Persona::where('user_id', auth()->id())->value('people_id');
    $resumen       = \App\Models\Derivation::resumenPara($funcionarioId);

    $pendientes = (int) $resumen->pendientes;
    $urgentes   = (int) $resumen->urgentes;
@endphp

@if($pendientes > 0)
<div class="modal {{ $urgentes > 0 ? 'modal-danger' : 'modal-info' }} fade" tabindex="-1" id="modal-aviso-seguridad" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-mail"></i> Tiene trámites por derivar</h4>
            </div>

            <div class="modal-body text-center">
                <h4 style="margin-top:0;">¡Hola, {{ ucwords(auth()->user()->name) }}! 👋</h4>

                <p class="text-muted" style="font-size:15px; max-width:440px; margin:6px auto 18px;">
                    Estos trámites siguen vigentes y esperan que usted los derive o archive.
                </p>

                <div class="row" style="max-width:420px; margin:0 auto;">
                    <div class="{{ $urgentes > 0 ? 'col-xs-6' : 'col-xs-12' }}">
                        <div class="panel panel-bordered" style="border-left:5px solid #3498DB; margin-bottom:10px;">
                            <div class="panel-body" style="padding:14px 16px;">
                                <h5 style="margin:0 0 4px;">Pendientes</h5>
                                <h2 style="margin:0; color:#3498DB;">{{ $pendientes }}</h2>
                            </div>
                        </div>
                    </div>

                    @if($urgentes > 0)
                        <div class="col-xs-6">
                            <div class="panel panel-bordered" style="border-left:5px solid #f14646; margin-bottom:10px;">
                                <div class="panel-body" style="padding:14px 16px;">
                                    <h5 style="margin:0 0 4px;">Urgentes</h5>
                                    <h2 style="margin:0; color:#f01a1a;">{{ $urgentes }}</h2>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                @if($urgentes > 0)
                    <p style="color:#f01a1a; font-size:14px; margin:12px auto 0; max-width:440px;">
                        <i class="voyager-warning"></i>
                        {{ $urgentes == 1 ? 'Hay 1 trámite marcado como urgente.' : 'Hay '.$urgentes.' trámites marcados como urgentes.' }}
                        Revíselos primero.
                    </p>
                @endif
            </div>

            <div class="modal-footer" style="text-align:center;">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="voyager-clock"></i> Más tarde
                </button>
                <a href="{{ route('bandeja.index') }}" class="btn {{ $urgentes > 0 ? 'btn-danger' : 'btn-primary' }}">
                    <i class="voyager-mail"></i> Ir a mi bandeja
                </a>
            </div>
        </div>
    </div>
</div>

@push('javascript')
    <script>
        $(document).ready(function () {
            var $aviso = $('#modal-aviso-seguridad');

            // Recien cuando el modal se abre se lo da por visto. Marcarlo antes
            // haria que se pierda si el usuario navega sin llegar a verlo.
            $aviso.one('shown.bs.modal', function () {
                $.ajax({
                    url: '{{ route('avisos.pendientes-visto') }}',
                    type: 'POST',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
            });

            // Otros modales que tambien se abren solos al cargar la pagina:
            //   #modal-change-password  -> cuando el usuario debe cambiar su clave
            //   #comunicadoModal        -> comunicado institucional, solo en el tablero
            // Este aviso va ultimo: espera a que se cierren todos para no apilarse.
            var $previos = $('#modal-change-password, #comunicadoModal');

            if (!$previos.length) {
                $aviso.modal('show');
                return;
            }

            function mostrarCuandoNoQuedeNinguno(e) {
                if ($(e.target).is($aviso)) {
                    return;
                }

                // Bootstrap quita la clase "in" antes de disparar hidden.bs.modal,
                // asi que aca ya se puede saber si queda alguno abierto.
                if ($previos.filter('.in').length) {
                    return;
                }

                $(document).off('hidden.bs.modal', mostrarCuandoNoQuedeNinguno);
                $aviso.modal('show');
            }

            $(document).on('hidden.bs.modal', mostrarCuandoNoQuedeNinguno);
        });
    </script>
@endpush
@else
    {{-- Sin pendientes no hay nada que mostrar, pero igual hay que dar el aviso
         por consumido: si no, la consulta se repetiria en cada pantalla durante
         toda la sesion. --}}
    @push('javascript')
        <script>
            $(document).ready(function () {
                $.ajax({
                    url: '{{ route('avisos.pendientes-visto') }}',
                    type: 'POST',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
            });
        </script>
    @endpush
@endif
