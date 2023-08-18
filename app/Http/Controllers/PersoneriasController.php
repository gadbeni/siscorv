<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personeria;
use DataTables;

class PersoneriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('personerias.browse');
    }

    public function list(){
        
        $data = Personeria::with('reserva:id,nombre')
                        ->select([
                            'id','fecha_ingreso','hojaruta','representante','ci','costo_personeria',
                            'fecha_entrega','fecha_conclusion','created_at'
                        ])
                        ->where('deleted_at', NULL)->take(10);
        return
            Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nombre_reserva', function($row){
                return $row->reserva->nombre;
            })
            ->addColumn('fecha_ingreso', function($row){
                return date('d/m/Y H:i:s', strtotime($row->created_at)).'<br><small>'.\Carbon\Carbon::parse($row->created_at)->diffForHumans().'</small>';
            })
            ->addColumn('action', function($row){
                $actions = '
                    <div class="no-sort no-click bread-actions text-right">
                        <a href="'.route('personerias.show', $row->id).'" title="Ver" class="btn btn-sm btn-info view">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                        </a>
                        <a href="'.route('personerias.edit',$row->id).'" title="Editar" class="btn btn-sm btn-warning">
                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                        </a>
                        <button title="Anular" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#delete_modal" onclick="deleteItem('."'".url("admin/personerias/".$row->id)."'".')">
                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Anular</span>
                        </button>
                    </div>
                        ';
                return $actions;
            })
            ->rawColumns(['nombre_reserva', 'origen', 'fecha_ingreso', 'estado', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personeria = new Personeria;
        return view('personerias.add_edit',compact('personeria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personeria $personeria)
    {
        $personeria->delete();
        return redirect()->route('personerias.index')->with(['message' => 'Personeria anulada exitosamente', 'alert-type' => 'success']);
    }
}
