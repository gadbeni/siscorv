<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getIdDireccionFuncionario($id_funcionario) {
        return DB::connection('mysqlgobe')->table('contribuyente')
                ->where('id', $id_funcionario)
                ->select('DA', 'idDependencia')
                ->first();
    }
}
