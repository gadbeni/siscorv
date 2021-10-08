<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Entrada;
use App\Models\RequestsClient;

class HomeController extends Controller
{
    public function index(){
        /* Capturar datos de la petición del cliente */
        try {
            RequestsClient::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $_SERVER['HTTP_USER_AGENT']
            ]);
        } catch (\Throwable $th) {}
        return view('welcome');
    }

    public function search(Request $request){
        $data = Entrada::with(['entity', 'estado', 'archivos', 'derivaciones'])
                    ->whereRaw('(cite = "'.$request->search.'" or CONCAT(tipo,"-",gestion,"-",id) = "'.strtoupper($request->search).'" )')
                    ->where('deleted_at', NULL)->first();
        // dd($data);
        return view('search', compact('data'));
    }

    public function searchtramite(Request $request){
        $data = Entrada::with(['entity', 'estado', 'archivos', 'derivaciones'])
                    ->whereRaw('(cite = "'.$request->search.'" or CONCAT(tipo,"-",gestion,"-",id) = "'.strtoupper($request->search).'" )')
                    ->where('deleted_at', NULL)->first();
        // dd($data);
        return response()->json($data);
    }
}
