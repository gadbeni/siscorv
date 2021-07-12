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

    public function getFuncionario($id){
        return DB::connection('mysqlgobe')->table('contribuyente as c')
                        ->leftJoin('unidadadminstrativa as ua', 'c.idDependencia', '=', 'ua.id')
                        ->leftJoin('direccionadministrativa as da', 'c.DA', '=', 'da.ID')
                        ->where('c.Estado', '=', '1')
                        ->where('c.id', '=', $id)
                        ->select([
                            'c.ID as id_funcionario',
                            'c.NombreCompleto as nombre',
                            'c.Estado as estado',
                            'c.Cargo as cargo',
                            'ua.ID as id_unidad',
                            'ua.Nombre as unidad',
                            'da.ID as id_direccion',
                            'da.NOMBRE as direccion'
                        ])
                        ->first();
    }
}
