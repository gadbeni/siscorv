<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Entrada;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function search(Request $request){
        $data = Entrada::with(['entity', 'estado', 'archivos', 'derivaciones'])
                    ->whereRaw('(cite = "'.$request->search.'" or CONCAT(tipo,"-",gestion,"-",id) = "'.strtoupper($request->search).'" )')
                    ->where('deleted_at', NULL)->first();
        // dd($data);
        return view('search', compact('data'));
    }
}
