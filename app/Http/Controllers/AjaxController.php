<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\Auth;
use App\Models\OldData;
use App\Models\PeopleExt;
use App\Models\Entrada;
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

    public function getPeoples(Request $request)
    {
        $search = $request->search;
        // $type = $request->type;
        $int_ext = $request->externo; //para saber si buscara funcionario interno u externo
        $funcionarios = [];

        if($int_ext==1)
        {
           
            $funcionarios = DB::connection('mamore')->table('people as p')
                                    ->join('contracts as c', 'c.person_id', 'p.id')
                                    ->where('c.status','firmado')
                                    ->where('c.deleted_at', null)
                                    ->where('p.deleted_at', null)
                                    ->select([
                                        'p.id',
                                        DB::raw("upper(CONCAT(p.first_name, ' ', p.last_name)) as text"),
                                        'p.first_name', 'last_name',
                                        'p.ci',
                                    ])
                                    ->whereRaw('(p.ci like "%' .$search . '%" or '.DB::raw("CONCAT(p.first_name, ' ', p.last_name)").' like "%' .$search . '%")')
                                    ->groupBy('text')
                                    ->limit(5)
                                    ->get(); 
        }
        else
        {
            // $funcionarios = DB::table('siscor2021.people_exts as s')
            $funcionarios = DB::table('siscor_v2.people_exts as s')
            ->join('sysadmin.people as m', 'm.id', '=', 's.person_id')
            ->select(
                'm.id',
                DB::raw("upper(CONCAT(m.first_name, ' ', m.last_name)) as text"),
                'm.first_name', 'm.last_name',
                'm.ci',
            )
            ->whereRaw('(m.ci like "%' .$search . '%" or '.DB::raw("CONCAT(m.first_name, ' ', m.last_name)").' like "%' .$search . '%")')
            ->limit(5)
            // ->groupBy('text')
            ->get();
        }      
        return response()->json($funcionarios);
        // return response()->json($personas);
    }
   

    public function getPeoplesDerivacion(Request $request){
        $persona = Persona::where('user_id', Auth::user()->id)->first();
       
        $search = $request->search;
        $type = $request->type;
        $int_ext = $request->externo; //para saber si buscara funcionario interno u externo
        $funcionarios = [];
        if (!$search && $type > 0)
        {
            $funcionarios = DB::connection('mamore')->table('people as p')
                                        ->join('contracts as c', 'c.person_id', 'p.id')
                                        ->where('c.status','firmado')
                                        ->where('c.deleted_at', null)
                                        ->where('p.deleted_at', null)
                                        ->where('p.id',$type)
                                        ->select(
                                            'p.id',
                                            DB::raw("upper(CONCAT(p.first_name, ' ', p.last_name)) as text"),
                                            'p.first_name', 'last_name',
                                            'p.ci',
                                        )
                                        // ->whereRaw('(p.ci like "%' .$search . '%" or '.DB::raw("CONCAT(p.first_name, ' ', p.last_name)").' like "%' .$search . '%")')
                                        // ->groupBy('text')
                                        ->get();
            if(count($funcionarios)==0)
            {
                // $funcionarios = DB::table('siscor2021.people_exts as s')
                $funcionarios = DB::table('siscor_v2.people_exts as s')
                    ->join('sysadmin.people as m', 'm.id', '=', 's.person_id')
                    ->select(
                        'm.id',
                        DB::raw("CONCAT(m.first_name, ' ', m.last_name) as text"),
                        'm.first_name', 'm.last_name',
                        'm.ci',
                    )
                    ->where('s.person_id', $type)
                    // ->whereRaw('(m.ci like "%' .$search . '%" or '.DB::raw("CONCAT(m.first_name, ' ', m.last_name)").' like "%' .$search . '%")')
                    // ->groupBy('text')
                    ->get();
            }
        }
        else
        {
            if($int_ext==1)
            {
                $funcionarios = DB::connection('mamore')->table('people as p')
                                        ->join('contracts as c', 'c.person_id', 'p.id')
                                        ->where('c.status','firmado')
                                        ->where('c.deleted_at', null)
                                        ->where('p.deleted_at', null)
                                        // ->where('p.id',$type)
                                        ->select(
                                            'p.id',
                                            DB::raw("upper(CONCAT(p.first_name, ' ', p.last_name)) as text"),
                                            'p.first_name', 'last_name',
                                            'p.ci',
                                        )
                                        ->whereRaw('(p.ci like "%' .$search . '%" or '.DB::raw("CONCAT(p.first_name, ' ', p.last_name)").' like "%' .$search . '%")')
                                        ->groupBy('text')
                                        ->limit(10)
                                        ->get();
            }
            else
            {
                // $funcionarios = DB::table('siscor2021.people_exts as s')
                $funcionarios = DB::table('siscor_v2.people_exts as s')
                ->join('sysadmin.people as m', 'm.id', '=', 's.person_id')
                ->select(
                    'm.id',
                    DB::raw("CONCAT(m.first_name, ' ', m.last_name) as text"),
                    'm.first_name', 'm.last_name',
                    'm.ci',
                )
                ->whereRaw('(m.ci like "%' .$search . '%" or '.DB::raw("CONCAT(m.first_name, ' ', m.last_name)").' like "%' .$search . '%")')
                // ->groupBy('text')
                ->get();
            }      
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

    public function consultareservas(Request $request){
        $search = $request->search;
        $data = [];
        $msg = '';
        $cont = 0;
        if ($search) {
           $data = OldData::where('razon_social','like','%'.$search.'%')
                            ->select('razon_social','provincia','municipio','localidad')->get();
            $msg = $data->count() ? 'El nombre existe en la sgte lista:' : 'El nombre no existe puede proceder a realizar su tramite';
            $cont = $data->count() ? 1 : 0;
        }
        
        return response()->json([
            'data' => $data,
            'message' => $msg,
            'cont' => $cont
        ]);
    }



     // para saber si el cite ya se encuentra registrado 
     public function getCite($id,$cite)
     {
        $aux ='';
        $i =0;
        $cite = strtoupper($cite);

        while($i < strlen($cite))
        {
            if($cite[$i]=='&')
            {
                $aux = $aux.'/';
            }
            else
            {
                $aux = $aux.$cite[$i];
            }
            $i++;
        }

        if($id == 1)
        {
            $ok = Entrada::where('cite', $aux)->where('deleted_at', null)->first();
        }
        else
        {
            $ok = Entrada::where('id', '!=', $id)->where('cite', $aux)->where('deleted_at', null)->first();
        }
        if($ok)
        {
            return 1;
        }
        else
        {
            return 0;
        }
     }
 
}
