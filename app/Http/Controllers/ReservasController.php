<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Carbon\Carbon;
use DataTables;

class ReservasController extends Controller
{
    public function index(){
        return view('reservas.browse');
    }

    public function list(){
        
        $data = Reserva::with(['municipio:id,nombre', 'estado:id,nombre'])
                        ->select([
                            'id','nombre','nombre_solicitante','localidad','numero_recibo','estado_id','costo_reserva','fecha_inicio','created_at'
                        ])
                        ->where('deleted_at', NULL)->take(10);
        return
            Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nombre_reserva', function($row){
                $fecha = new Carbon($row->fecha_inicio);
                $fechaold = new Carbon($row->fecha_inicio);
                $fechaold->addDays(45);
                $now = Carbon::now();
                if ($fecha->diffInDays($now) <= 45) {
                    $res = $row->nombre.'<br><small class="text-success"> Tiene '.$now->diffInDays($fechaold).' días para realizar su trámite</small>';
                } else {
                    $res = $row->nombre.'<br><small class="text-danger"> El plazo era para hace '.$now->diffInDays($fechaold).' días</small>';
                }
                return $res;
            })
            ->addColumn('fecha_ingreso', function($row){
                return date('d/m/Y H:i:s', strtotime($row->created_at)).'<br><small>'.\Carbon\Carbon::parse($row->created_at)->diffForHumans().'</small>';
            })
            ->addColumn('estado', function($row){
                return $row->estado->nombre;
            })
            ->addColumn('action', function($row){
                $actions = '
                    <div class="no-sort no-click bread-actions text-right">
                        <a href="'.route('reservas.show', $row->id).'" title="Ver" class="btn btn-sm btn-info view">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                        </a>
                        <a href="'.route('reservas.edit',$row->id).'" title="Editar" class="btn btn-sm btn-warning">
                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                        </a>
                        <button title="Anular" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#delete_modal" onclick="deleteItem('."'".url("admin/reservas/".$row->id)."'".')">
                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Anular</span>
                        </button>
                    </div>
                        ';
                return $actions;
            })
            ->rawColumns(['nombre_reserva', 'origen', 'fecha_ingreso', 'estado', 'action'])
            ->make(true);
    }

    public function create() {
        $reserva = new Reserva;
        return view('reservas.add_edit',compact('reserva'));
    }

    public function edit(Reserva $reserva) {
        return view('reservas.add_edit',compact('reserva'));
    }

    public function update(Request $request) {
        
    }

    public function destroy(Reserva $reserva) {
        
    }
}
