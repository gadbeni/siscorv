<?php

namespace App\Http\Controllers;
use App\Models\DirectorioTelefonico;
use App\Models\DireccionAdministrativa;
use App\Models\UnidadAdministrativa;

use Illuminate\Http\Request;

class DirectorioTelefonicoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('directorio_telefonico.browse');
    }

    public function list(){
        $paginate = request('paginate') ?? 10;
        $data = DirectorioTelefonico::with(['direccion_administrativa','unidad_administrativa'])
            ->orderBy('numero_interno','asc')
            ->paginate($paginate); 
        $directorio = $data->groupBy('direccion_id');
        // dd($directorio);
        return view('directorio_telefonico.list', compact('directorio','data'));

        // $paginate = request('paginate') ?? 1;
        // $directorio = DirectorioTelefonico::with(['direccion_administrativa', 'unidad_administrativa'])
        //     ->orderBy('numero_interno', 'asc')
        //     ->paginate($paginate);

        // // Agrupar los datos paginados
        // $directoriosAgrupados = $directorio->getCollection()->groupBy('direccion_id');

        // // Reemplazar la colección paginada con la colección agrupada
        // $directorio->setCollection($directoriosAgrupados->flatten());
        // dd($directorio);

        // return view('directorio_telefonico.list', compact('directorio'));
    }

    public function create()
    {
        $direccionesAdministrativas = DireccionAdministrativa::all();
        return view('directorio_telefonico.add', compact('direccionesAdministrativas'));
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
    public function edit($id){
        $directorio = DirectorioTelefonico::find($id);
        $direccionesAdministrativas = DireccionAdministrativa::all();
        $unidadesAdministrativas = UnidadAdministrativa::where('direccion_id', $directorio->direccion_id)->get();
        return view('directorio_telefonico.edit', compact('directorio', 'direccionesAdministrativas', 'unidadesAdministrativas'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'cargo_responsable' => 'required',
            'nombre' => 'required',
            'numero_interno' => 'required',
            'direccion_id' => 'required',
            'unidad_id' => 'required',
        ]);
        $directorio = DirectorioTelefonico::find($id);
        $directorio->cargo_responsable = $request->cargo_responsable;
        $directorio->nombre = $request->nombre;
        $directorio->numero_interno = $request->numero_interno;
        $directorio->direccion_id = $request->direccion_id;
        $directorio->unidad_id = $request->unidad_id;
        $directorio->save();
        return redirect()->route('directorio-telefonico.index');
    }
    public function destroy($id){
        $directorio = DirectorioTelefonico::find($id);
        $directorio->delete();
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
