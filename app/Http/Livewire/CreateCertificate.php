<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateCertificate extends Component
{
    public $pageTitle, $componentName,$selected_id, $deuda, $checkdeuda,
           $price, $descripcion,$type, $funcionarioId, $departamento_id, $alfanum,
           $ap_paterno, $ap_materno, $ci, $nombre;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Certificados';
        $this->deuda = 0;
        $this->checkdeuda = false;
        $this->descripcion = 'NO REGISTRA SALDO DEUDOR.';
        $this->type = 'interno';
        $this->price = 0;
    }

    public function render()
    {
        return view('livewire.certificates.create-certificate')
               ->extends('voyager::master')
               ->section('content');
    }

    public function calcularprecio(){
        if ($this->type == 'externo'){
            $this->price = 30;
            $this->emit('hability-getpersons', 'externo');
        } else{
            $this->price = 0;
            $this->emit('hability-getpersons',  'interno');
        }
    }

    public function showdeuda(){
        $msg = $this->type;
        $this->deuda = 0;
        if ($this->checkdeuda) {
            $this->descripcion = 'En la cuenta n° : OTRAS CUENTAS A COBRAR A CORTO PLAZO';
        } else{
            $this->descripcion = 'NO REGISTRA SALDO DEUDOR';
        }
        $this->emit('show-deuda', $this->checkdeuda);
    }

    public function Store(){
        $rules= [
            'name' => 'required|unique:documents|min:3',
            'categoryid' => 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required' => 'El nombre del producto es requerido',
            'name.unique' => 'Ya existe un producto con ese nombre',
            'name.min' => 'El nombre deve tener al menos 3 caracteres',
            'categoryid.not_in' => 'Selecciona una categoria diferente de Elegir',
        ];

        $this->validate($rules,$messages);

        $document = Document::create([
            'name' => $this->name,
            'category_id' => $this->categoryid
        ]);

        $customFileName;
        if ($this->archive) {
            $customFileName = uniqid() . '_.' . $this->archive->extension();
            $this->archive->storeAs('public/documents', $customFileName);
            //guardar el archivo en relacion belonsgtoMany
            //$document->image = $customFileName;
            $document->save();
        }
        $this->resetUI();
        $this->emit('document-added','Producto Registrado');
    }
}
