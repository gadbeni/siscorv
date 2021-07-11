<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Storage;

// Models
use App\Models\Entrada;
use App\Models\Archivo;

class EntradasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('entradas.browse');
    }

    public function list(){
        $data = Entrada::with(['entity', 'estado'])->where('deleted_at', NULL)->get();
        // return $data;

        return
            Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('hr', function($row){
                return $row->tipo.'-'.$row->gestion.'-'.$row->id;
            })
            ->addColumn('fecha_ingreso', function($row){
                return date('d/m/Y H:i:s', strtotime($row->created_at)).'<br><small>'.\Carbon\Carbon::parse($row->created_at)->diffForHumans().'</small>';
            })
            ->addColumn('origen', function($row){
                return $row->entity->nombre;
            })
            ->addColumn('estado', function($row){
                return $row->estado->nombre;
            })
            ->addColumn('action', function($row){
                $actions = '
                    <div class="no-sort no-click bread-actions text-right">
                        <a href="'.route('entradas.show', ['entrada' => $row->id]).'" title="Ver" class="btn btn-sm btn-warning view">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                        </a>
                        <button title="Borrar" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#delete_modal" onclick="deleteItem('."'".url("admin/entradas/".$row->id)."'".')">
                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                        </button>
                    </div>
                        ';
                return $actions;
            })
            ->rawColumns(['hr', 'origen', 'fecha_ingreso', 'estado', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entradas.edit-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $entrada = Entrada::create([
                'gestion' => date('Y'),
                'tipo' => $request->tipo,
                'remitente' => $request->remitente,
                'cite' => $request->cite,
                'referencia' => $request->referencia,
                'nro_hojas' => $request->nro_hojas,
                'estado' => 'activo',
                'registrado_por' => Auth::user()->email,
                // Cambiar el parámetro de la llamada a la funcion getIdDireccionFuncionario
                'registrado_por_id_direccion' => $this->getIdDireccionFuncionario(26)->DA,
                'registrado_por_id_unidad' => $this->getIdDireccionFuncionario(26)->idDependencia,
                'entity_id' => $request->entity_id,
                'estado_id' => 6
            ]);

            $file = $request->file('archivos');
            if ($file) {
                for ($i=0; $i < count($file); $i++) { 
                    $nombre_origen = $file[$i]->getClientOriginalName();
                    $newFileName = Str::random(20).'.'.$file[$i]->getClientOriginalExtension();
                    $dir = "entradas/".date('F').date('Y');
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file[$i]));
                    Archivo::create([
                        'nombre_origen' => $nombre_origen,
                        'entrada_id' => $entrada->id,
                        'ruta' => 'entradas/'.$newFileName
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('entradas.index')->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->route('entradas.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Entrada::with(['entity', 'estado', 'archivos'])->where('id', $id)->where('deleted_at', NULL)->first();
        return view('entradas.read', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
