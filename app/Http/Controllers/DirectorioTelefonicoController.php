<?php

namespace App\Http\Controllers;

use App\Models\DirectorioTelefonico;
use App\Models\DirectorioGrupo;
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
        $directorioGrupos = DirectorioGrupo::all();
        return view('directorio_telefonico.browse', compact('directorioGrupos'));
    }

    public function list()
    {
        $paginate = request('paginate') ?? 10;
        $directorioGrupo = request('directorioGrupo');
        $search = request('search');
        $data = DirectorioTelefonico::with(['direccion_administrativa', 'unidad_administrativa', 'directorio_grupo'])
            ->orderBy('numero_interno', 'asc');

        if ($search) {
            $data = $data->where('nombre', 'LIKE', "%{$search}%")->orWhere('cargo_responsable', 'LIKE', "%{$search}%");
        }
        if ($directorioGrupo) {
            $data = $data->where('directorio_grupo_id', $directorioGrupo);
        }
        $data = $data->paginate($paginate);

        $directorio = $data->groupBy('directorio_grupo_id');
        return view('directorio_telefonico.list', compact('directorio', 'data'));
    }

    public function create()
    {
        $direccionesAdministrativas = DireccionAdministrativa::all();
        $directorioGrupos = DirectorioGrupo::all();
        return view('directorio_telefonico.add', compact('direccionesAdministrativas', 'directorioGrupos'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'cargo_responsable' => 'required',
            'nombre' => 'required',
            'numero_interno' => 'required',
            'directorio_grupo_id' => 'required',
        ]);
        $directorio = new DirectorioTelefonico();
        $directorio->cargo_responsable = $request->cargo_responsable;
        $directorio->nombre = $request->nombre;
        $directorio->numero_interno = $request->numero_interno;
        $directorio->directorio_grupo_id = $request->directorio_grupo_id;
        $directorio->direccion_id = $request->direccion_id;
        $directorio->unidad_id = $request->unidad_id;
        $directorio->save();
        return redirect()->route('directorio-telefonico.index');
    }
    public function edit($id)
    {
        $directorio = DirectorioTelefonico::find($id);
        $direccionesAdministrativas = DireccionAdministrativa::all();
        $directorioGrupos = DirectorioGrupo::all();
        $unidadesAdministrativas = UnidadAdministrativa::where('direccion_id', $directorio->direccion_id)->get();
        return view('directorio_telefonico.edit', compact('directorio', 'directorioGrupos', 'direccionesAdministrativas', 'unidadesAdministrativas'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'cargo_responsable' => 'required',
            'nombre' => 'required',
            'numero_interno' => 'required',
            'directorio_grupo_id' => 'required',
        ]);
        $directorio = DirectorioTelefonico::find($id);
        $directorio->cargo_responsable = $request->cargo_responsable;
        $directorio->nombre = $request->nombre;
        $directorio->numero_interno = $request->numero_interno;
        $directorio->directorio_grupo_id = $request->directorio_grupo_id;
        $directorio->direccion_id = $request->direccion_id;
        $directorio->unidad_id = $request->unidad_id;
        $directorio->save();
        return redirect()->route('directorio-telefonico.index');
    }
    public function destroy($id)
    {
        $directorio = DirectorioTelefonico::find($id);
        $directorio->delete();
        return redirect()->route('directorio-telefonico.index');
    }

    public function getUnidades($direccion_id)
    {
        $unidades = UnidadAdministrativa::where('direccion_id', $direccion_id)
            ->where('estado', 1)
            ->get();
        return response()->json($unidades);
    }
}
