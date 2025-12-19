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
use Illuminate\Support\Facades\Cache;


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
        if(!$direccion_id) return null;
        try {
            return Cache::remember('direccion_'.$direccion_id, 3600, function() use ($direccion_id){
                return DB::connection('mamore')->table('direcciones')->where('id', $direccion_id)->select('*')->first();
            });
        } catch (\Throwable $th) {
            return null;
        }
    }

    static function getIdUnidadInfo($unidad_id)
    {
        if(!$unidad_id) return null;
        try {
            return Cache::remember('unidad_'.$unidad_id, 3600, function() use ($unidad_id){
                return DB::connection('mamore')->table('unidades')->where('id', $unidad_id)
                    ->first();
            });
        } catch (\Throwable $th) {
            return null;
        }
    }

    //obtencioin de los funcionarios en la BD mamore
    public function getPeople($id)
    {
        if(!$id) return null;
        return Cache::remember('people_'.$id, 3600, function() use ($id){
            $funcionario = DB::connection('mamore')->table('people as p')
                ->leftJoin('contracts as c', 'p.id', 'c.person_id')
                ->leftJoin('direcciones as d', 'd.id', 'c.direccion_administrativa_id')
                ->leftJoin('unidades as u', 'u.id', 'c.unidad_administrativa_id')
                ->leftJoin('jobs as j', 'j.id', 'c.job_id')
                ->where('c.status', 'firmado')
                ->whereNull('c.deleted_at')
                ->where('p.id', $id)
                ->whereNull('p.deleted_at')
                ->select('p.id as id_funcionario', 'p.ci as N_Carnet', 'c.cargo_id', 'c.job_id', 'j.name as cargo', DB::raw("CONCAT(COALESCE(p.first_name, ''), ' ', COALESCE(p.paternal_surname, ''), ' ', COALESCE(p.maternal_surname, '')) as nombre"), 'c.direccion_administrativa_id as id_direccion', 'd.nombre as direccion', 'c.unidad_administrativa_id as id_unidad', 'u.nombre as unidad')
                ->first();

            if ($funcionario && $funcionario->cargo_id != NULL) {
                $cargo = DB::connection('mysqlgobe')->table('cargo')->where('id', $funcionario->cargo_id)->select('*')->first();
                if ($cargo) {
                    $funcionario->cargo = $cargo->Descripcion;
                }
            }
            if (!$funcionario) {
                $funcionario = PeopleExt::with('person')->where('person_id', $id)
                    ->where('status', 1)
                    ->select('direccion_id as id_direccion', 'unidad_id as id_unidad', 'cargo', 'person_id as id_funcionario')
                    ->first();
                if ($funcionario) {
                    if($funcionario->person){
                        $p = $funcionario->person;
                        $funcionario->nombre = trim($p->first_name . ' ' . $p->paternal_surname . ' ' . $p->maternal_surname);
                    }
                    $uni = $this->getIdUnidadInfo($funcionario->id_unidad);
                    $dir = $this->getIdDireccionInfo($funcionario->id_direccion);
                    $funcionario->unidad = $uni->nombre ?? $uni->Nombre ?? '';
                    $funcionario->direccion = $dir->nombre ?? $dir->NOMBRE ?? '';
                }
            }
            return $funcionario;
        });
    }

    public function getPeopleDestino($id)
    {
        return $this->getPeople($id);
    }

    public function getPeopleSN($id)
    {
        if(!$id) return null;
        return Cache::remember('people_sn_'.$id, 3600, function() use ($id){
            return DB::connection('mamore')->table('people as p')
                ->where('p.id', $id)
                ->whereNull('p.deleted_at')
                ->select('p.id as id_funcionario', 'p.ci as N_Carnet', DB::raw("CONCAT(COALESCE(p.first_name, ''), ' ', COALESCE(p.paternal_surname, ''), ' ', COALESCE(p.maternal_surname, '')) as nombre"))
                ->first();
        });
    }

    public function getFile($path){
        if (!file_exists(storage_path("app/public/{$path}"))) {
            abort(404, 'Archivo no encontrado');
        }
        return response()->file(storage_path("app/public/{$path}"));
    }
}
