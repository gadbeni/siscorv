<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use App\Models\Entrada;
use Dflydev\DotAccessData\Data;

class ReportController extends Controller
{
    public function view_report_list()
    {
        $categoria = Category::where('deleted_at', null)
                    ->get();

                    // return $categoria;
        return view('report.view.view_report_list', compact('categoria'));
    }


    //______________________________________________________________________ report print




    public function printf_report_list(Request $request)
    {
        // dd($request);
        $funcionario = Persona::where('user_id', Auth::user()->id)->first();

        // return $funcionario;
        // dd($funcionario);
        $funcionariodea =  DB::connection('mysqlgobe')
                                ->table('contribuyente as c')
                                ->leftJoin('unidadadminstrativa as ua', 'c.idDependencia', '=', 'ua.id')
                                ->leftJoin('direccionadministrativa as da', 'c.DA', '=', 'da.ID')
                                ->join('contratos as co', 'c.N_Carnet', 'co.idContribuyente')
                                ->where('c.Estado', '=', '1')->where('co.Estado', '1')
                                ->where('c.id', $funcionario->funcionario_id)
                                ->select('c.id', 'c.DA')
                                ->first();

                                if (auth()->user()->hasRole('ventanilla') && auth()->user()->hasRole('funcionario')) {
                                    $query_filtro = 'e.registrado_por_id_direccion = '.$funcionariodea->DA;
                                } elseif (auth()->user()->hasRole('ventanilla') && !auth()->user()->hasRole('funcionario')) {
                                    $query_filtro = 'e.tipo = "E" and e.registrado_por_id_direccion = '.$funcionariodea->DA;
                                } elseif (auth()->user()->isAdmin() || auth()->user()->id == 28) {
                                    $query_filtro = 1;
                                }
                                elseif (!auth()->user()->hasRole('ventanilla') && auth()->user()->hasRole('funcionario')) {
                                    $query_filtro = 'e.tipo = "I" and e.funcionario_id_remitente = '.$funcionario->funcionario_id;
                                } 
        // return $funcionariodea;
        // return $query_filtro;
        
        $data = DB::table('entradas as e')
            ->join('entities as t', 't.id', 'e.entity_id')
            ->select('e.id', 'e.cite', 't.nombre as entidad', 'e.fecha_registro', 'e.remitente', 'e.referencia')
            // ->where('e.registrado_por_id_direccion', $funcionariodea->DA)
            ->whereRaw($query_filtro)
            ->where('e.category_id', $request->category_id)
            ->where('e.fecha_registro', '>=', $request->start)
            ->where('e.fecha_registro', '<=', $request->finish)
            // ->where('e.id', 8539)
            ->where('e.deleted_at', null)
            ->orderBy('e.id','desc')
            ->get();

        // return $data;

        // dd($data);


        // select id, cite, fecha_registro, remitente, referencia from entradas where id = 415

        
        // return $funcionariodea;
        // dd($funcionario);

        // return view('report.printf.report_list', compact('data'));


        if($request->print){
            return view('report.printf.report_list_printf', compact('data'));

        }else{
            return view('report.printf.report_list', compact('data'));

        }
    }




}
