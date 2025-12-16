<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FileController;
use Carbon\Carbon;
use Storage;

// Models
use App\Models\Via;
use App\Models\Archivo;
use App\Models\Entrada;
use App\Models\Persona;
use App\Models\Derivation;
use App\Models\MensajeEnviado;
use App\Models\PjNameReservation;
use App\Models\PjNameFile;
use App\Models\User;
use Illuminate\Support\Facades\Http;

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
    public function index(){
        if(env('APP_MAINTENANCE') && !auth()->user()->hasRole('admin')) {
            Auth::logout();
            return redirect()->route('maintenance');
        }
        return view('entradas.browse');
    }

    public function list(){
        $paginate = request('paginate') ?? 10;
        $search = request('search') ?? null;
        // $funcionario = Persona::where('user_id', Auth::user()->id)->first();

        $data = Entrada::with(['entity:id,nombre', 'estado:id,nombre'])
                        ->select([
                            'id','tipo','gestion','estado_id','cite', 'hr','remitente','referencia','entity_id','created_at', 'people_id_para', 'personeria'
                        ])
                        // ->when(!auth()->user()->isAdmin(), function ($query) use ($funcionario) {
                        //     $query->where('people_id_de', $funcionario ? $funcionario->people_id : 0);
                        // })
                        ->when($search, function ($query) use ($search) {
                            $query->where(function($q) use ($search) {
                                $q->where('hr', 'like', "%{$search}%")
                                  ->orWhere('cite', 'like', "%{$search}%")
                                  ->orWhere('remitente', 'like', "%{$search}%")
                                  ->orWhere('referencia', 'like', "%{$search}%");
                            });
                        })
                        ->whereNull('deleted_at')
                        ->orderBy('id', 'DESC')->paginate($paginate);

        dump($data);

        // return view('entradas.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $entrada = new Entrada;
        $funcionario = null;
        $user_auth = Persona::where('user_id', Auth::user()->id)->first();
        if($user_auth){
            if($user_auth->people_id == null){
                $funcionario = $this->getFuncionario($user_auth->funcionario_id);
            }else{
                $funcionario = $this->getPeople($user_auth->people_id);
            }
        }
        return view('entradas.edit-add', compact('entrada', 'funcionario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){  
        // return $request->all();
        $request->merge(['cite' =>  strtoupper($request->cite)]);

        //para verificar si exixte el cite regsitrado
        $oldtramite = Entrada::where('tipo', $request->tipo)
                            ->where('cite', $request->cite)
                            ->where('deleted_at', NULL)
                            ->first();       
        if ($oldtramite) {
            return redirect()->route('entradas.index')->with(['message'=>'El cite ya se encuentra registrado', 'alert-type' => 'error']);
        }
        DB::beginTransaction();
        try {
            $persona = Persona::where('user_id', Auth::user()->id)->first();
            if ($persona) {
                if($persona->people_id){
                    // Obtener información del funcionario que está registrando la nota
                    $funcionario_remitente = $this->getPeople($persona->people_id);
                    if(!$funcionario_remitente){
                        return redirect()->route('entradas.index')->with(['message' => 'El remitente no tienes contrato vigente', 'alert-type' => 'error']);
                    }
                    
                    $data = Entrada::create([
                        'gestion' => date('Y'),
                        'tipo' => $request->tipo,
                        'remitente' => $request->tipo == 'E' ? $request->remitente : $request->remitent_interno,
                        'cite' => $request->cite,
                        'referencia' => $request->referencia,
                        'nro_hojas' => $request->nro_hojas,
                        'urgent' => ($request->urgent) ? true : false,
                        'deadline' => $request->deadline,
                        'fecha_registro' => $request->fecha_registro,
                        'detalles' => $request->detalles,
                        'people_id_de' => $request->funcionario_id_remitente,
                        'job_de' => $funcionario_remitente->cargo,
                        'direccion_id_remitente' => $request->tipo == 'I' ? $funcionario_remitente->id_direccion : null,
                        'unidad_id_remitente' => $request->tipo == 'I' ? $funcionario_remitente->id_unidad : null,
                        'people_id_para' => $request->funcionario_id_destino,
                        'job_para' => $this->getPeople($request->funcionario_id_destino)->cargo,
                        'registrado_por' => Auth::user()->email,
                        'registrado_por_id_direccion' => $funcionario_remitente->id_direccion,
                        'registrado_por_id_unidad' => $funcionario_remitente->id_unidad,
                        'entity_id' => $request->entity_id,
                        'category_id' => $request->category_id,
                        'estado_id' => 6,
                        'personeria'=>$request->pj ? 1 : 0,
                        'user_id' => Auth::user()->id
                    ]);
    
                    if($request->pj){
                        $objFile = new FileController();
                        $reservation = PjNameReservation::create([
                            'entrada_id'=>$data->id,
                            'applicant'=>$request->nameSolicitante,
                            'name'=>$request->namePersoneria,
                            'phone'=>$request->cellPersoneria,
                            'status'=>'pendiente'
                        ]);
                        $fileP = PjNameFile::create([
                            'nameReservation_id'=>$reservation->id,
                            'registerUser' => Auth::user()->name
                        ]);
    
                        $file = $request->file('solicitud_p');
                        if ($file) {
                            $fileP->update(['solicitud'=>$objFile->file($file, 'sidepej/solicitud')]);                        
                        }
    
                        $file = $request->file('carnet_p');
                        if ($file) {
                            $fileP->update(['carnet'=>$objFile->file($file, 'sidepej/carnet')]);                                                
                        }
                        $file = $request->file('deposito_p');
                        if ($file) {
                            $fileP->update(['deposito'=>$objFile->file($file, 'sidepej/deposito')]);                                                                        
                        }
                        $file = $request->file('poder_p');
                        if ($file) {
                            $fileP->update(['poder'=>$objFile->file($file, 'sidepej/poder')]);                                                                        
                        }
                    }
                }
            }else{
                return redirect()->route('entradas.index')->with(['message' => 'No estas asociado a un funcionario contratado', 'alert-type' => 'error']);
            }
            
            $file = $request->file('archivos');
            $storage = new StorageController();
            if ($file) {
                for ($i=0; $i < count($file); $i++) { 


                    $nombre_origen = $file[$i]->getClientOriginalName();


                    // dump($nombre_origen);

                    // return 1;
                    // $newFileName = Str::random(20).'.'.$file[$i]->getClientOriginalExtension();
                    // $dir = "entradas/".date('F').date('Y');
                    // Storage::makeDirectory($dir);
                    // Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file[$i]));
                    Archivo::create([
                        'nombre_origen' => $nombre_origen,
                        'entrada_id' => $data->id,
                        'ruta' => $storage->store_file($file[$i], 'entradas'),
                        'user_id' => Auth::user()->id
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('entradas.index')->with(['message' => 'Registro guardado exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            //  dd($th);
             return 0;
            return redirect()->route('entradas.index')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }


    public function show($id){
        $data = Entrada::with(['entity', 'estado', 'archivos.user', 'derivaciones' => function($q){
                    $q->where('deleted_at', NULL);
                }, 'archivos' => function($q){
                    $q->where('deleted_at', NULL);
                },'vias'])->where('id', $id)
                ->where('deleted_at', NULL)->first();
                
        if ($data->user_id){
            $user_entrada = User::where('id', $data->user_id)->first();
        }else{
            $people_entrada = Persona::where('people_id', $data->people_id_de)->orderBy('created_at','DESC')->first();
            $user_entrada = User::where('id', $people_entrada->user_id)->first();
        }
        
        $nci = Archivo::where('entrada_id', $id)->where('deleted_at', null)->get();
        return view('entradas.read', compact('data', 'nci','user_entrada'));
    }

    public function entradaFile(Request $request){
        // return $request;
        DB::beginTransaction();
        try {
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
                        'entrada_id' => $request->id,
                        'ruta' => $dir.'/'.$newFileName,
                        'user_id' => Auth::user()->id,
                        'nci'=>1
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('entradas.show', ['entrada' => $request->id])->with(['message' => 'Registro guardado exitosamente', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('entradas.show', ['entrada' => $request->id])->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);

        }
    }
  
    public function edit(Entrada $entrada){
        $user_auth = Persona::where('user_id', Auth::user()->id)->first();
        if($user_auth->people_id == null){
            $funcionario = $this->getFuncionario($user_auth->funcionario_id);
        }else{
            $funcionario = $this->getPeople($user_auth->people_id);
        }
        return view('entradas.edit-add', compact('entrada','funcionario'));
    }

    public function update(Request $request, Entrada $entrada){
        DB::beginTransaction();
        try {

            // return $entrada;
            $request->merge(['cite' =>  strtoupper($request->cite)]);
            $persona = Persona::where('user_id', Auth::user()->id)->first();

            $unidad_id_remitente = NULL;
            $direccion_id_remitente = null;
            $funcionario_remitente = NULL;
            // Si el trámite es interno se debe obtener la unidad y la dirección de del remitente (funcionario_id)
            //dd($request->tipo);
            $tipo_entrada = $request->tipo;
            if($tipo_entrada == 'I'){
                $unidad_id_remitente = $entrada->unidad_id_remitente;
                $direccion_id_remitente = $entrada->direccion_id_remitente;
            }

            $date = Carbon::now();

            $entrada->update([
                'tipo' => $tipo_entrada,
                'remitente' => $tipo_entrada == 'E' ? $request->remitente : $request->remitent_interno,
                'cite' => $request->cite,
                'referencia' => $request->referencia,
                'nro_hojas' => $request->nro_hojas,
                'urgent' => ($request->urgent) ? true : false,
                'deadline' => $request->deadline,
                // 'estado' => 'activo',
                'detalles' => $request->detalles,
                // 'funcionario_id_remitente' => $request->funcionario_id_remitente,
                'people_id_de' => $request->funcionario_id_remitente,
                'unidad_id_remitente' => $unidad_id_remitente,
                'direccion_id_remitente' => $direccion_id_remitente,
                // 'funcionario_id_destino' => $request->funcionario_id_destino ? $request->funcionario_id_destino : $entrada->people_id_para,
                'people_id_para' => $request->funcionario_id_destino ? $request->funcionario_id_destino : $entrada->people_id_para,
                'job_para' => $this->getPeople($request->funcionario_id_destino)->cargo,
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
            return redirect()->route('entradas.index')->with(['message' => 'Registro actualizado exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            //  dd($th);
            DB::rollback();
            return redirect()->route('entradas.index')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }

    public function destroy($id){  
        // return $id;
        DB::beginTransaction();
        try {
            $entrada = Entrada::findOrFail($id);
            // return $entrada;
            
            if($entrada->personeria)
            {
                $name = PjNameReservation::where('entrada_id', $entrada->id)->first();
                PjNameFile::where('nameReservation_id', $name->id)->update(['deleted_at'=> Carbon::now()]);
                $name->update(['deleted_at'=> Carbon::now(), 'deletedUser_id'=>Auth::user()->id]);
            }
            $entrada->derivaciones()->delete();
            $entrada->delete();

            DB::commit();
            return redirect()->route('entradas.index')->with(['message' => 'Registro anulado exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return redirect()->route('entradas.index')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }

    // Imprimir

    public function print(Entrada $entrada){

        $entrada = $entrada;
        $additional = DB::table('additional_jobs')
                ->where('person_id',$entrada->people_id_de)
                ->where('status', 1)
                ->select('*')
                ->get();
        $additionals = DB::table('additional_jobs')
                ->where('person_id',$entrada->people_id_para)
                ->where('status', 1)
                ->select('*')
                ->get();      
        $via = Via::where('entrada_id', $entrada->id)->where('deleted_at', null)->get();
        return view('entradas.hr', compact('entrada', 'via', 'additional', 'additionals'));
    }

    // public function printhr(Entrada $entrada){
    //     // return 3;
    //     $view = view('entradas.print-hoja-ruta',['entrada' => $entrada->load('derivaciones','entity')]);
    //     //return $view;
    //     $pdf = \App::make('dompdf.wrapper');
    //     $pdf->loadHTML($view);
    //     return $pdf->stream();
    // }
    public function printhr(Entrada $entrada){
        return view('entradas.documents.hoja-ruta',['entrada' => $entrada]);
    }


    // Guardar Archivo
    public function store_file(Request $request){
        try {
            $file = $request->file('file');
            if ($file) {
                $nombre_origen = $file->getClientOriginalName();
                $storage = new StorageController();
                Archivo::create([
                    'nombre_origen' => $nombre_origen,
                    'entrada_id' => $request->id,
                    'ruta' => $storage->store_file($file, 'entradas'),
                    'user_id' => Auth::user()->id
                ]);
            }
            return redirect($_SERVER['HTTP_REFERER'])->with(['message' => 'Archivo agregado correctamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
            return redirect($_SERVER['HTTP_REFERER'])->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }

    // Derivaciones
    public function derivacion_index(){

        if(env('APP_MAINTENANCE') && !auth()->user()->hasRole('admin')){
            Auth::logout();
            return redirect()->route('maintenance');
        }

        $funcionario = Persona::where('user_id', Auth::user()->id)->first();
        $funcionario_id = null;

        if ($funcionario) {
            $funcionario_id = $funcionario->people_id;
            if (!$funcionario_id) {
                return redirect('admin')->with(['message' => 'Falta tu código de funcionario contáctate con la Unidad de Sistemas para solucionarlo por favor', 'alert-type' => 'error']);
            }
        }
        return view('bandeja.browse', compact('funcionario_id'));
    }

    public function derivacion_list($funcionario_id, $type){
        $paginate = request('paginate') ?? 10;
        $search = request('search') ?? null;
        switch ($type) {
            case 'pendientes':
                $derivaciones = Derivation::whereHas('entrada', function($q){
                                        $q->where('personeria', 0)->where('urgent', 0)->whereNotIn('estado_id', [4, 6]);
                                    })->where('transferred', 0)->where('people_id_para', $funcionario_id)
                                    ->where('ok', 'NO')
                                    ->where(function($query) use ($search){
                                        if($search){
                                            $query->OrwhereHas('entrada', function($query) use($search){
                                                $query->whereRaw("(hr like '%$search%' or cite like '%$search%' or remitente like '%$search%' or referencia like '%$search%')");
                                            })
                                            ->OrWhereRaw("id = '$search'");
                                        }
                                    })
                                    ->orderBy('id', 'DESC')->paginate($paginate);
                return view('bandeja.pendientes', compact('derivaciones'));
                break;
            case 'derivados':
                $derivaciones = Derivation::whereHas('entrada', function($q){
                                        $q->where('personeria', 0)->whereNotIn('estado_id', [4, 6]);
                                    })->where('transferred', 0)->where('people_id_para', $funcionario_id)
                                    ->where('ok', 'SI')
                                    ->where(function($query) use ($search){
                                        if($search){
                                            $query->OrwhereHas('entrada', function($query) use($search){
                                                $query->whereRaw("(hr like '%$search%' or cite like '%$search%' or remitente like '%$search%' or referencia like '%$search%')");
                                            })
                                            ->OrWhereRaw("id = '$search'");
                                        }
                                    })
                                    ->orderBy('id', 'DESC')->paginate($paginate);
                return view('bandeja.pendientes', compact('derivaciones'));
                break;
            case 'urgentes':
                $derivaciones = Derivation::whereHas('entrada', function($q){
                                        $q->where('personeria', 0)->where('urgent', 1)->whereNotIn('estado_id', [4, 6]);
                                    })->where('transferred', 0)->where('people_id_para', $funcionario_id)
                                    ->where('ok', 'NO')
                                    ->where(function($query) use ($search){
                                        if($search){
                                            $query->OrwhereHas('entrada', function($query) use($search){
                                                $query->whereRaw("(hr like '%$search%' or cite like '%$search%' or remitente like '%$search%' or referencia like '%$search%')");
                                            })
                                            ->OrWhereRaw("id = '$search'");
                                        }
                                    })
                                    ->orderBy('id', 'DESC')->paginate($paginate);
                return view('bandeja.urgentes', compact('derivaciones'));
                break;
            case 'archivados':
                    $derivaciones = Derivation::where('transferred', 0)->where('people_id_para', $funcionario_id)
                                        ->where('ok', 'ARCHIVADO')
                                        ->where(function($query) use ($search){
                                            if($search){
                                                $query->OrwhereHas('entrada', function($query) use($search){
                                                    $query->whereRaw("(hr like '%$search%' or cite like '%$search%' or remitente like '%$search%' or referencia like '%$search%')");
                                                })
                                                ->OrWhereRaw("id = '$search'");
                                            }
                                        })
                                        ->orderBy('id', 'DESC')->paginate($paginate);
                    return view('bandeja.archivados', compact('derivaciones'));
                    break;
        }
    }

    public function store_derivacion(Request $request){
        // dd($request->all());
        $destinatarios = $request->destinatarios;
        $persona = Persona::where('user_id', Auth::user()->id)->first();
        if(!$persona){
            return redirect($_SERVER['HTTP_REFERER'])->with(['message' => 'No estás registrado como funcionario', 'alert-type' => 'error']);
        }
        DB::beginTransaction();
        try {
            $cont = 0; 
            foreach ($destinatarios as $valor) {
        
                $user = Persona::where('people_id', $valor)->first();
                /*Si la derivación viene del RDE no se registra al funcionario de origen*/
                $rde = $request->redirect ? null : 1;
                $redirect = $request->redirect ?? 'entradas.index';
                $entrada = Entrada::findOrFail($request->id);
                $funcionario = $this->getPeople($valor);
                if($funcionario){
                    // Actualizar estado de la correspondencia
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
                    
                    $entrada->estado_id = 3;
                    $entrada->save();
                    $cont++;
                    $this->add_derivacion($funcionario, $request, null, $entrada->tipo == 'E' ? $rde: NULL);

                    if($entrada->personeria)
                    {
                        PjNameReservation::where('entrada_id', $entrada->id)->update(['status'=>'enviado']);
                    }
                    DB::commit();
                }else{
                    return redirect()->route($redirect)->with(['message' => 'El destinatario elegido no es un funcionario', 'alert-type' => 'error']);
                }
            }
            if($request->der_id){
                Derivation::where('id', $request->der_id)->update(['derivation' => 1, 'ok' => 'SI']);
            }
            return redirect()->route($redirect)->with(['message' => 'Correspondecia derivada exitosamente', 'alert-type' => 'success', 'funcionario_id' => $user ? $user->user_id : null]);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route($redirect)->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }

    public function derivacion_show($id){
        
        try {
            $derivacion =  Derivation::where('id',$id)->first();    
            $derivacion->visto = Carbon::now();
            $derivacion->save();              
            $data = Entrada::with(['entity', 'estado', 'archivos.user', 'derivaciones' => function($q){
                                $q->where('deleted_at',null);
                            }])
                            ->where('id', $derivacion->entrada_id)
                            ->where('deleted_at', NULL)
                            ->first();
            $ok = date("d-m-Y", strtotime($data->created_at));
            
            $origen = '';
            $destino = NULL;
            if($data->tipo == 'I'){
                $direccion = $this->getIdDireccionInfo($data->direccion_id_remitente);
                $unidad = $this->getIdUnidadInfo($data->unidad_id_remitente);
                if($direccion){
                    $origen = $direccion->nombre;
                }
                if ($unidad) {
                    $origen = $unidad->nombre;
                }
            }
            return view('bandeja.read', compact('data', 'origen','derivacion', 'ok'));
        } catch (\Throwable $th) {
            return redirect()->route('voyager.dashboard');
        }
    }

    public function treeAjax($id)
    {
        return DB::table('entradas as e')
                        ->join('derivations as d', 'd.entrada_id', 'e.id')
                        ->where('d.deleted_at', null)
                        ->where('e.deleted_at', null)
                        ->where('e.id', $id)
                        ->select('e.id as entrada', 'e.remitente', 'e.cite', 'job_de as cargo', 'd.funcionario_nombre_para as para',
                            'd.funcionario_cargo_para as cargos', 'd.id as derivacion', 'd.parent_id as parent')
                        ->get();
    }

    public function derivacion_archivar(Request $request){
        try {
            /* Cambiar el estado de la entrada a finalizada */
            Derivation::where('id',$request->derivacion_id)->update(['ok'=>'ARCHIVADO', 'observationArchivado'=>$request->observacion]);
            return redirect()->route('bandeja.index')->with(['message' => 'Correspondencia archivada exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->route('bandeja.index')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }

    public function derivacion_rechazar($id, Request $request)
    {        
        DB::beginTransaction();
        try {

            $persona = Persona::where('user_id', Auth::user()->id)->first();

            $derivacion = Derivation::where('id', $request->derivacion_id)->first();

            if ($derivacion->people_id_de)
            {
                $funcionario = $this->getPeople($derivacion->people_id_de);
                if($funcionario == 'Error')
                {
                    return redirect()->route('bandeja.index')->with(['message' => 'El funcionario no se encuentra disponible... Contactese con el administrador', 'alert-type' => 'error']);
                }

                Derivation::create([
                    'entrada_id' => $id,
                    'people_id_de' => $derivacion->people_id_para,
                    'people_id_para' => $funcionario->id_funcionario,
                    'funcionario_nombre_para' => $funcionario->nombre,
                    'funcionario_cargo_para' => $funcionario->cargo,
                    'funcionario_direccion_id_para' => $funcionario->id_direccion ?? null,
                    'funcionario_direccion_para' => $funcionario->direccion ?? null,
                    'funcionario_unidad_id_para' => $funcionario->id_unidad ?? null,
                    'funcionario_unidad_para' => $funcionario->unidad ?? null,
                    'responsable_actual' => 1,
                    'rechazo' => 1,
                    'via'   => 0,
                    'user_id' => Auth::user()->id,
                    'registro_por' => Auth::user()->email,
                    'observacion' => $request->observacion,
                    'parent_id' => $request->derivacion_id,
                    'parent_type' => 'App\Models\Derivation'
                ]);
            }
            else
            {
                $entrada = Entrada::where('id', $id)->where('deleted_at', null)->first();
                $funcionario = $this->getPeople($entrada->people_id_de);
                if($funcionario =='Error'){
                    return redirect()->route('bandeja.index')->with(['message' => 'El funcionario no se encuentra disponible, contáctese con el administrador de SISCOR', 'alert-type' => 'error']);
                }
                Derivation::create([
                    'entrada_id' => $id,
                    'people_id_de' => $entrada->people_id_para,
                    'people_id_para' => $funcionario->id_funcionario,
                    'funcionario_nombre_para' => $funcionario->nombre,
                    'funcionario_cargo_para' => $funcionario->cargo,
                    'funcionario_direccion_id_para' => $funcionario->id_direccion ?? null,
                    'funcionario_direccion_para' => $funcionario->direccion ?? null,
                    'funcionario_unidad_id_para' => $funcionario->id_unidad ?? null,
                    'funcionario_unidad_para' => $funcionario->unidad ?? null,
                    'responsable_actual' => 1,
                    'rechazo' => 1,
                    'via'   => 0,
                    'user_id' => Auth::user()->id,
                    'registro_por' => Auth::user()->email,
                    'observacion' => $request->observacion,
                    'parent_id' => $request->derivacion_id,
                    'parent_type' => 'App\Models\Derivation'
                ]);
            }
            Derivation::where('id', $request->derivacion_id)->update(['derivation' => 1, 'ok' => 'RECHAZADO']);

            // Enviar notificación de Whastapp
            if(setting('servidores.whatsapp') && $derivacion->user){
                if($derivacion->user->phone){
                    $phone = strlen($derivacion->user->phone) == 8 ? '591'.$derivacion->user->phone : $derivacion->user->phone;
                    Http::post(setting('servidores.whatsapp').'/send', [
                        'phone' => $phone,
                        'text' => $request->observacion
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('bandeja.index')->with(['message' => 'Correspondecia rehazada exitosamente', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th);
            return redirect()->route('voyager.dashboard')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }

    // para eliminar la primera derivacion del tramite
    public function delete_derivacions(Request $request){
        DB::beginTransaction();
        try {
            Derivation::where('entrada_id', $request->entrada_id)->where('deleted_at', null)->update(['deleted_at' => Carbon::now()]);

            Via::where('entrada_id', $request->entrada_id)->where('deleted_at', null)->update(['deleted_at' => Carbon::now()]);

            DB::commit();
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Derivación anulada exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }

    public function delete_derivacion(Request $request){
        DB::beginTransaction();
        // dd($request->all());
        try {
            $ok = Derivation::where('id', $request->id)->where('deleted_at', null)->where('entrada_id', $request->entrada_id)->first();
            // return $ok;
            // $ok->update(['deleted_at' => Carbon::now()]);
            $ok->delete();

            $data = Derivation::where('parent_id', $ok->parent_id)->where('deleted_at', null)->where('entrada_id', $request->entrada_id)->count();
            
            // return $data;
            if($data == 0)
            {
                Derivation::where('id', $ok->parent_id)->where('deleted_at', null)->where('entrada_id', $request->entrada_id)
                ->update(['derivation'=>0, 'ok'=>'NO']);
            }

            DB::commit();
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Derivación anulada exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    public function delete_derivacion_file(Request $request){
        try {
            Archivo::where('id', $request->id)->update(['deleted_at' => Carbon::now()]);
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Archivo eliminado exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }


    // =============================================================

    public function add_derivacion($funcionario, $request, $rechazo = NULL, $rde = null){
        $persona = Persona::where('user_id', Auth::user()->id)->first();
        $vias = Via::where('entrada_id',$request->id)->where('deleted_at', null)->get();
        $cant = count(Derivation::where('entrada_id',$request->id)->where('via',1)->where('deleted_at', null)->get());
        if($cant == 0)
        {
            foreach($vias as $data)
            {   
                $viafuncionario = $this->getPeople($data->people_id);
                $a = Derivation::create([
                    'entrada_id' => $request->id,
                    'people_id_de' => $rde ? null : $persona->people_id,
                    'people_id_para' => $viafuncionario->id_funcionario,
                    'funcionario_nombre_para' => $viafuncionario->nombre,
                    'funcionario_cargo_para' => $viafuncionario->cargo,
                    'funcionario_direccion_id_para' => $viafuncionario->id_direccion ?? null,
                    'funcionario_direccion_para' => $viafuncionario->direccion ?? null,
                    'funcionario_unidad_id_para' => $viafuncionario->id_unidad ?? null,
                    'funcionario_unidad_para' => $viafuncionario->unidad ?? null,
                    'responsable_actual' => 1,
                    'rechazo' => $rechazo,
                    'via'   => 1,
                    'user_id' => Auth::user()->id,
                    'registro_por' => Auth::user()->email,
                    'observacion' => $request->observacion,
                    'parent_id' => $request->der_id ? $request->der_id : $request->id,
                    'parent_type' => $request->der_id ? 'App\Models\Derivation' : 'App\Models\Entrada',
                ]);
            }
        }
               

        return Derivation::create([
            'entrada_id' => $request->id,
            'people_id_de' => $rde ? null : $persona->people_id,
            'people_id_para' => $funcionario->id_funcionario,
            'funcionario_nombre_para' => $funcionario->nombre,
            'funcionario_cargo_para' => $funcionario->cargo,
            'funcionario_direccion_id_para' => $funcionario->id_direccion ?? null,
            'funcionario_direccion_para' => $funcionario->direccion ?? null,
            'funcionario_unidad_id_para' => $funcionario->id_unidad ?? null,
            'funcionario_unidad_para' => $funcionario->unidad ?? null,
            'responsable_actual' => 1,
            'rechazo' => $rechazo,
            'via'   => 0,
            'user_id' => Auth::user()->id,
            'registro_por' => Auth::user()->email,
            'observacion' => $request->observacion,
            'parent_id' => $request->der_id ? $request->der_id : $request->id,
            'parent_type' => $request->der_id ? 'App\Models\Derivation' : 'App\Models\Entrada',
        ]);
    }

    public function bandejaDerivationDelete(Request $request)
    {
        // return $request;

        DB::beginTransaction();
        try {
            $ok = Derivation::where('deleted_at', null)->where('visto', null)->where('entrada_id', $request->entrada_id)->where('id',$request->id)->first();
            $ok->update(['deleted_at'=> Carbon::now()]);
            $data = Derivation::where('deleted_at', null)->where('entrada_id', $request->entrada_id)->where('parent_id', $ok->parent_id)->get();
            if(count($data)==0)
            {
                Derivation::where('deleted_at', null)->where('id', $ok->parent_id)->where('entrada_id', $request->entrada_id)->update(['derivation'=>0, 'ok'=>'NO']);
            }
            DB::commit();

            return redirect('admin/bandeja/'.$ok->parent_id)->with(['message' => 'Derivación anulada exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('admin/bandeja/'.$ok->parent_id)->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }


    public function store_vias(Request $request){
        DB::beginTransaction();
        try {
            $entrada = Entrada::findOrFail($request->id);
            foreach ($request->via as $item) {
                $via = $this->getPeople($item);
                if($via){
                    $entrada->vias()->create([
                        'funcionario_id' => $via->id_funcionario,
                        'people_id' => $via->id_funcionario,
                        'nombre' => $via->nombre,
                        'cargo' => $via->cargo,
                    ]);               
                }else{
                    return redirect($_SERVER['HTTP_REFERER'])->with(['message' => 'El destinatario elegido no es un funcionario', 'alert-type' => 'error']);
                }
            }
       
            DB::commit();
            return redirect($_SERVER['HTTP_REFERER'])->with(['message' => 'Via agregada exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route($redirect)->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }

    public function anulacion_via(Request $request){
        try {
            Via::findOrFail($request->id)->delete();
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Via Anulada exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }
    //funcion msj agustin
    public function send_message(Request $request){
        try {
            if (setting('servidores.whatsapp') && setting('servidores.whatsapp-session')) {
                $phone = strlen($request->phone) == 8 ? '591'.$request->phone : $request->phone;
                Http::post(setting('servidores.whatsapp').'/send?id='.setting('servidores.whatsapp-session'), [
                    'phone' => $phone,
                    'text' => $request->message
                ]);

                $usuario = User::where('id', $request->user_id)->first();
                $nombre_del_usuario = $usuario->name;
                // Crear un nuevo registro en la tabla de mensajes enviados
                MensajeEnviado::create([
                    'nombre_persona' => $nombre_del_usuario,
                    'phone' => $request->phone,
                    'message' => $request->message,
                    'fecha_envio' => now(),
                    'user_id' => $request->user_id,
                    'entrada_id' => $request->entrada_id
                ]);
            }
            return response()->json(['success' => 1, 'phone' => $request->phone, 'message' => $request->message]);
        
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => 1]);
        }
    }
}
