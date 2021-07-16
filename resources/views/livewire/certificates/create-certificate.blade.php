@section('page_header')
    <h1 class="page-title">
        <i class="voyager-certificate"></i>
        {{$componentName}} | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR'}}
    </h1>
@stop
@push('css')
<link rel="stylesheet" href="{{ asset('css/select2.min.css')}}" type="text/css">
@endpush
<div class="page-content container-fluid">
    <div class="row">
        <div class="panel panel-bordered">
            @if ($printcertificate)
            <div class="panel-body">
                <div class="text-center">
                    <a href="{{route('certificates.imprimir',$certId)}}"
                        class="btn btn-info"
                        target="_blank"
                    >
                        <i class="voyager-receipt"></i> <span>IMPRIMIR</span>
                    </a>
                </div>
            </div>
            @else
            <div class="panel-body">
                <div class="col-sm-6">
                    <div class="radio" id="miradio">
                        <label>
                            <input 
                                type="radio" 
                                wire:model="type" 
                                value="interno" 
                                wire:click="calcularprecio"
                            />
                            Interno
                        </label>
                        &nbsp;
                        <label>
                        <input 
                            type="radio" 
                            wire:model="type" 
                            value="externo" 
                            wire:click="calcularprecio"
                        />
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
                    <input type="number" id="deuda" class="form-control" wire:model.lazy="deuda" wire:keyup.enter="agregardeuda" readonly/>
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
                        <input type="text" class="form-control" id="nombre" wire:model="nombre">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Apellido Paterno</label>
                        <input type="text" class="form-control" id="ap_paterno" wire:model="ap_paterno">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Apellido Materno</label>
                        <input type="text" class="form-control" id="ap_materno" wire:model="ap_materno">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>CI</label>
                        <input type="text" class="form-control" id="ci" wire:model="ci">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>AlfaNum</label>
                        <input type="text" class="form-control" id="alfanum" wire:model="alfanum">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <label>Expedido:</label>
                    <select wire:model="departamento_id" id="departamento_id" name="departamento_id" class="form-control">
                        <option value='0'>-- Select Depto --</option>
                        @foreach($departamentos as $dep)
                        <option value='{{$dep->id}}'>{{$dep->name}}</option>
                        @endforeach
                    </select>
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
                        LIMPIAR
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
            @endif
        </div>
    </div>
</div>
@push('javascript')
<script src="{{ asset('js/select2.min.js') }}"></script>
@endpush
<script>
    var tipo = '';
document.addEventListener('livewire:load', function () {
    tipo = @this.get('type');
    ShowPrice(tipo);
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
                    @this.set('departamento_id', data.departamento_id); 
                    @this.set('funcionarioId' ,data.id);   
                    //$dep.val($(this).val()).trigger("change");
                } 
            }); 
            
        }					
    });
})
document.addEventListener('DOMContentLoaded', function () {
        
        window.livewire.on('certificate-added', msg => {
            toastr.info(msg)
        });

        window.livewire.on('hability-getpersons', Msg => {
            ShowPrice(Msg);
        });

        window.livewire.on('show-deuda', checkd => {
            if (checkd == true) {
                 document.getElementById("deuda").readOnly = false;
            } else{
                document.getElementById("deuda").readOnly = true;
            }                     
        });
        
})
    
    function  limpiar() {
        $('#selUser').val(0).trigger('change');
		$('#departamento_id').val(0).trigger('change');
    }
    function ShowPrice(msg) {
        limpiar();
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
    }
</script>
