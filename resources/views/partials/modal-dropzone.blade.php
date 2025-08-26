<form class="form-submit" action="{{ isset($action) ? $action : '#' }}" method="POST" enctype="multipart/form-data">
    <div class="modal modal-success fade" tabindex="-1" id="modal-upload" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-upload"></i> {{ isset($title) ? $title : 'Agregar archivo' }}</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($id) ? $id : 0 }}">
                    {{-- <input type="file" name="file" id="" accept="application/pdf"> --}}
                    <input type="file" name="file" class="form-control imageLength" 
                        accept="image/jpeg,image/jpg,image/png,image/webp,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-submit">Subir archivo</button>
                </div>
            </div>
        </div>
    </div>
</form>