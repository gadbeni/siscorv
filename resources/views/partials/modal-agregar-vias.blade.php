{{-- Derivación modal --}}
<form id="form-derivacion" action="{{ route('store.vias') }}" method="post">
    <div class="modal modal-primary fade" id="modal-derivar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-forward"></i> Agregar Funcionario</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
                    @if (isset($redirect))
                        <input type="hidden" name="redirect" value="{{ $redirect }}">
                    @endif
                    
                    <div class="form-group">
                        <label class="">Destinatario</label>
                        <select name="via" class="form-control" id="select-via"></select>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-dark">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="{{ asset('js/jquery-3.4.1.min.js')}}" ></script>

<script>
    $(document).ready(function () {
        ruta = "{{ route('mamore.getpeoplederivacion') }}";
        $("#select-via").select2({
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
    });
    
</script>