<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Persona;
use App\Models\User;

class VoyagerAuthController extends BaseVoyagerAuthController
{
    public function redirectTo(){
        if(Auth::user()->role_id == 1){
            return 'admin';
        }
        $persona = Persona::where('user_id', Auth::user()->id)->first();

        
        try {
            $func_externo = DB::connection('mysqlgobe')->table('contribuyente')
                            ->where('Estado', 1)
                            ->where('id', $persona->funcionario_id)
                            ->select('idDependencia', 'DA','tipo')
                            ->first();
            $funcionario = DB::connection('mysqlgobe')->table('contribuyente as c')
                                ->join('contratos as co', 'c.N_Carnet', 'co.idContribuyente')
                                ->join('cargo as ca', 'ca.ID', 'co.idCargo')
                                ->where('c.Estado', 1)
                                // ->where('co.Estado', 1)
                                ->where('ca.estado', 1)
                                ->where('c.id', $persona->funcionario_id)
                                ->select('c.idDependencia', 'c.DA', 'co.idCargo', 'ca.idNivel','tipo')
                                ->first();
            if($funcionario || $func_externo->tipo == "externo"){
                return config('voyager.user.redirect', route('voyager.dashboard'));
            }else{
                Auth::logout();
                return 'admin';
            }                    
        } catch (Illuminate\Database\QueryException $ex) {
            //dd($ex->getMessage()); 
            //dd($ex);
          // return back()->with(['message' => $th, 'alert-type' => 'success']);
        }
        
    }
}
