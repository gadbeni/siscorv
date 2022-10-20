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
use Barryvdh\DomPDF\Facade\Pdf;

// Models
use App\Models\Entrada;
use App\Models\Via;
use App\Models\Archivo;
use App\Models\Derivation;
use App\Models\Persona;
use App\Models\PeopleExt;
use App\Models\Category;
use App\Models\Person;
use Database\Seeders\PersonasTableSeeder;
use phpDocumentor\Reflection\Types\Nullable;
use PhpParser\Node\Stmt\Return_;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

use function PHPSTORM_META\map;

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
        return view('entradas.browse');
    }

    public function list(){
        $paginate = request('paginate') ?? 10;
        $search = request('search') ?? null;
        $funcionario = Persona::where('user_id', Auth::user()->id)->first();
        $query_filtro = 'people_id_de = '.$funcionario->people_id;
        if (auth()->user()->isAdmin()) {
            $query_filtro = 1;
        }

        $data = Entrada::with(['entity:id,nombre', 'estado:id,nombre'])
                        ->whereRaw($query_filtro)
                        ->select([
                            'id','tipo','gestion','estado_id','cite', 'hr','remitente','referencia','entity_id','created_at', 'people_id_para'
                        ])
                        ->whereRaw($search ? "(hr like '%$search%' or cite like '%$search%' or remitente like '%$search%' or referencia like '%$search%')" : 1)
                        ->where('deleted_at', NULL)->orderBy('id', 'DESC')->paginate($paginate);;
        
        return view('entradas.list', compact('data'));
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
        // $funcionario = $this->getFuncionario($user_auth->funcionario_id);

        $funcionario = $this->getPeople($user_auth->people_id);
        if(!$funcionario)
        {
            
            $funcionario = $this->getPeopleExt($user_auth->people_id);
        }
        
        $category = Category::with(['organization' => function($q){
            $q->where('tipo','tptramites');
        }])->get() ;
     
        return view('entradas.edit-add', compact('entrada','funcionario', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        $request->merge(['cite' =>  strtoupper($request->cite)]);

        $oldtramite = Entrada::where('tipo',$request->tipo)
                            ->where('cite',$request->cite)
                            ->where('deleted_at',NULL)
                            ->first();
        
        
        if ($oldtramite) {
            // return 'cite dupilicado';
            return redirect()->route('entradas.index')->with(['message'=>'El cite ya se encuentra registrado', 'alert-type' => 'error']);
        }

        DB::beginTransaction();
        try {

            $persona = Persona::where('user_id', Auth::user()->id)->first();
            $unidad_id_remitente = NULL;
            $direccion_id_remitente = null;
            $funcionario_remitente = NULL;
            /*
                Si el trámite es interno se debe obtener la unidad y la dirección de del remitente (funcionario_id) 
            */
            // return $request;

            if($persona->people_id)
            {
                // return $request->funcionario_id_remitente;
                if($request->tipo == 'I'){
                    $unidad_id_remitente = $this->getIdDireccionPeople($request->funcionario_id_remitente)->idDependencia;
                    $direccion_id_remitente = $this->getIdDireccionPeople($request->funcionario_id_remitente)->DA;
                }
                // return $this->getPeople($persona->people_id)->cargo;
                $job = $this->getPeople($persona->people_id)->cargo;
                
                $data = Entrada::create([
                    'gestion' => date('Y'),
                    'tipo' => $request->tipo,
                    'remitente' => $request->tipo == 'E' ? $request->remitente : $request->remitent_interno,
                    'cite' => $request->cite,
                    'referencia' => $request->referencia,
                    'nro_hojas' => $request->nro_hojas,
                    'urgent' => ($request->urgent) ? true : false,
                    'deadline' => $request->deadline,
                    // 'estado' => 'activo',
                    'fecha_registro' => $request->fecha_registro,
                    'detalles' => $request->detalles,
                    // 'funcionario_id_remitente' => $request->funcionario_id_remitente,
                    'people_id_de' => $request->funcionario_id_remitente,
                    'job_de' => $job,
                    'unidad_id_remitente' => $unidad_id_remitente,
                    'direccion_id_remitente' => $direccion_id_remitente,
                    // 'funcionario_id_destino' => $request->funcionario_id_destino,
                    'people_id_para' => $request->funcionario_id_destino,
                    'registrado_por' => Auth::user()->email,
                    // Cambiar el parámetro de la llamada a la funcion getIdDireccionFuncionario
                    'registrado_por_id_direccion' => $this->getIdDireccionPeople($persona ? $persona->people_id : 844)->DA,
                    'registrado_por_id_unidad' => $this->getIdDireccionPeople($persona ? $persona->people_id : 844)->idDependencia,
                    'entity_id' => $request->entity_id,
                    'category_id' => $request->category_id,
                    'estado_id' => 6
                ]);
                // return $data;
                

            }
            
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
                        'entrada_id' => $data->id,
                        'ruta' => $dir.'/'.$newFileName,
                        'user_id' => Auth::user()->id
                    ]);
                }
            }
            DB::commit();
            
            return redirect()->route('entradas.index')->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            //  dd($th);
            DB::rollback();
            // return 00;
            return redirect()->route('entradas.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }

    }


    public function show($id)
    {
        // return 2;
        $data = Entrada::with(['entity', 'estado', 'archivos.user', 'derivaciones' => function($q){
                    $q->where('deleted_at', NULL);
                      //->whereNull('parent_id');
                }, 'archivos' => function($q){
                    $q->where('deleted_at', NULL);
                },'vias'])->where('id', $id)
                ->where('deleted_at', NULL)->first();
        /*
            En caso de se una nota interna obtener los datos del remietente
        */
        $origen = '';
        $destino = NULL;
        if($data->tipo == 'I'){
            $destino = $this->getPeopleSN($data->people_id_para);
        }

        return view('entradas.read', compact('data', 'destino'));
    }

  
    public function edit(Entrada $entrada)
    {
        $user_auth = Persona::where('user_id', Auth::user()->id)->first();
        // $funcionario = $this->getFuncionario($user_auth->funcionario_id)        

        if($user_auth->people_id == null)
        {
            
            $funcionario = $this->getFuncionario($user_auth->funcionario_id);
        }
        else
        {
            // return 2;
            $funcionario = $this->getPeople($user_auth->people_id);
        }

        // $funcionario = Persona::where('user_id', Auth::user()->id)->first();
        return view('entradas.edit-add', compact('entrada','funcionario'));
    }

    
    public function update(Request $request, Entrada $entrada)
    {
        DB::beginTransaction();
        try {

            // return $entrada;
            $request->merge(['cite' =>  strtoupper($request->cite)]);

            $persona = Persona::where('user_id', Auth::user()->id)->first();

            $unidad_id_remitente = NULL;
            $direccion_id_remitente = null;
            $funcionario_remitente = NULL;
            /*
                Si el trámite es interno se debe obtener la unidad y la dirección de del remitente (funcionario_id) 
            */
            if($request->tipo == 'I'){
                // $unidad_id_remitente = $this->getIdDireccionPeople($request->funcionario_id_remitente)->idDependencia;
                // $direccion_id_remitente = $this->getIdDireccionPeople($request->funcionario_id_remitente)->DA;
                $unidad_id_remitente = $entrada->unidad_id_remitente;
                $direccion_id_remitente = $entrada->direccion_id_remitente;
            }

            // return $direccion_id_remitente;
            // return $entrada;
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
                // 'funcionario_id_remitente' => $request->funcionario_id_remitente,
                'people_id_de' => $request->funcionario_id_remitente,
                'unidad_id_remitente' => $unidad_id_remitente,
                'direccion_id_remitente' => $direccion_id_remitente,
                // 'funcionario_id_destino' => $request->funcionario_id_destino ? $request->funcionario_id_destino : $entrada->people_id_para,
                'people_id_para' => $request->funcionario_id_destino ? $request->funcionario_id_destino : $entrada->people_id_para,
                'entity_id' => $request->entity_id,
                'actualizado_por' => auth()->user()->email,
                'category_id' => $request->category_id,
                'fecha_actualizacion' => $date->toDateTimeString()
            ]);
            // return $entrada;

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
            //  dd($th);
            DB::rollback();
            return 1;
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

        // return $entrada;
        if($entrada->people_id_de != null && $entrada->people_id_para != null)
        {
            $destino = $entrada->people_id_para;

            $funcionario = DB::table('derivations')
                ->where('via', 0)
                ->where('deleted_at', null)
                ->where('entrada_id', $entrada->id)
                ->select('*')
                ->first();
                // return $funcionario;

            $additional = DB::table('additional_jobs')
                ->where('person_id',$funcionario->people_id_para)
                ->where('status', 1)
                ->select('*')
                ->get();            

        
        //              DE
            $funcionarios = DB::connection('mamore')->table('contracts as c')
                ->leftJoin('jobs as j', 'j.id', 'c.job_id')
                ->where('c.status', 'firmado')
                ->where('c.deleted_at', null)
                ->where('c.person_id', $entrada->people_id_de)
                ->select('c.cargo_id', 'c.job_id', 'j.name as cargo')
                ->first();
            
            if($funcionarios && $funcionarios->cargo_id != NULL)
            {
                $cargo = DB::connection('mysqlgobe')->table('cargo')
                    ->where('id',$funcionarios->cargo_id)
                    ->select('*')
                    ->first();        
                $funcionarios->cargo=$cargo->Descripcion;
            }   
            if(!$funcionarios)
            {
                $funcionarios = PeopleExt::where('person_id', $entrada->people_id_de)
                    ->where('status',1)
                    ->select('*')
                    ->first();
            }

            // return $funcionarios;
            $additionals = DB::table('additional_jobs')
                ->where('person_id',$entrada->people_id_de)
                ->where('status', 1)
                ->select('*')
                ->get();
        
            $de = Person::where('id',$entrada->people_id_de)->first();
        }
        else
        {
            return "Contactese con el Administrador de Sistema";            
        }

        return view('entradas.hr', ['entrada' => $entrada->load(['derivaciones' => function ($q) use($destino){
            $q->where('deleted_at', null)->where('via', 0)->get();
            }],'entity'),'funcionario' => $funcionario
        ], compact('additional', 'funcionarios', 'additionals', 'de'));
    }

    public function printhr(Entrada $entrada){
        // return 3;
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
    //    return $request;
        $destinatarios = $request->destinatarios;
        $persona = Persona::where('user_id', Auth::user()->id)->first();
        // return $persona;
        if(!$persona){
            return redirect()->back()->with(['message' => 'No estás registrado como funcionario.', 'alert-type' => 'error']);
        }
        DB::beginTransaction();
        try {
            $cont = 0; 
            // return $request;
            foreach ($destinatarios as $valor) {
                
                // $user = Persona::where('funcionario_id', $valor)->first();
                $user = Persona::where('people_id', $valor)->first();
                /*Si la derivación viene del RDE no se registra al funcionario de origen*/
                $rde = $request->redirect ? null : 1;
                $redirect = $request->redirect ?? 'entradas.index';
                $entrada = Entrada::findOrFail($request->id);
                // return $entrada;
                // dd($valor);
                $funcionario = $this->getPeople($valor);
                // dd($funcionario);
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
                    //    return $entrada;
                        $entrada->details = $detalle;
                        // return $entrada;
                    } else {
                        array_push($detaillast,$detalle);
                        $entrada->details = $detaillast;
                    }
                    
                    $entrada->estado_id = 3;
                    $entrada->save();
                    $cont++;
                    $this->add_derivacion($funcionario, $request, null, $entrada->tipo == 'E' ? $rde: NULL);

                    DB::commit();
                }else{
                    return redirect()->route($redirect)->with(['message' => 'El destinatario elegido no es un funcionario.', 'alert-type' => 'error']);
                }
            }
            if($request->der_id)
            {
                Derivation::where('id', $request->der_id)->update(['derivation' => 1, 'ok' => 'SI']);
            }
            return redirect()->route($redirect)->with(['message' => 'Correspondecia derivada exitosamente.', 'alert-type' => 'success', 'funcionario_id' => $user ? $user->user_id : null]);
        } catch (\Throwable $th) {
            DB::rollback();
            // dd($th);
            // return 1;
        
            return redirect()->route($redirect)->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    public function derivacion_index(){
        $funcionario = Persona::where('user_id', Auth::user()->id)->first();
        $funcionario_id = null;

        if ($funcionario) {
            $funcionario_id = $funcionario->people_id;
            if (!$funcionario_id) {
                return redirect()->back()->with(['message' => 'Falta tu código de funcionario contáctate con sistema para solucionarlo por favor.', 'alert-type' => 'error']);
            }
            
        }
        // dd($derivaciones);
        return view('bandeja.browse', compact('funcionario_id'));
    }

    public function derivacion_list($funcionario_id, $type){
        $paginate = request('paginate') ?? 10;
        $search = request('search') ?? null;
        switch ($type) {
            case 'pendientes':
                $derivaciones = Derivation::whereHas('entrada', function($q){
                                        $q->where('urgent', 0)->whereNotIn('estado_id', [4, 6]);
                                    })->where('transferred', 0)->where('people_id_para', $funcionario_id)
                                    ->where('ok', '!=', 'ARCHIVADO')
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
                                        $q->where('urgent', 1)->whereNotIn('estado_id', [4, 6]);
                                    })->where('transferred', 0)->where('people_id_para', $funcionario_id)
                                    ->where('ok', '!=', 'ARCHIVADO')
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
                                        // ->whereHas('entrada', function($q){
                                        //     $q->where('urgent', 1)->whereNotIn('estado_id', [4, 6]);
                                        // })
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

    public function derivacion_show($id)
    {
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
                // return 1;
                $direccion = $this->getIdDireccionInfo($data->direccion_id_remitente);
                $unidad = $this->getIdUnidadInfo($data->unidad_id_remitente);
                // return $direccion;
                if($direccion){
                    $origen = $direccion->nombre;
                }
                if ($unidad) {
                    $origen = $unidad->nombre;
                }
            }
            return view('bandeja.read', compact('data', 'origen','derivacion', ));
        } catch (\Throwable $th) {
            //  dd($th);
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
        // return $request;
        try {
            /* CAmbiar el estado de la entrada a finalizada */
            // Entrada::where('id', $request->id)->update(['estado_id' => 4]);
            Derivation::where('id',$request->derivacion_id)->update(['ok'=>'ARCHIVADO']);
            return redirect()->route('bandeja.index')->with(['message' => 'Correspondencia archivada exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->route('bandeja.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    public function derivacion_rechazar($id, Request $request)
    {
        // return $id;
        // return $request;
        
        DB::beginTransaction();
        try {

            $persona = Persona::where('user_id', Auth::user()->id)->first();

            $derivacion = Derivation::where('id', $request->derivacion_id)->first();

            if ($derivacion->people_id_de)
            {
                // return $derivacion;
                $funcionario = $this->getPeople($derivacion->people_id_de);
                if($funcionario =='Error')
                {
                    return redirect()->route('bandeja.index')->with(['message' => 'El funcionario no se encuentra disponible... Contactese con el administrador.', 'alert-type' => 'error']);
                }
                Derivation::create([
                    'entrada_id' => $id,
                    // 'funcionario_id_de' => $rde ? null : $persona->funcionario_id,
                    'people_id_de' => $derivacion->people_id_para,
                    // 'funcionario_id_para' => $funcionario->id_funcionario,
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
                // return $funcionario;
                if($funcionario =='Error')
                {
                    return redirect()->route('bandeja.index')->with(['message' => 'El funcionario no se encuentra disponible... Contactese con el administrador.', 'alert-type' => 'error']);
                }
                // return $entrada;
                Derivation::create([
                    'entrada_id' => $id,
                    // 'funcionario_id_de' => $rde ? null : $persona->funcionario_id,
                    'people_id_de' => $entrada->people_id_para,
                    // 'funcionario_id_para' => $funcionario->id_funcionario,
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
                    'registro_por' => Auth::user()->email,
                    'observacion' => $request->observacion,
                    'parent_id' => $request->derivacion_id,
                    'parent_type' => 'App\Models\Derivation'
                ]);
            }

            Derivation::where('id', $request->derivacion_id)->update(['derivation' => 1, 'ok' => 'RECHAZADO']);
            DB::commit();
            return redirect()->route('bandeja.index')->with(['message' => 'Correspondecia rehazada exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect()->route('voyager.dashboard')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    public function delete_derivacion(Request $request){
        // dd($request);
        try {
            // Derivation::where('id', $request->id)->update(['deleted_at' => Carbon::now()]);

            $ok = Derivation::where('id', $request->id)->where('deleted_at', null)->first();

            Derivation::where('id', $ok->parent_id)->where('deleted_at', null)
                ->update(['derivation'=>0, 'ok'=>'NO']);

            $ok->update(['deleted_at' => Carbon::now()]);

            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Derivación anulada exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
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
        // dd($request);
        // return $request;

        $vias = Via::where('entrada_id',$request->id)->where('deleted_at', null)->get();
        // dd($funcionario->id_funcionario);
        $cant = count(Derivation::where('entrada_id',$request->id)->where('via',1)->where('deleted_at', null)->get());
        // dd($vias);
        if($cant == 0)
        {
            foreach($vias as $data)
            {   
                // dd($data->people_id);
                $viafuncionario = $this->getPeople($data->people_id);
                // dd($viafuncionario);
                $a = Derivation::create([
                    'entrada_id' => $request->id,
                    // 'funcionario_id_de' => $rde ? null : $persona->funcionario_id,
                    'people_id_de' => $rde ? null : $persona->people_id,
                    // 'funcionario_id_para' => $viafuncionario->id_funcionario,
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
                    'registro_por' => Auth::user()->email,
                    'observacion' => $request->observacion,
                    'parent_id' => $request->der_id ? $request->der_id : $request->id,
                    'parent_type' => $request->der_id ? 'App\Models\Derivation' : 'App\Models\Entrada',
                ]);
            }
        }
               

        return Derivation::create([
            'entrada_id' => $request->id,
            // 'funcionario_id_de' => $rde ? null : $persona->funcionario_id,
            'people_id_de' => $rde ? null : $persona->people_id,
            // 'funcionario_id_para' => $funcionario->id_funcionario,
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
            'registro_por' => Auth::user()->email,
            'observacion' => $request->observacion,
            'parent_id' => $request->der_id ? $request->der_id : $request->id,
            'parent_type' => $request->der_id ? 'App\Models\Derivation' : 'App\Models\Entrada',
        ]);
        // dd($si);
    }

    public function store_vias(Request $request){
        DB::beginTransaction();
        // return $request;
        try {
            $entrada = Entrada::findOrFail($request->id);
            $via = $this->getPeople($request->via);
            // return $via;
            
            if($via){
                $entrada->vias()->create([
                    'funcionario_id' => $via->id_funcionario,
                    'people_id' => $via->id_funcionario,
                    'nombre' => $via->nombre,
                    'cargo' => $via->cargo,
                ]);
                DB::commit();
               
            }else{
                return redirect()->back()->with(['message' => 'El destinatario elegido no es un funcionario.', 'alert-type' => 'error']);
            }
       
            return redirect()->back()->with(['message' => 'Via agregada exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            //dd($th);
            return 'Contactese con el Administrador';
            return redirect()->route($redirect)->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    public function anulacion_via(Request $request){
        try {
            Via::findOrFail($request->id)->delete();
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Via Anulada exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->route('entradas.show', ['entrada' => $request->entrada_id])->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }
}
