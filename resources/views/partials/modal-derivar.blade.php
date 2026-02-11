{{-- Derivación modal --}}
<form class="form-submit" id="form-derivacion" action="{{ route('store.derivacion') }}" method="post">
    <div class="modal modal-primary fade" id="modal-derivar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-forward"></i> Derivar correspondencia</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
                    @if (isset($der_id))
                    <input type="hidden" name="der_id" value="{{ isset($der_id) ? $der_id : '' }}">
                    @endif
                    @if (isset($redirect))
                        <input type="hidden" name="redirect" value="{{ $redirect }}">
                    @endif
                    <div class="form-group">
                        <label class="">Destinatario <i class="voyager-info-circled" data-toggle="tooltip" data-placement="right" title="Puede elegir uno o varios destinatarios"></i></label>
                        <div class="input-group">
                            <select name="destinatarios[]" class="form-control" id="select-destinatario" multiple></select>
                            <span class="input-group-btn">
                                <input 
                                    type="checkbox"
                                    name="tipo"
                                    id="toggleswitch"
                                    data-toggle="toggle"
                                    data-on="Interno"
                                    data-off="Externo"
                                    checked 
                                >
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">Observaciones</label>
                        <textarea name="observacion" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn_block" class="btn btn-dark btn-submit">Derivar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<style>
    .toggle {
        width: 100px !important
    }
</style>

@push('javascript')
<script>
    jQuery(document).ready(function ($) {
        let ruta = "{{ route('mamore.getpeoplederivacion') }}";
        $("#select-destinatario").select2({
            maximumSelectionLength: 20,
            ajax: { 
                allowClear: true,
                url: ruta,
                type: "get",
                dataType: 'json',
                delay: 500,
                data:  (params) =>  {
                    var query = {
                        search: params.term,
                        type: destinatario_id,
                        externo: intern_externo
                    }
                    return query;
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                }
            }
        });
        $('#toggleswitch').on('change', function() {
            if (this.checked) {
                intern_externo = 1;
            } else {
                intern_externo = 0;
            }
        });
    });
</script>
@endpush