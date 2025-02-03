<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Persona;
use App\Models\Departamento;
use App\Models\Certificate;
use Luecano\NumeroALetras\NumeroALetras;
use DB;

class CreateCertificate extends Component
{
    public $pageTitle, $componentName, $selected_id, $deuda, $checkdeuda, $printcertificate,
        $price, $descripcion, $type, $funcionarioId, $departamento_id, $alfanum,
        $ap_paterno, $ap_materno, $ci, $nombre, $certId, $warehouse_id;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Certificados';
        $this->deuda = 0;
        $this->checkdeuda = false;
        $this->printcertificate = false;
        $this->descripcion = 'NO REGISTRA SALDO DEUDOR.';
        $this->type = 'interno';
        $this->price = 0;
        $this->departamento_id = 0;
        $this->funcionarioId = 0;
        if (auth()->user()->warehouses->count()) {
            $this->warehouse_id = auth()->user()->warehouses[0]->id;
        }
    }

    public function render()
    {
        return view('livewire.certificates.create-certificate', [
            'departamentos' => Departamento::all(),
            'almacenes' => auth()->user()->warehouses
        ])
            ->extends('vendor.voyager.master')
            ->section('content');
    }

    public function calcularprecio()
    {
        $this->resetUI();
        if ($this->type == 'externo') {
            $this->price = 30;
            $this->emit('hability-getpersons', 'externo');
        } else {
            $this->price = 0;
            $this->emit('hability-getpersons',  'interno');
        }
    }

    public function showdeuda()
    {
        $msg = $this->type;
        $this->deuda = 0;
        if ($this->checkdeuda) {
            $this->descripcion = "REGISTRA SALDO DEUDOR, DE: POR RECURSOS PENDIENTES DE DESCARGO, ES TODO CUANTO PODEMOS CERTIFICAR PARA FINES DEL INTERESADO";
        } else {
            $this->descripcion = 'NO REGISTRA SALDO DEUDOR, ES TODO CUANTO PODEMOS CERTIFICAR PARA FINES DEL INTERESADO';
        }
        $this->emit('show-deuda', $this->checkdeuda);
    }

    public function agregardeuda()
    {
        $monto_literal = (new NumeroALetras())->toInvoice($this->deuda, 2, 'BOLIVIANOS', 'CENTAVOS');
        $totaldeuda = number_format($this->deuda, 2);
        $this->descripcion = "REGISTRA SALDO DEUDOR, DE: {$totaldeuda} (SON: $monto_literal) POR RECURSOS PENDIENTES DE DESCARGO, ES TODO CUANTO PODEMOS CERTIFICAR PARA FINES DEL INTERESADO";
    }

    public function Store()
    {

        $rules = [
            'price' => 'required|min:0',
            'type' => 'required',
            'descripcion' => 'required',
            'departamento_id' => 'required'
        ];
        $messages = [
            'price.required' => 'El campo precio es obligatorio',
            'type.required' => 'El campo tipo es obligatorio',
            'descripcion.required' => 'El campo descripcion es obligatorio',
            'departamento_id.required' => 'Seleccione la expedicion del carnet'
        ];
        $this->validate($rules, $messages);

        $cod = '';
        $persona_id = '';
        if ($this->type == "interno") {
            $customer = Persona::where('ci', $this->ci)->first();
            if ($customer) {
                $persona_id = $customer->id;
                $paterno = $customer->ap_paterno ? $customer->ap_paterno[0] : '';
                $materno = $customer->ap_materno ? $customer->ap_materno[0] : '';
                $cod = $customer->nombre[0] . '' . $paterno . '' . $materno;
            } else {
                $persona = new Persona;
                $persona->nombre = $this->getNameattribute($this->nombre);
                $persona->ap_paterno = $this->getNameattribute($this->ap_paterno);
                $persona->ap_materno = $this->getNameattribute($this->ap_materno);
                $persona->full_name = $persona->nombre . ' ' . $persona->ap_paterno . ' ' . $persona->ap_materno;
                $persona->ci = $this->ci;
                $persona->alfanum = $this->alfanum;
                $persona->departamento_id = $this->departamento_id;
                $persona->save();
                $persona->tipo = 'funcionario';
                $persona_id = $persona->id;
                $paterno = $this->ap_paterno ? $this->ap_paterno[0] : '';
                $materno = $this->ap_materno ? $this->ap_materno[0] : '';
                $cod = $persona->nombre[0] . '' . $paterno . '' . $materno;
                //$cod = $this->nombre[0].''.$this->ap_paterno[0] ? $this->ap_paterno[0] : '' .''.$this->ap_materno[0] ?? '';
            }
        } elseif ($this->type == "externo") {
            $customer = Persona::where('ci', $this->ci)->first();
            if ($customer) {
                $persona_id = $customer->id;
                $paterno = $customer->ap_paterno ? $customer->ap_paterno[0] : '';
                $materno = $customer->ap_materno ? $customer->ap_materno[0] : '';
                $cod = $customer->nombre[0] . '' . $paterno . '' . $materno;
                //$cod = $customer->nombre[0].''.$customer->ap_paterno[0].''.$customer->ap_materno[0];
            }
            if ($this->funcionarioId === 0) {
                $persona = new Persona;
                $persona->nombre = $this->getNameattribute($this->nombre);
                $persona->ap_paterno = $this->getNameattribute($this->ap_paterno);
                $persona->ap_materno = $this->getNameattribute($this->ap_materno);
                $persona->full_name = $persona->nombre . ' ' . $persona->ap_paterno . ' ' . $persona->ap_materno;
                $persona->ci = $this->ci;
                $persona->alfanum = $this->alfanum;
                $persona->departamento_id = $this->departamento_id;
                $persona->tipo = 'funcionario';
                $persona->save();
                $persona_id = $persona->id;
                $cod = $persona->nombre[0] . '' . $persona->ap_paterno[0] . '' . $persona->ap_materno[0];
            }
        }

        $cert = Certificate::create([
            'descripcion'   => $this->descripcion,
            'type'          => $this->type,
            'price'         => $this->price,
            'deuda'         => ($this->checkdeuda) ? true : false,
            'monto_deuda'   => $this->deuda,
            'user_id'       => auth()->user()->id,
            'persona_id'    => $persona_id,
            // 'created_at'    => date("2022-10-16 H:i:s"),
            'warehouse_id'  => $this->warehouse_id
        ]);
        $cert->codigo = $cod . '' . $cert->id;
        $cert->update();
        $this->printcertificate = true;
        $this->certId = $cert->id;
        $this->resetUI();
        $this->emit('certificate-added', 'Certificado Registrado');
    }

    public function resetUI()
    {
        $this->nombre = '';
        $this->ap_paterno = '';
        $this->ap_materno = '';
        $this->ci = '';
        $this->alfanum = '';
        $this->selected_id = 0;
        $this->deuda = 0;
        $this->checkdeuda = false;
        $this->descripcion = 'NO REGISTRA SALDO DEUDOR.';
        $this->price = 0;
        $this->departamento_id = 0;
        $this->funcionarioId = 0;
    }

    public function getNameattribute($value)
    {
        return strtoupper($value);
    }
}
