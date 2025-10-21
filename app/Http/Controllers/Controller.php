<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Derivation;
use App\Models\Entrada;
use Carbon\Carbon;
use App\Models\Person;
use App\Models\PeopleExt;
use App\Models\Persona;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getIdDireccionPeople($people_id)
    {
        try {
            $people = DB::connection('mamore')->table('people as p')
                ->join('contracts as c', 'c.person_id', 'p.id')
                ->where('c.status', 'firmado')
                ->where('c.deleted_at', null)
                ->where('p.id', $people_id)
                ->select('c.direccion_administrativa_id as DA', 'c.unidad_administrativa_id as idDependencia')
                ->first();
            if ($people == '') {
                $people = PeopleExt::with(['person'])
                    ->where('status', 1)
                    ->where('person_id', $people_id)
                    ->select('direccion_id as DA', 'unidad_id as idDependencia')
                    ->first();
            }
            return $people;
        } catch (\Throwable $th) {
            return null;
        }
    }

    static function getIdDireccionInfo($direccion_id)
    {
        try {
            return DB::connection('mamore')->table('direcciones')->where('id', $direccion_id)->select('*')->first();
        } catch (\Throwable $th) {
            return null;
        }
    }

    static function getIdUnidadInfo($unidad_id)
    {
        try {
            return DB::connection('mamore')->table('unidades')->where('id', $unidad_id)
                ->first();
        } catch (\Throwable $th) {
            return null;
        }
    }

    //obtencioin de los funcionarios en la BD mamore
    public function getPeople($id)
    {
        $funcionario = 'null';
        $funcionario = DB::connection('mamore')->table('people as p')
            ->leftJoin('contracts as c', 'p.id', 'c.person_id')
            ->leftJoin('direcciones as d', 'd.id', 'c.direccion_administrativa_id')
            ->leftJoin('unidades as u', 'u.id', 'c.unidad_administrativa_id')
            ->leftJoin('jobs as j', 'j.id', 'c.job_id')
            ->where('c.status', 'firmado')
            ->where('c.deleted_at', null)
            ->where('p.id', $id)
            ->where('p.deleted_at', null)
            ->select('p.id as id_funcionario', 'p.ci as N_Carnet', 'c.cargo_id', 'c.job_id', 'j.name as cargo', DB::raw("CONCAT(COALESCE(p.first_name, ''), ' ', COALESCE(p.paternal_surname, ''), ' ', COALESCE(p.maternal_surname, '')) as nombre"), 'c.direccion_administrativa_id as id_direccion', 'd.nombre as direccion', 'c.unidad_administrativa_id as id_unidad', 'u.nombre as unidad')
            ->first();

        if ($funcionario && $funcionario->cargo_id != NULL) {
            $cargo = DB::connection('mysqlgobe')->table('cargo')->where('id', $funcionario->cargo_id)->select('*')->first();
            $funcionario->cargo = $cargo->Descripcion;
        }
        if (!$funcionario) {
            $funcionario = PeopleExt::where('person_id', $id)
                ->where('status', 1)
                ->select('direccion_id as id_direccion', 'unidad_id as id_unidad', 'cargo', 'person_id as id_funcionario')
                ->first();
            if ($funcionario) {
                $funcionario->unidad = $this->getIdUnidadInfo($funcionario->id_unidad)->nombre;
                $funcionario->direccion = $this->getIdDireccionInfo($funcionario->id_direccion)->nombre;
                $funcionario->nombre = $this->getPeopleSN($funcionario->id_funcionario)->nombre;
            }
        }
        if (!$funcionario) {
            return null;
        }

        return $funcionario;
    }

    public function getPeopleDestino($id)
    {

        $funcionario = DB::connection('mamore')->table('people as p')
            ->leftJoin('contracts as c', 'p.id', 'c.person_id')
            ->leftJoin('direcciones as d', 'd.id', 'c.direccion_administrativa_id')
            ->leftJoin('unidades as u', 'u.id', 'c.unidad_administrativa_id')
            ->leftJoin('jobs as j', 'j.id', 'c.job_id')
            ->where('c.status', 'firmado')
            ->where('c.deleted_at', null)
            ->where('p.id', $id)
            ->where('p.deleted_at', null)
            ->select('p.id as id_funcionario', 'p.ci as N_Carnet', 'c.cargo_id', 'c.job_id', 'j.name as cargo', DB::raw("CONCAT(COALESCE(p.first_name, ''), ' ', COALESCE(p.paternal_surname, ''), ' ', COALESCE(p.maternal_surname, '')) as nombre"), 'c.direccion_administrativa_id as id_direccion', 'd.nombre as direccion', 'c.unidad_administrativa_id as id_unidad', 'u.nombre as unidad')
            ->first();

        if ($funcionario && $funcionario->cargo_id != NULL) {
            $cargo = DB::connection('mysqlgobe')->table('cargo')->where('id', $funcionario->cargo_id)->select('*')->first();
            $funcionario->cargo = $cargo->Descripcion;
        }
        if (!$funcionario) {
            $funcionario = PeopleExt::where('person_id', $id)
                ->where('status', 1)
                ->select('direccion_id as id_direccion', 'unidad_id as id_unidad', 'cargo', 'person_id as id_funcionario')
                ->first();
            $funcionario->unidad = $this->getIdUnidadInfo($funcionario->id_unidad)->nombre;
            $funcionario->direccion = $this->getIdDireccionInfo($funcionario->id_direccion)->nombre;
            $funcionario->nombre = $this->getPeopleSN($funcionario->id_funcionario)->nombre;
        }
        return $funcionario;
    }

    public function getPeopleSN($id)
    {
        $funcionario = DB::connection('mamore')->table('people as p')
            ->where('p.id', $id)
            ->where('p.deleted_at', null)
            ->select('p.id as id_funcionario', 'p.ci as N_Carnet', DB::raw("CONCAT(COALESCE(p.first_name, ''), ' ', COALESCE(p.paternal_surname, ''), ' ', COALESCE(p.maternal_surname, '')) as nombre"))
            ->first();
        return $funcionario;
    }
}
