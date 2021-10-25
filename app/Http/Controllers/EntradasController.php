<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Storage;

// Models
use App\Models\Entrada;
use App\Models\Archivo;
use App\Models\Derivation;
use App\Models\Persona;

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
        $funcionario = Persona::where('user_id', Auth::user()->id)->first();
        $funcionariodea =  DB::connection('mysqlgobe')
                                ->table('contribuyente as c')
                                ->leftJoin('unidadadminstrativa as ua', 'c.idDependencia', '=', 'ua.id')
                                ->leftJoin('direccionadministrativa as da', 'c.DA', '=', 'da.ID')
                                ->join('contratos as co', 'c.N_Carnet', 'co.idContribuyente')
                                ->where('c.Estado', '=', '1')->where('co.Estado', '1')
                                ->where('c.id', $funcionario->funcionario_id)
                                ->select('c.id', 'c.DA')
                                ->first();

        if (auth()->user()->hasRole('ventanilla') && auth()->user()->hasRole('funcionario')) {
            $query_filtro = 'registrado_por_id_direccion = '.$funcionariodea->DA;
        } elseif (auth()->user()->hasRole('ventanilla') && !auth()->user()->hasRole('funcionario')) {
            $query_filtro = 'tipo = "E" and registrado_por_id_direccion = '.$funcionariodea->DA;
        } elseif (auth()->user()->isAdmin() || auth()->user()->id == 28) {
            $query_filtro = 1;
        }
        elseif (!auth()->user()->hasRole('ventanilla') && auth()->user()->hasRole('funcionario')) {
            $query_filtro = 'tipo = "I" and funcionario_id_remitente = '.$funcionario->funcionario_id;
        } 

        $data = Entrada::with(['entity:id,nombre', 'estado:id,nombre'])
                        ->whereRaw($query_filtro)
                        ->select([
                            'id','tipo','gestion','estado_id','cite','remitente','referencia','entity_id','created_at',
                            'funcionario_id_destino'
                        ])
                        ->where('deleted_at', NULL)->take(10);
         //return $data;

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
                if($row->tipo == 'E'){
                    return $row->entity->nombre ?? 'Sin entidad';
                }else{
                    $origen = '';
                    $direccion = $this->getIdDireccionInfo($row->direccion_id_remitente);
                    $unidad = $this->getIdUnidadInfo($row->unidad_id_remitente);
                    // dd($direccion, $unidad);
                    if($direccion){
                        $origen = $direccion->NOMBRE;
                    }
                    if ($unidad) {
                        $origen = $unidad->Nombre;
                    }
                    return $origen;
                }
            })
            ->addColumn('estado', function($row){
                return $row->estado->nombre;
            })
            ->addColumn('action', function($row){
                $derivar_button = ' <button data-toggle="modal" data-target="#modal-derivar" onclick="derivacionItem('.$row->id.','.$row->funcionario_id_destino.')" title="Derivar" class="btn btn-sm btn-dark view" style="border: 0px">
                                        <i class="voyager-forward"></i> <span class="hidden-xs hidden-sm">Derivar</span>
                                    </button>';
                $actions = '
                    <div class="no-sort no-click bread-actions text-right">
                        '.($row->estado->id == 6 ? $derivar_button : '').'
                        <a href="'.route('entradas.show', ['entrada' => $row->id]).'" title="Ver" class="btn btn-sm btn-info view">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                        </a>
                        '.(($row->derivaciones->count() == 0) ? 
                            '<a href="'.route('entradas.edit', ['entrada' => $row->id]).'" title="Editar" class="btn btn-sm btn-warning">
                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                            </a>' : '').
                        ''.(($row->derivaciones->count() <= 1) ? 
                            '<button title="Anular" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#delete_modal" onclick="deleteItem('."'".url("admin/entradas/".$row->id)."'".')">
                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Anular</span>
                            </button>' : '').
                        '
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
        $entrada = new Entrada;
        $user_auth = Persona::where('user_id', Auth::user()->id)->first();
        $funcionario = $this->getFuncionario($user_auth->funcionario_id);
        return view('entradas.edit-add', compact('entrada','funcionario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        DB::beginTransaction();
        try {

            $persona = Persona::where('user_id', Auth::user()->id)->first();

            $unidad_id_remitente = NULL;
            $direccion_id_remitente = null;
            $funcionario_remitente = NULL;
            /*
                Si el trámite es interno se debe obtener la unidad y la dirección de del remitente (funcionario_id) 
            */
            if($request->tipo == 'I'){
                $unidad_id_remitente = $this->getIdDireccionFuncionario($request->funcionario_id_remitente)->idDependencia;
                $direccion_id_remitente = $this->getIdDireccionFuncionario($request->funcionario_id_remitente)->DA;
            }
           
            $entrada = Entrada::create([
                'gestion' => date('Y'),
                'tipo' => $request->tipo,
                'remitente' => $request->tipo == 'E' ? $request->remitente : $request->remitent_interno,
                'cite' => $request->cite,
                'referencia' => $request->referencia,
                'nro_hojas' => $request->nro_hojas,
                'urgent' => ($request->urgent) ? true : false,
                'deadline' => $request->deadline,
                // 'estado' => 'activo',
                'detalles' => $request->detalles,
                'funcionario_id_remitente' => $request->funcionario_id_remitente,
                'unidad_id_remitente' => $unidad_id_remitente,
                'direccion_id_remitente' => $direccion_id_remitente,
                'funcionario_id_destino' => $request->funcionario_id_destino,
                'registrado_por' => Auth::user()->email,
                // Cambiar el parámetro de la llamada a la funcion getIdDireccionFuncionario
                'registrado_por_id_direccion' => $this->getIdDireccionFuncionario($persona ? $persona->funcionario_id : 844)->DA,
                'registrado_por_id_unidad' => $this->getIdDireccionFuncionario($persona ? $persona->funcionario_id : 844)->idDependencia,
                'entity_id' => $request->entity_id,
                'category_id' => $request->category_id,
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
                        'ruta' => $dir.'/'.$newFileName,
                        'user_id' => Auth::user()->id
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('entradas.index')->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
             dd($th);
            DB::rollback();
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
        $data = Entrada::with(['entity', 'estado', 'archivos.user', 'derivaciones' => function($q){
                    $q->where('deleted_at', NULL);
                }, 'archivos' => function($q){
                    $q->where('deleted_at', NULL);
                }])->where('id', $id)
                ->where('deleted_at', NULL)->first();
        
        /*
            En caso de se una nota interna obtener los datos del remietente
        */
        $origen = '';
        $destino = NULL;
        if($data->tipo == 'I'){
            $direccion = $this->getIdDireccionInfo($data->direccion_id_remitente);
            $unidad = $this->getIdUnidadInfo($data->unidad_id_remitente);
            if($direccion){
                $origen = $direccion->NOMBRE;
            }
            if ($unidad) {
                $origen = $unidad->Nombre;
            }

            $destino = $this->getFuncionario($data->funcionario_id_destino);
        }
        return view('entradas.read', compact('data', 'origen', 'destino'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Entrada $entrada)
    {
        $funcionario = Persona::where('user_id', Auth::user()->id)->first();
        return view('entradas.edit-add', compact('entrada','funcionario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entrada $entrada)
    {
        DB::beginTransaction();
        try {

            $persona = Persona::where('user_id', Auth::user()->id)->first();

            $unidad_id_remitente = NULL;
            $direccion_id_remitente = null;
            $funcionario_remitente = NULL;
            /*
                Si el trámite es interno se debe obtener la unidad y la dirección de del remitente (funcionario_id) 
            */
            if($request->tipo == 'I'){
                $unidad_id_remitente = $this->getIdDireccionFuncionario($request->funcionario_id_remitente)->idDependencia;
                $direccion_id_remitente = $this->getIdDireccionFuncionario($request->funcionario_id_remitente)->DA;
            }

            $date = Carbon::now();

            $entrada->update([
                'tipo' => $request->tipo,
                'remitente' => $request->tipo == 'E' ? $request->remitente : $request->remitent_interno,
                'cite' => $request->cite,
                'referencia' => $request->referencia,
                'nro_hojas' => $request->nro_hojas,
                'urgent' => ($request->urgent) ? true : false,
                'deadline' => $request->deadline,
                // 'estado' => 'activo',
                'detalles' => $request->detalles,
                'funcionario_id_remitente' => $request->funcionario_id_remitente,
                'unidad_id_remitente' => $unidad_id_remitente,
                'direccion_id_remitente' => $direccion_id_remitente,
                'funcionario_id_destino' => $request->funcionario_id_destino ? $request->funcionario_id_destino : $entrada->funcionario_id_destino,
                'entity_id' => $request->entity_id,
                'actualizado_por' => auth()->user()->email,
                'category_id' => $request->category_id,
                'fecha_actualizacion' => $date->toDateTimeString()
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
                        'ruta' => $dir.'/'.$newFileName,
                        'user_id' => Auth::user()->id
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('entradas.index')->with(['message' => 'Registro actualizado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
            DB::rollback();
            return redirect()->route('entradas.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        DB::beginTransaction();
        try {
            $entrada = Entrada::findOrFail($id);
            $entrada->derivaciones()->delete();
            $entrada->delete();
            DB::commit();
            return redirect()->route('entradas.index')->with(['message' => 'Registro anulado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
        }
        
       
    }

    public function print(Entrada $entrada){
        $destino = $entrada->funcionario_id_destino;
        $funcionario = null;
        if ($entrada->funcionario_id_destino) {
            $funcionario = $this->getFuncionario($entrada->funcionario_id_destino);
        }
        $view = view('entradas.hr',['entrada' => $entrada->load(['derivaciones' => function ($q) use($destino){
            $q->where('funcionario_id_para','!=',$destino)->get();
            }],'entity'),'funcionario' =>$funcionario
        ]);
        return $view;
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream();
    }

    public function printhr(Entrada $entrada){
        $view = view('entradas.print-hoja-ruta',['entrada' => $entrada->load('derivaciones','entity')]);
        //return $view;
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream();
    }
    
    public function store_file(Request $request){
        try {
            $file = $request->file('file');
            if ($file) {
                $nombre_origen = $file->getClientOriginalName();
                $newFileName = Str::random(20).'.'.$file->getClientOriginalExtension();
                $dir = "entradas/".date('F').date('Y');
                Storage::makeDirectory($dir);
                Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));
                Archivo::create([
                    'nombre_origen' => $nombre_origen,
                    'entrada_id' => $request->id,
                    'ruta' => $dir.'/'.$newFileName,
                    'user_id' => Auth::user()->id
                ]);
            }
            return redirect()->back()->with(['message' => 'Archivo agregado correctamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->back()->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    public function store_derivacion(Request $request){
        $user = Persona::where('funcionario_id', $request->destinatario)->first();
         /*Si la derivación viene del RDE no se registra al funcionario de origen*/
        
        $rde = $request->redirect ? null : 1;
        $persona = Persona::where('user_id', Auth::user()->id)->first();
        if(!$persona){
            return redirect()->back()->with(['message' => 'No estás registrado como funcionario.', 'alert-type' => 'error']);
        }
       
        DB::beginTransaction();
        try {
            $redirect = $request->redirect ?? 'entradas.index';
             $entrada = Entrada::findOrFail($request->id);
            $funcionario = $this->getFuncionario($request->destinatario);
            if($funcionario){
                // Actualizar estado de la correspondencia
                //$entrada = Entrada::findOrFail($request->id);
                $detaillast = array();
                if (isset($entrada->details)) {
                    $detaillast[] = $entrada->details;
                }
                $detalle = [
                        'id_origen' => auth()->user()->id, 
                        'nombre_origen' => $persona->full_name,
                        'id_para' => $funcionario->id_funcionario,
                        'nombre_para' => $funcionario->nombre,
                        'fecha' => Carbon::now()
                    ];
             
                if (count($detaillast) == 0) {
                    $entrada->details = $detalle;
                } else {
                   array_push($detaillast,$detalle);
                   $entrada->details = $detaillast;
                }
                //dd($detaillast);
                $entrada->estado_id = 3;
                $entrada->save();
                $this->add_derivacion($funcionario, $request, null, $entrada->tipo == 'E' ? $rde: NULL);
                DB::commit();
            }else{
                return redirect()->route($redirect)->with(['message' => 'El destinatario elegido no es un funcionario.', 'alert-type' => 'error']);
            }
            return redirect()->route($redirect)->with(['message' => 'Correspondecia derivada exitosamente.', 'alert-type' => 'success', 'funcionario_id' => $user ? $user->user_id : null]);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return redirect()->route($redirect)->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    public function derivacion_index(){
        $funcionario = Persona::where('user_id', Auth::user()->id)->first();
        $ingresos = [];
        $funcionario_id = null;
        if ($funcionario) {
            $funcionario_id = $funcionario->funcionario_id;
            $ingresos = Entrada::with('entity')
                        ->whereHas('derivaciones', function(Builder $query) use($funcionario_id){
                            $query->where('funcionario_id_para', $funcionario_id);
                            $query->where('deleted_at',null);
                        })
                        ->where('deleted_at', NULL)
                        ->get();
        }
        return view('bandeja.browse', compact('ingresos', 'funcionario_id'));
    }

    public function derivacion_show($id)
    {
        try {
            $derivacion =  Derivation::findOrFail($id);
            $derivacion->visto = Carbon::now();
            $derivacion->save();
            $data = Entrada::with(['entity', 'estado', 'archivos.user', 'derivaciones' => function($q){
                                $q->where('deleted_at',null);
                            }])
                            ->where('id', $derivacion->entrada_id)
                            ->where('deleted_at', NULL)
                            ->first();

            $origen = '';
            $destino = NULL;
            if($data->tipo == 'I'){
                $direccion = $this->getIdDireccionInfo($data->direccion_id_remitente);
                $unidad = $this->getIdUnidadInfo($data->unidad_id_remitente);
                if($direccion){
                    $origen = $direccion->NOMBRE;
                }
                if ($unidad) {
                    $origen = $unidad->Nombre;
                }

                $destino = $this->getFuncionario($data->funcionario_id_destino);
            }
            return view('bandeja.read', compact('data', 'origen', 'destino'));
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->route('voyager.dashboard');
        }
    }

    public function derivacion_archivar(Request $request){
        // dd($request);
        try {
            /* CAmbiar el estado de la entrada a finalizada */
            Entrada::where('id', $request->id)->update(['estado_id' => 4]);
            return redirect()->route('bandeja.index')->with(['message' => 'Correspondencia archivada exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('bandeja.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    public function derivacion_rechazar($id, Request $request)
    {
        try {
            $persona = Persona::where('user_id', Auth::user()->id)->first();
            // Obtener la última derivación que se realizo al usuario actual
            $derivacion = Derivation::where('entrada_id', $id)
                                ->where('funcionario_id_para', $persona->funcionario_id)
                                ->where('deleted_at', NULL)->where('rechazo', NULL)->orderBy('id', 'DESC')->first();

            if(!$derivacion){
                return redirect()->route('bandeja.index')->with(['message' => 'No puedes rechazr un un tramite creado por ti mismo.', 'alert-type' => 'error']);
            }            

            // Si solo ha habido una sola derivación se anula, sino se deriva al último remitente
            if ($derivacion->funcionario_id_de) {
                $funcionario = $this->getFuncionario($derivacion->funcionario_id_de);
                if($funcionario){
                    $this->add_derivacion($funcionario, $request, 1);
                }else{
                    return redirect()->route('bandeja.index')->with(['message' => 'El destinatario elegido no es un funcionario.', 'alert-type' => 'error']);
                }
            } else {
                Entrada::where('id', $derivacion->entrada_id)->update(['estado_id' => 6, 'referencia' => $request->observacion]);
            }

            return redirect()->route('bandeja.index')->with(['message' => 'Correspondecia rehazada exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->route('voyager.dashboard')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    public function delete_derivacion(Request $request){
        // dd($request);
        try {
            Derivation::where('id', $request->id)->update(['deleted_at' => Carbon::now()]);
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Derivación anulada exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    public function delete_derivacion_file(Request $request){
        // dd($request);
        try {
            Archivo::where('id', $request->id)->update(['deleted_at' => Carbon::now()]);
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Archivo eliminado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }


    // =============================================================

    public function add_derivacion($funcionario, $request, $rechazo = NULL, $rde = null){
        $persona = Persona::where('user_id', Auth::user()->id)->first();
        return Derivation::create([
            'entrada_id' => $request->id,
            'funcionario_id_de' => $rde ? null : $persona->funcionario_id,
            'funcionario_id_para' => $funcionario->id_funcionario,
            'funcionario_nombre_para' => $funcionario->nombre,
            'funcionario_cargo_para' => $funcionario->cargo,
            'funcionario_direccion_id_para' => $funcionario->id_direccion ?? null,
            'funcionario_direccion_para' => $funcionario->direccion ?? null,
            'funcionario_unidad_id_para' => $funcionario->id_unidad ?? null,
            'funcionario_unidad_para' => $funcionario->unidad ?? null,
            'responsable_actual' => 1,
            'rechazo' => $rechazo,
            'registro_por' => Auth::user()->email,
            'observacion' => $request->observacion
        ]);
    }
}
