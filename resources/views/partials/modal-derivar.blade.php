{{-- Derivación modal --}}
<form id="form-derivacion" action="{{ route('store.derivacion') }}" method="post">
    <div class="modal modal-primary fade" tabindex="-1" id="modal-derivar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-forward"></i> Derivar correspondencia</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
                    @if (isset($redirect))
                        <input type="hidden" name="redirect" value="{{ $redirect }}">
                    @endif
                    <div class="form-group">
                        <label class="">Destinatario</label>
                        <select name="destinatario" class="form-control" id="select-destinatario">
                            @foreach ($personas as $item)
                                <option value="{{ $item->ID }}">{{ $item->PNombre }} {{ $item->APaterno }} {{ $item->AMaterno }} - CI: {{ $item->N_Carnet }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="">Observaciones</label>
                        <textarea name="observacion" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-dark">Derivar</button>
                </div>
            </div>
        </div>
    </div>
</form>