<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\Auth;
use App\Models\OldData;
use App\Models\PeopleExt;
use App\Models\Entrada;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function getPersonas(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $personas = Persona::orderby('nombre', 'asc')
                ->select('id', 'nombre', 'ap_paterno', 'ap_materno', 'ci', 'full_name', 'alfanum', 'departamento_id')
                //->where('func',false)
                ->limit(5)->get();
        } else {
            $personas = Persona::orderby('nombre', 'asc')
                ->select('id', 'nombre', 'ap_paterno', 'ap_materno', 'ci', 'full_name', 'alfanum', 'departamento_id')
                //->where('func',false)
                ->where('ci', 'like', '%' . $search . '%')
                ->limit(5)->get();
        }

        $response = array();
        foreach ($personas as $persona) {
            $response[] = array(
                "id" => $persona->id,
                "text" => $persona->full_name,
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

        if ($int_ext == 1) {
            $funcionarios = DB::connection('mamore')->table('people as p')
                ->join('contracts as c', 'c.person_id', 'p.id')
                ->where('c.status', 'firmado')
                ->whereNull('c.deleted_at')
                ->whereNull('p.deleted_at')
                ->select([
                    'p.id',
                    DB::raw("upper(CONCAT_WS(' ', p.first_name, p.paternal_surname, p.maternal_surname)) as text"),
                    'p.first_name',
                    'p.paternal_surname',
                    'p.maternal_surname',
                    'p.ci',
                ])
                ->where(function ($q) use ($search) {
                    $q->where('p.ci', 'like', "%{$search}%")
                        ->orWhere('p.first_name', 'like', "%{$search}%")
                        ->orWhere('p.paternal_surname', 'like', "%{$search}%")
                        ->orWhere('p.maternal_surname', 'like', "%{$search}%")
                        ->orWhereRaw("CONCAT_WS(' ', p.first_name, p.paternal_surname, p.maternal_surname) like ?", ["%{$search}%"]);
                })
                ->limit(5)
                ->get();
        } else {
            $db_mamore = config('database.connections.mamore.database');
            $funcionarios = DB::table('people_exts as s')
                ->join($db_mamore . '.people as m', 'm.id', '=', 's.person_id')
                ->select(
                    'm.id',
                    DB::raw("upper(CONCAT_WS(' ', m.first_name, m.paternal_surname, m.maternal_surname)) as text"),
                    'm.first_name',
                    'm.paternal_surname',
                    'm.maternal_surname',
                    'm.ci',
                )
                ->where(function ($q) use ($search) {
                    $q->where('m.ci', 'like', "%{$search}%")
                        ->orWhere('m.first_name', 'like', "%{$search}%")
                        ->orWhere('m.paternal_surname', 'like', "%{$search}%")
                        ->orWhere('m.maternal_surname', 'like', "%{$search}%")
                        ->orWhereRaw("CONCAT_WS(' ', m.first_name, m.paternal_surname, m.maternal_surname) like ?", ["%{$search}%"]);
                })
                ->limit(5)
                ->get();
        }
        return response()->json($funcionarios);
        // return response()->json($personas);
    }


    public function getPeoplesDerivacion(Request $request)
    {
        $persona = Persona::where('user_id', Auth::user()->id)->first();

        $search = $request->search;
        $type = $request->type;
        $int_ext = $request->externo; //para saber si buscara funcionario interno u externo
        $funcionarios = [];
        $db_mamore = config('database.connections.mamore.database');
        if (!$search && $type > 0) {
            $funcionarios = DB::connection('mamore')->table('people as p')
                ->join('contracts as c', 'c.person_id', 'p.id')
                ->where('c.status', 'firmado')
                ->where('c.deleted_at', null)
                ->where('p.deleted_at', null)
                ->where('p.id', $type)
                ->select(
                    'p.id',
                    DB::raw("upper(CONCAT(p.first_name, ' ', p.last_name)) as text"),
                    'p.first_name',
                    'last_name',
                    'p.ci',
                )
                ->get();
            if (count($funcionarios) == 0) {
                $funcionarios = DB::table('people_exts as s')
                    ->join($db_mamore . '.people as m', 'm.id', '=', 's.person_id')
                    ->select(
                        'm.id',
                        DB::raw("CONCAT(m.first_name, ' ', m.last_name) as text"),
                        'm.first_name',
                        'm.last_name',
                        'm.ci',
                    )
                    ->where('s.person_id', $type)
                    ->get();
            }
        } else {
            if ($int_ext == 1) {
                $funcionarios = DB::connection('mamore')->table('people as p')
                    ->join('contracts as c', 'c.person_id', 'p.id')
                    ->where('c.status', 'firmado')
                    ->whereNull('c.deleted_at')
                    ->whereNull('p.deleted_at')
                    ->select(
                        'p.id',
                        DB::raw("upper(CONCAT(p.first_name, ' ', p.last_name)) as text"),
                        'p.first_name',
                        'last_name',
                        'p.ci',
                    )
                    ->where(function ($q) use ($search) {
                        $q->where('p.ci', 'like', "%{$search}%")
                            ->orWhere('p.first_name', 'like', "%{$search}%")
                            ->orWhere('p.last_name', 'like', "%{$search}%")
                            ->orWhereRaw("CONCAT(p.first_name, ' ', p.last_name) like ?", ["%{$search}%"]);
                    })
                    ->groupBy('text')
                    ->limit(10)
                    ->get();
            } else {
                $funcionarios = DB::table('people_exts as s')
                    ->join($db_mamore . '.people as m', 'm.id', '=', 's.person_id')
                    ->where('s.status', 1)
                    ->whereNull('s.deleted_at')
                    ->select(
                        'm.id',
                        DB::raw("CONCAT(m.first_name, ' ', m.last_name) as text"),
                        'm.first_name',
                        'm.last_name',
                        'm.ci',
                    )
                    ->where(function ($q) use ($search) {
                        $q->where('m.ci', 'like', "%{$search}%")
                            ->orWhere('m.first_name', 'like', "%{$search}%")
                            ->orWhere('m.last_name', 'like', "%{$search}%")
                            ->orWhereRaw("CONCAT(m.first_name, ' ', m.last_name) like ?", ["%{$search}%"]);
                    })
                    ->get();
            }
        }
        return response()->json($funcionarios);
    }

    public function imprimir($id)
    {
        $certificado = DB::table('certificates as cer')
            ->join('personas as per', 'cer.persona_id', '=', 'per.id')
            ->join('departamentos as dep', 'per.departamento_id', '=', 'dep.id')
            ->select([
                'cer.id',
                'cer.codigo',
                'cer.type',
                'cer.price',
                'per.full_name',
                'per.ci',
                'dep.sigla',
                'cer.descripcion',
                'cer.deuda',
                'cer.monto_deuda',
                'per.alfanum',
                DB::raw("DATE_FORMAT(cer.created_at, '%d/%m/%Y') as fecha"),
                DB::raw("DATE_FORMAT(cer.created_at, '%H:%i:%S') as hora")
            ])
            ->where('cer.id', $id)
            ->first();
        $monto_literal = (new NumeroALetras())->toInvoice($certificado->deuda, 2, 'BOLIVIANOS', 'CENTAVOS');
        return view('livewire.certificates.certif', compact('certificado', 'monto_literal'));
    }

    public function consultareservas(Request $request)
    {
        $search = $request->search;
        $data = collect();
        $msg = '';
        $cont = 0;
        if ($search) {
            $data = OldData::where('razon_social', 'like', '%' . $search . '%')
                ->select('razon_social', 'provincia', 'municipio', 'localidad')->get();

            $datas = DB::connection('sidepej')->table('reservacoormunicipals as r')
                ->join('provincias as p', 'r.provincia_id', 'p.id')
                ->join('municipios as m', 'r.municipio_id', 'm.id')
                ->where('r.nombre', 'like', '%' . $search . '%')
                ->select('r.nombre as razon_social', 'p.nombre as provincia', 'm.municipio as municipio', 'r.localidad')->get();

            foreach ($datas as $item) {
                $data->push($item);
            }

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
    public function getCite($id = 1, $cite = null)
    {
        if (!$cite) {
            return 0;
        }
        $aux = '';
        $i = 0;
        $cite = strtoupper($cite);

        while ($i < strlen($cite)) {
            if ($cite[$i] == '&') {
                $aux = $aux . '/';
            } else {
                $aux = $aux . $cite[$i];
            }
            $i++;
        }

        if ($id == 1) {
            $ok = Entrada::where('cite', $aux)->where('deleted_at', null)->first();
        } else {
            $ok = Entrada::where('id', '!=', $id)->where('cite', $aux)->where('deleted_at', null)->first();
        }
        if ($ok) {
            return 1;
        } else {
            return 0;
        }
    }
}
