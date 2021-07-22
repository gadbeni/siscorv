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
        $persona = Persona::where('user_id', Auth::user()->id)->first();
        $funcionario = DB::connection('mysqlgobe')->table('contribuyente as c')
                            ->join('contratos as co', 'c.N_Carnet', 'co.idContribuyente')
                            ->join('cargo as ca', 'ca.ID', 'co.idCargo')
                            ->where('c.Estado', 1)->where('co.Estado', 1)->where('ca.estado', 1)
                            ->where('c.id', $persona->funcionario_id)->select('c.idDependencia', 'c.DA', 'co.idCargo', 'ca.idNivel')->first();
        if($funcionario){
            return config('voyager.user.redirect', route('voyager.dashboard'));
        }else{
            Auth::logout();
            return 'admin';
        }
    }
}
