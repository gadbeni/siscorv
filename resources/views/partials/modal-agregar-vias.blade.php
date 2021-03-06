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
                    
                    {{-- <div class="form-group">
                        <label class="">Destinatario</label>
                        <select name="via" class="form-control" id="select-via"></select>
                    </div> --}}

                    <div class="form-group">
                        <label class="control-label">INTERNO</label>
                        <span class="voyager-question text-info pull-left" data-toggle="tooltip" data-placement="left" title="Seleccione no si el funcionario no depende de la gobernacion."></span>
                        <input 
                            type="checkbox" 
                            
                            id="toggleswitch" 
                            data-toggle="toggle" 
                            data-on="Interno" 
                            data-off="Externo"
                            checked 
                        >
                    </div>


                    <div class="form-group" id="div-destinatario" >
                        <label class="control-label">Destinatario</label> &nbsp;
                        {{-- <input 
                        type="checkbox" 
                        
                        id="toggleswitch" 
                        data-toggle="toggle" 
                        data-on="Interno" 
                        data-off="Externo"
                        checked 
                        > --}}
                        <select name="via" class="form-control" id="select-funcionario_id_destino" style="text-transform: uppercase;"></select>
                        
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
        // ruta = "{{ route('mamore.getpeoplederivacion') }}";
        // $("#select-via").select2({
        //     ajax: { 
        //         allowClear: true,
        //         url: ruta,
        //         type: "get",
        //         dataType: 'json',
        //         delay: 500,
        //         data:  (params) =>  {
        //             var query = {
        //                 search: params.term,
        //                 type: destinatario_id,
        //                 externo: intern_externo
        //             }
        //             return query;
        //         },
        //         processResults: function (response) {
        //             return {
        //                 results: response
        //             };
        //         }
        //     }
        // });


        ruta = "{{ route('mamore.getpeople') }}";
                intern_externo=1;
                $("#select-funcionario_id_destino").select2({
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
                $('#toggleswitch').on('change', function() {
                    if (this.checked) {
                        intern_externo = 1;
                    } else {
                        intern_externo = 0;
                    }
                });
    });
    
</script>