{{-- Derivación modal --}}
<form id="form-derivacion" class="form-submit" action="{{ route('store.vias') }}" method="post">
    <div class="modal modal-success fade" id="modal-derivar-via" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-forward"></i> Agregar vía</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
                    @if (isset($redirect))
                        <input type="hidden" name="redirect" value="{{ $redirect }}">
                    @endif
                    <div class="form-group">
                        <label class="">Destinatario</label>
                        <div class="input-group">
                            <select name="via[]" class="form-control" id="select-funcionario_id_destinov" multiple required></select>
                            <span class="input-group-btn">
                                <input 
                                    type="checkbox"
                                    id="toggleswitchv"
                                    data-toggle="toggle"
                                    data-on="Interno"
                                    data-off="Externo"
                                    checked
                                >
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-submit">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="{{ asset('js/jquery-3.4.1.min.js')}}" ></script>

<script>
    $(document).ready(function () {
        ruta = "{{ route('mamore.getpeople') }}";
        intern_externo=1;
        $("#select-funcionario_id_destinov").select2({
            ajax: { 
                allowClear: true,
                url: ruta,
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term, // search term
                        externo: intern_externo
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                }
            }
        });
        $('#toggleswitchv').on('change', function() {
            if (this.checked) {
                intern_externo = 1;
            } else {
                intern_externo = 0;
            }
        });
    });
    
</script>