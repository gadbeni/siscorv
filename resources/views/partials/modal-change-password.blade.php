<div class="modal modal-warning fade" tabindex="-1" id="modal-change-password" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-lock"></i> Actualice su contraseña</h4>
            </div>
            <div class="modal-body text-center">
                <div style="margin: 10px auto 20px;">
                    <span style="display:inline-block; width:90px; height:90px; line-height:90px; border-radius:50%; background:#fff3cd; color:#f0ad4e;">
                        <i class="voyager-lock" style="font-size:44px; line-height:90px;"></i>
                    </span>
                </div>
                <h4 style="margin-top:0;">¡Hola, {{ ucwords(auth()->user()->name) }}! 👋</h4>
                <p class="text-muted" style="font-size:15px; max-width:420px; margin:10px auto 0;">
                    Por tu seguridad te recomendamos cambiar tu contraseña.
                    Mientras no la cambies, este aviso volverá a aparecer cada vez que inicies sesión. 🔒
                </p>
            </div>
            <div class="modal-footer" style="text-align:center;">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="voyager-clock"></i> Más tarde
                </button>
                <a href="{{ route('voyager.users.edit', auth()->id()) }}" class="btn btn-warning">
                    <i class="voyager-edit"></i> Cambiar ahora
                </a>
            </div>
        </div>
    </div>
</div>

@push('javascript')
    <script>
        $(document).ready(function () {
            $('#modal-change-password').modal('show');
        });
    </script>
@endpush
