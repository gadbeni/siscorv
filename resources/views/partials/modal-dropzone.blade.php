{{-- Single delete modal --}}
<div class="modal modal-success fade" tabindex="-1" id="modal-upload" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-upload"></i> {{ isset($title) ? $title : 'Agregar archivo' }}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ isset($action) ? $action : '#' }}" class="dropzone" id="my-awesome-dropzone ">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($id) ? $id : 0 }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>