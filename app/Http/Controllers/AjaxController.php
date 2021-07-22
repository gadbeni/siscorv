<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\Auth;
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
        $personas = [];
        if($search) {
            $personas = DB::connection('mysqlgobe')->table('contribuyente as c')
                                ->join('contratos as cont', 'c.N_Carnet', '=', 'cont.idContribuyente')
                                ->where('c.Estado',1)
                                ->where('cont.Estado',1)
                                ->select([
                                    'c.ID as id',
                                    'c.NombreCompleto as text',
                                    'c.APaterno as ap_paterno','c.alfanu as alfanum',
                                    'c.AMaterno as ap_materno','c.Expedido as departamento_id',
                                    DB::raw("CONCAT(PNombre, ' ', SNombre) as nombre"),
                                    'c.N_carnet as ci',
                                ])
                                ->whereRaw('(c.N_carnet like "%' .$search . '%" or c.NombreCompleto like "%' .$search . '%")')->limit(10)->get();
        }
        return response()->json($personas);
    }

    public function getFuncionariosDerivacion(Request $request){
        $persona = Persona::where('user_id', Auth::user()->id)->first();
        $funcionario = DB::connection('mysqlgobe')->table('contribuyente as c')
                            ->join('contratos as co', 'c.N_Carnet', 'co.idContribuyente')
                            ->join('cargo as ca', 'ca.ID', 'co.idCargo')
                            ->where('c.Estado', 1)->where('co.Estado', 1)->where('ca.estado', 1)
                            ->where('c.id', $persona->funcionario_id)->select('c.idDependencia', 'c.DA', 'co.idCargo', 'ca.idNivel')->first();
        if(!$funcionario){
            return response()->json([]);
        }
        $search = $request->search;
        $funcionarios = [];
        if($search) {
            /*
                Si el funcionario no es director (idCargo=4) solo puede derivar
                a los funcionarios de su misma dirección 
            */
            $query_filter_cargo = $funcionario->idCargo == 216 && $funcionario->idNivel == 4 ? 1 : 'ua.id = '.$funcionario->idDependencia;
            $query_filter_rol = Auth::user()->role_id == 2 ? 1 : 'c.DA = '.$funcionario->DA;
            $funcionarios =  DB::connection('mysqlgobe')->table('contribuyente as c')
                                ->leftJoin('unidadadminstrativa as ua', 'c.idDependencia', '=', 'ua.id')
                                ->leftJoin('direccionadministrativa as da', 'c.DA', '=', 'da.ID')
                                ->join('contratos as co', 'c.N_Carnet', 'co.idContribuyente')
                                ->where('c.Estado', '=', '1')->where('co.Estado', '1')
                                ->where('c.id', '<>', $persona->funcionario_id)
                                ->whereRaw($query_filter_cargo)
                                // ->whereRaw($query_filter_rol)
                                ->select('c.id', 'c.NombreCompleto as text')
                                ->whereRaw('(c.N_carnet like "%' .$search . '%" or c.NombreCompleto like "%' .$search . '%")')->get();
        }
        return response()->json($funcionarios);
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
