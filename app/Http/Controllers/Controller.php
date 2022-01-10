<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Derivation;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getIdDireccionFuncionario($id_funcionario) {
        try {
            return DB::connection('mysqlgobe')->table('contribuyente')
                        ->where('id', $id_funcionario)
                        ->select('DA', 'idDependencia')
                        ->first();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getIdDireccionInfo($direccion_id) {
        try {
            return DB::connection('mysqlgobe')->table('direccionadministrativa')
                        ->where('id', $direccion_id)
                        ->select('*')
                        ->first();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getIdUnidadInfo($unidad_id) {
        try {
            return DB::connection('mysqlgobe')->table('unidadadminstrativa')
                        ->where('id', $unidad_id)
                        ->select('*')
                        ->first();
        } catch (\Throwable $th) {
            return null;
        }
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

    // funciones para las derivaciones dobles
    public function generateTreeview($data){
        $servername = "localhost";
        //configuracion local
        // $username = "root";
        // $password = "";
        // $dbname = "siscor";
        //configuracion en produccion
        $username = "gadbeniadm";
        $password = "gadbeniadm2020";
        $dbname = "siscor_v2";
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
