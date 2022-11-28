<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;

class EntidadController extends Controller
{
    public function index()
    {
        return view('entidades.browse');
    }

    public function list($search = null){
        $paginate = request('paginate') ?? 10;
        $data = Entity::where(function($query) use ($search){
                    $query->OrWhereRaw($search ? "id = '$search'" : 1)
                    ->OrWhereRaw($search ? "nombre like '%$search%'" : 1)
                    ->OrWhereRaw($search ? "sigla like '%$search%'" : 1);
                    // ->OrWhereRaw($search ? "phone like '%$search%'" : 1);
                    })
                    ->where('deleted_at', NULL)->orderBy('id', 'DESC')->paginate($paginate);
                    // $data = 1;
                    // dd($data->links());
        return view('entidades.list', compact('data'));
    }
}
