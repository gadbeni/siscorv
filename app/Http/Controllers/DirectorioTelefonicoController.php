<?php

namespace App\Http\Controllers;
use App\Models\DirectorioTelefonico;
use App\Models\DireccionAdministrativa;
use App\Models\UnidadAdministrativa;

use Illuminate\Http\Request;

class DirectorioTelefonicoController extends Controller
{
    //
    public function index()
    {
        return view('directorio_telefonico.browse');
    }

    public function list(){
        $directorio = DirectorioTelefonico::with(['direccion_administrativa','unidad_administrativa'])
            ->orderBy('numero_interno','asc')    
            ->get()
            ->groupBy('direccion_id');
        // dd($directorio);
        return view('directorio_telefonico.list', compact('directorio'));
        //return response()->json($directorio);
    }

    public function create()
    {
        $direccionesAdministrativas = DireccionAdministrativa::all();
        return view('directorio_telefonico.edit-add', compact('direccionesAdministrativas'));
    }
    public function store(Request $request){
        $request->validate([
            'cargo_responsable' => 'required',
            'nombre' => 'required',
            'numero_interno' => 'required',
            'direccion_id' => 'required',
            'unidad_id' => 'required',
        ]);
        $directorio = new DirectorioTelefonico();
        $directorio->cargo_responsable = $request->cargo_responsable;
        $directorio->nombre = $request->nombre;
        $directorio->numero_interno = $request->numero_interno;
        $directorio->direccion_id = $request->direccion_id;
        $directorio->unidad_id = $request->unidad_id;
        $directorio->save();
        return redirect()->route('directorio-telefonico.index');
    }

    public function getUnidades($direccion_id)
    {
        $unidades = UnidadAdministrativa::where('direccion_id', $direccion_id)
            ->where('estado',1)
            ->get();
        return response()->json($unidades);
    }
}
