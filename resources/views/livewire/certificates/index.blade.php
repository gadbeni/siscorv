@push('css')
<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css')}}">
<style>
.swal-height {
    height: 70vh;
}
.swal2-icon {
    width: 1em !important;
    height: 1em !important;
}
</style>
@endpush
<div class="page-content browse container-fluid div-phone">
    <div class="container-fluid div-phone">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="voyager-basket"></i> Registros
                </h1>
                <a href="javascript:;"
                    class="btn btn-success"
                    wire:click="nuevo"
                >
                    <i class="voyager-plus"></i> <span>Crear</span>
                </a>
            </div>
            <div class="col-md-4">
               
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="input-group mb-4" >
                                <div class="input-group-prepend">
                                    <span">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                <input type="text" wire:model="buscar" placeholder="Buscar..." class="form-control">
                            </div>
                        </div>
                    </div>
                    {{$buscar}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>CODIGO</th>
                                    <th>TIPO</th>
                                    <th>PRECIO</th>
                                    <th>CI</th>
                                    <th>NOMBRE</th>
                                    <th>REGISTRADO POR</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($certificates as $certificate)
                                    <tr>
                                        <td>{{$certificate->codigo}}</td>
                                        <td>{{$certificate->type}}</td>
                                        <td>{{$certificate->price}}</td>
                                        <td>{{$certificate->ci}}</td>
                                        <td>{{$certificate->nombre}}</td>
                                        <td>{{$certificate->usuario}}</td>
                                        <td>
                                            <a 
                                                href="{{route('certificates.imprimir', $certificate->id)}}" 
                                                class="btn btn-sm btn-primary" 
                                                target="_blank"
                                                title="Certificado">
                                                <i class="voyager-treasure-open"></i> 
                                            </a>
                                            <a href="javascript:void(0)" 
                                                onclick="Confirm('{{$certificate->id}}', 'deleteItem','Confirmas Eliminar el Registro?')"
                                                class="btn btn-sm btn-danger" 
                                                title="Delete">
                                                <i class="voyager-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr></tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $certificates->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('javascript')
<script src="{{ asset('js/sweetalert2.min.js')}}"></script>
@endpush
<script ype="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
      
        window.livewire.on('modal-eliminar', Msg => {
            $('#confirm_delete_modal').modal('hide')
            toastr.info(Msg);
        })
    })
  
    function habilitar() {
        limpiar();
        ruta = "{{route('certificados.getFuncionario')}}";
        $('#selUser').select2({
            placeholder: '<i class="fa fa-search"></i> Buscar...',
            escapeMarkup : function(markup) {
                return markup;
            },
            language: {
                inputTooShort: function (data) {
                    return `Por favor ingrese ${data.minimum - data.input.length} o más caracteres`;
                },
                noResults: function () {
                    return `<i class="far fa-frown"></i> No hay resultados encontrados`;
                }
            },
            quietMillis: 250,
            minimumInputLength: 4,
            ajax: {
                url: function (params) {
                    return `/admin/search/${escape(params.term)}`;
                },        
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            // templateResult: formatResultLandingPage,
            templateSelection: (opt) => opt.text
        });
    }

    function  limpiar() {
        $("#selUser").val(0).trigger('change');
    }
    function ShowPrice(msg) {
        
        let ruta = '';
        if (msg == "externo") {
            ruta = "{{route('certificados.getPersonas')}}";
        }else{
            ruta = "{{route('certificados.getFuncionario')}}";
        }
        
        $("#selUser").select2({
            ajax: { 
                url: ruta,
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                }
            }
        });
        var $dep = $("#departamento_id").select2();
        $('#selUser').on('select2:select', function (e) {
            var data = e.params.data;
            console.log(data)
            if (data) {
                @this.set('nombre', data.nombre);
                @this.set('ap_paterno', data.ap_paterno);
                @this.set('ap_materno', data.ap_materno);
                @this.set('ci', data.ci);
                @this.set('alfanum', data.alfanum);
                
                $("#departamento_id option").each(function(){
                    if ($(this).val() == data.departamento_id){        
                        $dep.val($(this).val()).trigger("change");
                    } 
                });   
            }					
        });
    }

    function Confirm(id,eventName,text)
    {
        // $('#confirm_delete_modal').modal('show')
        // window.livewire.emit(eventName,id)
        let me = this
        swal({
            title: 'CONFIRMAR',
            text: text,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3B3F5C',//#3B3F5C
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            closeOnConfirm: false,
            customClass: 'swal-height'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit(eventName,id)
                swal.close()
            }
        })
    }
    
</script>