<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Luecano\NumeroALetras\NumeroALetras;
use DB;

class AjaxController extends Controller
{
    public function getPersonas(Request $request){

        $search = $request->search;

        if($search == ''){
        $personas = Persona::orderby('nombre','asc')
                            ->select('id','nombre','ap_paterno','ap_materno','ci','full_name','alfanum','departamento_id')
                            //->where('func',false)
                            ->limit(5)->get();
        }else{
        $personas = Persona::orderby('nombre','asc')
                            ->select('id','nombre','ap_paterno','ap_materno','ci','full_name','alfanum','departamento_id')
                            //->where('func',false)
                            ->where('ci', 'like', '%' .$search . '%')
                            ->limit(5)->get();
        }

        $response = array();
        foreach($personas as $persona){
            $response[] = array(
                    "id"=>$persona->id,
                    "text"=>$persona->full_name,
                    "nombre" => $persona->nombre,
                    "ap_paterno" => $persona->ap_paterno,
                    "ap_materno" => $persona->ap_materno,
                    "ci" => $persona->ci,
                    "alfanum" => $persona->alfanum,
                    "departamento_id" => $persona->departamento_id
        );
        }
        return response()->json($response);
    }

    public function getFuncionarios(Request $request){
        $search = $request->search;

        if($search == ''){
        $personas =  DB::connection('mysqlgobe')->table('contribuyente as c')
                        ->join('contratos as cont', 'c.N_Carnet', '=', 'cont.idContribuyente')
                        ->where('c.Estado',1)
                        ->where('cont.Estado',1)
                        ->select([
    						'c.ID as id_funcionario',
    						'c.NombreCompleto as nombre_completo',
                            'c.APaterno as paterno','c.alfanu',
                            'c.AMaterno as materno','c.Expedido',
                            DB::raw("CONCAT(PNombre, ' ', SNombre) as nombre"),
                            'c.N_carnet as ci',
    						'c.Estado as estado',
    					])
                        ->limit(5)->get();
        }else{
        $personas = DB::connection('mysqlgobe')->table('contribuyente as c')
                        ->join('contratos as cont', 'c.N_Carnet', '=', 'cont.idContribuyente')
                        ->where('c.Estado',1)
                        ->where('cont.Estado',1)
                        ->select([
                            'c.ID as id_funcionario',
                            'c.NombreCompleto as nombre_completo',
                            'c.APaterno as paterno','c.alfanu',
                            'c.AMaterno as materno','c.Expedido',
                            DB::raw("CONCAT(PNombre, ' ', SNombre) as nombre"),
                            'c.N_carnet as ci',
                            'c.Estado as estado',
                        ])->whereRaw('(c.N_carnet like "%' .$search . '%" or c.NombreCompleto like "%' .$search . '%")')->limit(5)->get();
        }
        $response = array();
        foreach($personas as $persona){
            $response[] = array(
                    "id"=>$persona->id_funcionario,
                    "text"=>$persona->nombre_completo,
                    "nombre" => $persona->nombre,
                    "ap_paterno" => $persona->paterno,
                    "ap_materno" => $persona->materno,
                    "ci" => $persona->ci,
                    "alfanum" => $persona->alfanu,
                    "departamento_id" => $persona->Expedido
        );
        }
        return response()->json($response);
    }

    public function imprimir($id){
        $certificado = DB::table('certificates as cer')
            ->join('personas as per', 'cer.persona_id', '=', 'per.id')
            ->join('departamentos as dep', 'per.departamento_id', '=', 'dep.id')
            ->select([
                'cer.id','cer.codigo','cer.type','cer.price', 'per.full_name', 'per.ci','dep.sigla',
                'cer.descripcion','cer.deuda','cer.monto_deuda','per.alfanum',
                DB::raw("DATE_FORMAT(cer.created_at, '%d/%m/%Y') as fecha"),
                DB::raw("DATE_FORMAT(cer.created_at, '%H:%i:%S') as hora")
            ])
            ->where('cer.id',$id)
            ->first();
            $monto_literal = (new NumeroALetras())->toInvoice($certificado->deuda, 2, 'BOLIVIANOS', 'CENTAVOS');
        return view('livewire.certificates.certif', compact('certificado','monto_literal'));
    }
}
