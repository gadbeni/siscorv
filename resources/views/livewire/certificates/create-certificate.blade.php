@section('page_header')
    <h1 class="page-title">
        <i class="voyager-certificate"></i>
        {{$componentName}} | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR'}}
    </h1>
@stop
<div class="page-content container-fluid">
    <div class="row">
        <div class="panel panel-bordered">
            <div class="panel-body">
                <div class="col-sm-6">
                    <div class="radio" id="miradio">
                        <label>
                            <input type="radio" wire:model="type" value="interno" wire:click="calcularprecio"/>
                            Interno
                        </label>
                        &nbsp;
                        <label>
                        <input type="radio" wire:model="type" value="externo" wire:click="calcularprecio"/>
                            Externo
                        </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="radio">
                        <label>
                            <input type="checkbox" wire:model="checkdeuda"  wire:click="showdeuda"/>
                                Deuda
                        </label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <label>Precio</label>
                    <input type="text" id="price" class="form-control" wire:model="price" readonly/>
                </div>
                <div class="col-sm-12 col-md-2">
                    <label>Deuda</label>
                    <input type="text" id="deuda" class="form-control" wire:model.lazy="deuda" readonly/>
                </div>
                <div class="col-sm-12 col-md-8">
                    <label>Beneficiario</label>
                    <div wire:ignore class="form-group">
                        <!-- For defining autocomplete -->
                        <select id="selUser" name="selUser" class="form-control">
                            <option value='0'>-- Select persona --</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" wire:model="nombre" readonly>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Apellido Paterno</label>
                        <input type="text" class="form-control" wire:model="ap_paterno" readonly>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Apellido Materno</label>
                        <input type="text" class="form-control" wire:model="ap_materno" readonly>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>CI</label>
                        <input type="text" class="form-control" wire:model="ci" readonly>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>AlfaNum</label>
                        <input type="text" class="form-control" wire:model="alfanum" readonly>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12">
                    <label class="custom-file-label">Descripcion</label>
                    <textarea class="form-control" wire:model="descripcion" rows="4" value="{{$descripcion}}"></textarea>
                    @error('descripcion')
                        <span class="text-danger er">{{ $message}}</span>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-12">
                    <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info" data-dismiss="modal">
                        CERRAR
                    </button>
                    @if($selected_id < 1)
                    <button type="button" wire:click.prevent="Store()" class="btn btn-success">
                        GUARDAR
                    </button>
                    @else
                    <button type="button" wire:click.prevent="Update()" class="btn btn-success">
                        ACTUALIZAR
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var tipo = '';
document.addEventListener('livewire:load', function () {
    tipo = @this.get('type');
    ShowPrice(tipo);
})
document.addEventListener('DOMContentLoaded', function () {
        
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });

        window.livewire.on('hability-getpersons', Msg => {
            ShowPrice(Msg);
        });

        window.livewire.on('show-deuda', checkd => {
            if (checkd) {
                 document.getElementById("deuda").readOnly = false;
            } else{
                document.getElementById("deuda").readOnly = true;
            }                     
        });
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
</script>
