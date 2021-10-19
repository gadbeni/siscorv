<?php

namespace App\Policies;

use App\Models\Entrada;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;

class EntradaPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){

        if ($user->isAdmin()) {
            return true;
        }

   }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user, Entrada $entrada)
    {
        $funcionario = Persona::where('user_id', $user->id)->first();
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
            return $entrada->registrado_por_id_direccion == $funcionariodea->DA;
        } elseif (auth()->user()->hasRole('ventanilla') && !auth()->user()->hasRole('funcionario')) {
            return $entrada->tipo == 'E' && $entrada->registrado_por_id_direccion == $funcionariodea->DA;
        } elseif (!auth()->user()->hasRole('ventanilla') && auth()->user()->hasRole('funcionario')) {
            return $entrada->tipo == 'I' && $entrada->funcionario_id_remitente == $funcionario->funcionario_id;
        }
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Entrada $entrada)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Entrada $entrada)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Entrada $entrada)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Entrada $entrada)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Entrada $entrada)
    {
        //
    }
}
