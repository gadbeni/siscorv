$(document).on('change','.imageLength',function(){
    var file = this.files[0];
    if (!file) return;
                
    var fileName = file.name;
    var ext = fileName.split('.').pop().toLowerCase();
    var mimeType = file.type.toLowerCase();
                
    // tipo de extensiónes permitidas para enviar al controlador
    var allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
    var allowedMimeTypes = [
        'image/jpeg', 'image/png', 'image/webp',
        'application/pdf', 
        'application/msword', 
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];
                
    if (!allowedExtensions.includes(ext) || !allowedMimeTypes.includes(mimeType)) {
        $('#modal-upload').modal('hide');//Oculaltar modal al seleccionar archivo no permitido
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'El archivo no tiene el formato adecuado!'
        });
        this.value = ''; // reset del valor

        return;
    }
});