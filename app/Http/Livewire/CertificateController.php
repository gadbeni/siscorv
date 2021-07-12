<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;
use App\Models\Certificate;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use DB;

class CertificateController extends Component
{
    use WithPagination;

    public $search, $pageTitle, $componentName, $selected_id, $deuda, $checkdeuda,
           $price, $descripcion,$type, $funcionarioId, $departamento_id, $alfanum,
           $ap_paterno, $ap_materno, $ci, $nombre;
    private $pagination = 5;
    
    protected $paginationTheme = 'bootstrap'; 

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Documentos';
        $this->deuda = 0;
        $this->checkdeuda = false;
        $this->descripcion = 'NO REGISTRA SALDO DEUDOR.';
        //$this->type = 'interno';
        $this->price = 0;
    }

    public function render()
    {
        if (strlen($this->search) > 0) {
            $data = Certificate::join('personas as per', 'certificates.persona_id', '=', 'per.id')
                                ->join('users as u', 'certificates.user_id', '=', 'u.id')
                                ->select([
                                    'certificates.id','certificates.codigo','certificates.type','certificates.price','per.ci',
                                    DB::raw("DATE_FORMAT(certificates.created_at, '%d/%m/%Y %H:%i:%S') as fecha_registro"),
                                    DB::raw('UPPER(per.full_name) as nombre'),
                                    DB::raw('UPPER(u.name) as usuario')
                                ])
                                ->where('certificates.codigo', 'like', '%' .$this->search. '%')
                                ->orWhere('per.ci', 'like', '%' .$this->search. '%')
                                ->orWhere('certificates.type', 'like', '%' .$this->search. '%')
                                ->where('documents.name','like','%' .$this->search . '%')
                                ->orWhere('c.name','like','%' .$this->search . '%')
                                ->orderBy('certificates.id','desc')
                                ->whereNull('cer.deleted_at')
                                ->paginate($this->pagination);
        } else{
            $data = Certificate::join('personas as per', 'certificates.persona_id', '=', 'per.id')
                                ->join('users as u', 'certificates.user_id', '=', 'u.id')
                                ->select([
                                    'certificates.id','certificates.codigo','certificates.type','certificates.price','per.ci',
                                    DB::raw("DATE_FORMAT(certificates.created_at, '%d/%m/%Y %H:%i:%S') as fecha_registro"),
                                    DB::raw('UPPER(per.full_name) as nombre'),
                                    DB::raw('UPPER(u.name) as usuario')
                                ])
                                ->orderBy('documents.name','asc')
                                ->paginate($this->pagination);
        }
        return view('livewire.certificates.index',[
                    'certificates' => $data
                ])
                ->extends('voyager::master')
                ->section('content');
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
    
    public function showdeuda(){
        $msg = $this->type;
        if ($this->checkdeuda) {
            $this->descripcion = 'En la cuenta n° : OTRAS CUENTAS A COBRAR A CORTO PLAZO';
        } else{
            $this->descripcion = 'NO REGISTRA SALDO DEUDOR';
        }
        $this->emit('show-deuda',$msg);
    }
}
