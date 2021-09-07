<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Certificate;
use Livewire\WithPagination;
use DB;

class CertificateController extends Component
{
    use WithPagination;

    public $buscar;
    private $pagination = 5;
    
    protected $paginationTheme = 'bootstrap'; 
    
    public function render()
    {
        if (strlen($this->buscar) > 0) {
            $data = Certificate::join('personas as per', 'certificates.persona_id', '=', 'per.id')
                                ->join('users as u', 'certificates.user_id', '=', 'u.id')
                                ->select([
                                    'certificates.id','certificates.codigo','certificates.type','certificates.price','per.ci',
                                    DB::raw("DATE_FORMAT(certificates.created_at, '%d/%m/%Y %H:%i:%S') as fecha_registro"),
                                    DB::raw('UPPER(per.full_name) as nombre'),
                                    DB::raw('UPPER(u.name) as usuario')
                                ])
                                ->where('certificates.codigo', 'like', '%' .$this->buscar. '%')
                                ->orWhere('per.ci', 'like', '%' .$this->buscar. '%')
                                ->orWhere('certificates.type', 'like', '%' .$this->buscar. '%')
                                ->orWhere('per.full_name', 'like', '%' .$this->buscar. '%')
                                ->orderBy('certificates.id','desc')
                                //->whereNull('certificates.deleted_at')
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
                                ->orderBy('certificates.id','desc')
                                ->paginate($this->pagination);
        }
        return view('livewire.certificates.index',[
                    'certificates' => $data
                ])
                ->extends('vendor.voyager.master')
                ->section('content');
    }
    
    public function nuevo(){
         return redirect()->route('certificate.create');
    }

    protected $listeners = [
        'deleteItem' => 'Destroy'
    ];
    
    public function Destroy(Certificate $certificate){
        $certificate->delete();
        $this->resetUI();
        $this->emit('modal-eliminar', 'Certificado Anulado');
    }

    public function resetUI(){
        $this->buscar = '';
    }
}
