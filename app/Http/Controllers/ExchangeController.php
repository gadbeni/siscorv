<?php

namespace App\Http\Controllers;

use App\Models\Derivation;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExchangeController extends Controller
{
    public function index()
    {
        // return 1;
        $people = Person::all();
        // return $people;
        return view('exchange.search', compact('people'));
    }
    
    public function print(Request $request)
    {
        // dd($request);
        // $data = Derivation::where('deleted_at')
        $people = Person::where('id', '!=', $request->people_id)->get();

        $derivaciones = Derivation::with([
            'entrada:id,tipo,gestion,cite,remitente,referencia,estado_id,urgent,deadline',
            'entrada.estado:id,nombre',
            'derivationparent:id,tipo,gestion,cite,remitente,urgent',
            'parents'
        ])
        ->select('id','entrada_id','created_at','visto','people_id_para','parent_id','parent_type', 'derivation')
        ->where('derivation', 0)
        ->where('transferred', 0)
        ->where('people_id_para', $request->people_id)->get();

        return view('exchange.print-search', compact('derivaciones', 'people'));
    }
    public function transfer(Request $request)
    {
        // return $request;
        $cant = count($request->derivation_id);
        $user = Auth::user();
        // return $cant;
        if($cant > 0)
        {
            DB::beginTransaction();
            try {
                $i=0;
                while($i < $cant)
                {
                    $aux = Derivation::find($request->derivation_id[$i]);
                    $funcionario = $this->getPeople($request->people_id);
                    // return $funcionario;

                    $ok = Derivation::create([
                        'funcionario_nombre_para'=>$funcionario->nombre,
                        'funcionario_cargo_id_para'=>$aux->funcionario_cargo_id_para,
                        'funcionario_cargo_para'=>$funcionario->cargo,
                        'funcionario_direccion_id_para'=>$funcionario->id_direccion? $funcionario->id_direccion:'',
                        'funcionario_direccion_para'=>$funcionario->direccion? $funcionario->direccion:'',
                        'funcionario_unidad_id_para'=>$funcionario->id_unidad? $funcionario->id_unidad:'',
                        'funcionario_unidad_para'=>$funcionario->unidad? $funcionario->unidad:'',
                        'responsable_actual'=>$aux->responsable_actual,
                        'logico'=>$aux->logico,
                        'fisico'=>$aux->fisico,
                        'fecha_fisico'=>$aux->fecha_fisico,
                        'observacion'=>$aux->observacion,
                        'estado'=>$aux->estado,
                        'registro_por'=>$aux->registro_por,
                        'fecha_registro'=>$aux->fecha_registro,
                        'actualizado_por'=>$aux->actualizado_por,
                        'fecha_actualizacion'=>$aux->fecha_actualizacion,
                        'rechazo'=>$aux->rechazo,
                        'entrada_id'=>$aux->entrada_id,
                        'parent_id'=>$aux->parent_id,
                        'parent_type'=>$aux->parent_type,
                        'via'=>$aux->via,
                        'people_id_de'=>$aux->people_id_de,
                        'people_id_para'=>$request->people_id,

                        'derivation'=>0,
                        'ok'=>'NO'
                        // 'derivation'=>$aux->derivation,
                        // 'ok'=>$aux->ok
                    ]);
                    $aux->update([
                        'transferred'=>1,
                        'transferredUser_id'=>$user->id,
                        'transferredDetails'=>$request->detail,
                        'transferredPeople_id'=>$request->people_id,
                        'transferredDate'=> Carbon::now()
                    ]);



                    $i++;
                }
                DB::commit();
            return redirect()->route('exchange.index')->with(['message' => 'Mensaje Transferido Exitosamente', 'alert-type' => 'success']);

            } catch (\Throwable $th) {
                DB::rollBack();
                // return 0;
                return redirect()->route('exchange.index')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
            }
        }
        else
        {
            return redirect()->route('exchange.index')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }
}
