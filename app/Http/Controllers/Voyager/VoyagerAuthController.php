<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Persona;
use App\Models\PeopleExt;
use App\Models\User;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class VoyagerAuthController extends BaseVoyagerAuthController
{
    public function redirectTo(){
        // Si el sistema está en mantenimiento y el usuario no es admin
        if(env('APP_MAINTENANCE') && !auth()->user()->hasRole('admin'))
        {
            return redirect()->route('maintenance');

            Auth::logout();
            // return redirect()->route('maintenance');
            return 'maintenance';
        }
       
        if(Auth::user()->role_id == 1){
            return 'admin';
        }
        $persona = Persona::where('user_id', Auth::user()->id)->first();

        
        try {
            
            $funcionario = DB::connection('mamore')->table('people as p')
                        ->join('contracts as c', 'p.id', 'c.person_id')
                        ->where('c.status', 'firmado')
                        ->where('c.deleted_at', null)
                        ->where('p.id', $persona->people_id)
                        ->where('p.deleted_at', null)
                        ->select('p.id as id_funcionario', 'p.ci as N_Carnet', 'c.cargo_id', 'c.job_id', 
                            DB::raw("CONCAT(p.first_name, ' ', p.last_name) as nombre"))
                        ->first();
            $people_ext = PeopleExt::where('deleted_at', null)
                ->where('status', 1)
                ->where('person_id', $persona->people_id)
                ->select('*')
                ->first();

                if($funcionario || $people_ext)
                {
                    return config('voyager.user.redirect', route('voyager.dashboard'));
                }
                else
                {
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
