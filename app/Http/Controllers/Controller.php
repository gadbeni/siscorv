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


    public function getIdDireccionPeople($people_id) {
        try {
            $people = DB::connection('mamore')->table('people as p')
                        ->join('contracts as c', 'c.person_id', 'p.id')
                        ->where('c.status', 'firmado')
                        ->where('c.deleted_at', null)// add people_id contratcs_if
                        ->where('p.id', $people_id)
                        ->select('c.direccion_administrativa_id as DA', 'c.unidad_administrativa_id as idDependencia')
                        ->first();            

            // return $people;
            if($people=='')
            {
                $people = PeopleExt::with(['person'])
                    ->where('status',1)
                    ->where('person_id', $people_id)
                    ->select('direccion_id as DA', 'unidad_id as idDependencia')
                    ->first();           
            }
            return $people;
            
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getIdDireccionInfo($direccion_id) {
        try {
            return DB::connection('mamore')->table('direcciones')
                        ->where('id', $direccion_id)
                        ->select('*')
                        ->first();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getIdUnidadInfo($unidad_id) {
        try {
            return DB::connection('mamore')->table('unidades')
                        ->where('id', $unidad_id)
                        ->select('*')
                        ->first();
            
        } catch (\Throwable $th) {
            return null;
        }
    }

    //obtencioin de los funcionarios en la BD mamore
    public function getPeople($id)
    {        
        
        $funcionario = DB::connection('mamore')->table('people as p')
            ->leftJoin('contracts as c', 'p.id', 'c.person_id')
            // ->leftJoin('contracts as c', 'p.id', 'c.person_id')
            ->leftJoin('direcciones as d', 'd.id', 'c.direccion_administrativa_id')
            ->leftJoin('unidades as u', 'u.id', 'c.unidad_administrativa_id')
            ->leftJoin('jobs as j', 'j.id', 'c.job_id')
            ->where('c.status', 'firmado')
            ->where('c.deleted_at', null)
            ->where('p.id', $id)
            ->where('p.deleted_at', null)
            ->select('p.id as id_funcionario', 'p.ci as N_Carnet', 'c.cargo_id', 'c.job_id', 'j.name as cargo',
                DB::raw("CONCAT(p.first_name, ' ', p.last_name) as nombre"), 'c.direccion_administrativa_id as id_direccion', 'd.nombre as direccion',
                    'c.unidad_administrativa_id as id_unidad', 'u.nombre as unidad')
            ->first();

        if($funcionario && $funcionario->cargo_id != NULL)
        {
            $cargo = DB::connection('mysqlgobe')->table('cargo')
                ->where('id',$funcionario->cargo_id)
                ->select('*')
                ->first();
    
            $funcionario->cargo=$cargo->Descripcion;
        }
        if(!$funcionario)
        {
                $funcionario = PeopleExt::where('person_id', $id)
                    ->where('status',1)
                    ->select('direccion_id as id_direccion', 'unidad_id as id_unidad', 'cargo', 'person_id as id_funcionario')
                    ->first();
                $funcionario->unidad = $this->getIdUnidadInfo($funcionario->id_unidad)->nombre;
                $funcionario->direccion= $this->getIdDireccionInfo($funcionario->id_direccion)->nombre;
                $funcionario->nombre = $this->getPeopleSN($funcionario->id_funcionario)->nombre;
            
        }


        return $funcionario;
    }

    public function getPeopleSN($id)
    {                
        $funcionario = DB::connection('mamore')->table('people as p')
            ->where('p.id', $id)
            ->where('p.deleted_at', null)
            ->select('p.id as id_funcionario', 'p.ci as N_Carnet', DB::raw("CONCAT(p.first_name, ' ', p.last_name) as nombre"))
            ->first();
        return $funcionario;
    }

    // public function getPersona($id)
    // {
    //     return Persona::where('tipo', 'user')->where('deleted_ad', null)->first();
    // }

    public function getPeopleExt($id)
    {     
        $data = PeopleExt::with(['person'])
            ->where('status',1)
            ->where('person_id', $id)
            ->select('*')
            ->first();
        
        if($data)
        {
            // return $data[0]->person->first_name;
            $unidad= DB::connection('mamore')->table('unidades')->find($data->unidad_id);
            $direccion= DB::connection('mamore')->table('direcciones')->find($data->direccion_id);

            $data->id_funcionario= $data->person_id;
            // return $data;
            $data->nombre = $data->person->first_name.' '.$data->person->last_name;
            $data->unidad = $unidad->nombre? $unidad->nombre : '';
            $data->id_unidad = $unidad->nombre? $unidad->id : '';

            $data->direccion = $direccion->nombre? $direccion->nombre : '';
            $data->id_direccion = $direccion->nombre? $direccion->id : '';
            return $data;
        }
        else
        {
            return false;
        }

        // return $funcionario;
    }

    public function output()
    {
        $persona = Persona::where('user_id', Auth::user()->id)->first();

        $funcionario = DB::connection('mamore')->table('people as p')
                        ->join('contracts as c', 'p.id', 'c.person_id')
                        // ->where('c.status', 'firmado')
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

        if($funcionario == null && $people_ext == null)
        {
            Auth::logout();
            return 'admin';
        }
    }



   



















    // funciones para las derivaciones dobles
    public function generateTreeview($data){
        $servername = "localhost";
        // configuracion 
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $dbname = env('DB_DATABASE');
        
        $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $sql = "SELECT * FROM derivations where entrada_id = $data->id";
        $result = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        
        $menus = array(
            'items' => array(),
            'parents' => array()
        );
        while ($items = mysqli_fetch_assoc($result)) {
                // Create current menus item id into array
                $menus['items'][$items['id']] = $items;
                // Creates list of all items with children
                $menus['parents'][$items['parent_id']][] = $items['id'];
        }
        $derchild = $data->derivaciones()->wherenotNull('parent_id')->first();
        $der = $derchild ? $derchild->parent_id : $data->id;
        
        $results = $this->createTreeView($der, $menus);
       
        return $results;
    }

    public function createTreeView($parent, $menu) {
        $html = "";
        if (isset($menu['parents'][$parent])) {
            $html .= "<ol class='tree'>";
            foreach ($menu['parents'][$parent] as $itemId) {
                 $estilo = $menu['items'][$itemId]['rechazo'] ? 'text-danger' : '';
                if(!isset($menu['parents'][$itemId])) {
                   $html .= "<li class='li'>
                            <label for='subfolder2' class='".$estilo."'><a href='#' data-toggle='modal' data-target='#info_modal'
                            class='".$estilo." btn-showinfo'
                            data-id='".$menu['items'][$itemId]['id']."'
                            data-direccion_para='".$menu['items'][$itemId]['funcionario_direccion_para']."'
                            data-unidad_para='".$menu['items'][$itemId]['funcionario_unidad_para']."'
                            data-observacion='".$menu['items'][$itemId]['observacion']."'
                            >".$menu['items'][$itemId]['funcionario_nombre_para']. ' ['.Carbon::parse($menu['items'][$itemId]['created_at'])->diffForHumans().']'."</a>
                            </label><input type='checkbox' name='subfolder2'/></li>";
                }
                if(isset($menu['parents'][$itemId])) {
                    $html .= "
                    <li class='li'><label for='subfolder2' class='".$estilo."'>
                    <a href='#' data-toggle='modal' data-target='#info_modal'
                        class='".$estilo." btn-showinfo'
                        data-id='".$menu['items'][$itemId]['id']."'
                        data-direccion_para='".$menu['items'][$itemId]['funcionario_direccion_para']."'
                        data-unidad_para='".$menu['items'][$itemId]['funcionario_unidad_para']."'
                        data-observacion='".$menu['items'][$itemId]['observacion']."' 
                        >".$menu['items'][$itemId]['funcionario_nombre_para']. ' ['.Carbon::parse($menu['items'][$itemId]['created_at'])->diffForHumans().']'."</a>
                   
                    </label> <input type='checkbox' name='subfolder2'/>";
                    $html .= $this->createTreeView($itemId, $menu);
                    $html .= "</li>";
                }
            }
            $html .= "</ol>";
        }
        return $html;
    }
}
