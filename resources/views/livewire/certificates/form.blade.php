@include('common.modalHeader')
<div class="row">
    <div class="col-sm-6">
        <div class="radio" id="miradio">
            <label>
                <input type="radio" name="type" value="interno" onclick="habilitar()"/>
                Interno
            </label>
            &nbsp;
            <label>
            <input type="radio" name="type" value="externo"/>
                Externo
            </label>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="radio">
            <label>
                <input type="checkbox" wire:model="checkdeuda"  wire:click="showdeuda"/>
                    Deuda
            </label>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <label>Precio</label>
        <input type="text" id="price" class="form-control" wire:model="price"/>
    </div>
    <div class="col-sm-12 col-md-6">
        <label>Deuda</label>
        <input type="text" id="deuda" class="form-control" wire:model="deuda" readonly/>
    </div>
    <div class="col-sm-12 col-md-12">
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
</div>
@include('common.modalFooter')
