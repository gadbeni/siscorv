<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\VueTables\EloquentVueTables;

class TramiteController extends Controller
{
    public function index() {
        return view('tramites.index');
    }

    public function documentosjson(){
		//if (request()->ajax()) {
			$VueTables = new EloquentVueTables;
	        $data = $VueTables->get(new Entrada, ['id','tipo','cite','remitente','referencia','entity_id','estado_id','category_id','created_at'],['entity:id,nombre', 'estado:id,nombre']);
	        return response()->json($data);
		//}
        //return abort(401);
	}
}
