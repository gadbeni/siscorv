<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use App\Models\Entrada;
use Dflydev\DotAccessData\Data;
use Dotenv\Parser\Entry;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class ReportController extends Controller
{
    
    public function view_list_document()
    {
        // $data = Entrada::with(['entity', 'person'])->get();
        // return $data;
        return view('report.view.view_list-document');
    }

    public function printf_list_document(Request $request)
    {
        // dd($request
        $people = persona::where('user_id', Auth::user()->id)->first();
        // $data = Entrada::with(['entity', 'person'])->get();
        // $data = DB::table('entradas as e')
        //     // ->leftJoin('entities as en', 'e.entity_id', 'en.id')
        //     ->leftJoin('derivations as d', 'e.id', 'd.parent_id')
        //     ->select('e.fecha_registro', 'e.cite', 'e.remitente', 'e.referencia')
        //     ->where('e.deleted_at', null)
        //     // ->where('d.deleted_at', null)
        //     ->where('e.people_id_de', $people->people_id)
        //     // ->where('d.via', 0)
        //     // ->where('e.tipo', 'I')
        //     // ->where('e.fecha_registro', '>=', $request->start)
        //     // ->where('e.fecha_registro', '<=', $request->finish)
        //     ->groupBy('e.id')
        //     ->get();



        $data = DB::table('entradas as e')
            ->leftJoin('entities as en', 'e.entity_id', 'en.id')
            ->leftJoin('derivations as d', function ($join) {
                $join->on('d.id', '=', DB::raw('(SELECT derivations.entrada_id FROM derivations WHERE derivations.entrada_id = e.id and derivations.via = 0 and derivations.deleted_at is null LIMIT 1)'));
                })
            ->select('e.created_at', 'e.cite', 'en.nombre as origen', 'e.remitente', 'e.referencia', 'd.funcionario_nombre_para', 'd.funcionario_cargo_para')
            ->where('e.deleted_at', null)
            // ->where('e.people_id_de', $people->people_id)
            ->where('e.tipo', 'E')
            ->where('e.created_at', '>=', $request->start)
            ->where('e.created_at', '<=', $request->finish)
            ->groupBy('e.id')
            ->get();











        // dd($data);
        // return view('report.printf.printf_list-document', compact('data'));
        
        if($request->print){
            return view('report.printf.printf_list_document', compact('data'));
        }else
        {            
            return view('report.printf.report_list_document', compact('data'));
        }
    }





    public function view_report_list()
    {
        $categoria = Category::where('deleted_at', null)
                    ->get();
        $entidad = Entity::where('deleted_at', null)->get();

                    // return $categoria;
        return view('report.view.view_report_list', compact('categoria', 'entidad'));
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

        $cat='=';
        if($request->category_id == 0)
        {
            $cat='!=';
        }


        $ori='=';
        

        if($request->origen == 0)
        {
            $ori='!=';
            $name ='GENERAL';
        }
        else
        {
            $name=Entity::find($request->origen)->nombre;
        }
        // dd($cat);
        
        $data = DB::table('entradas as e')
            ->join('entities as t', 't.id', 'e.entity_id')
            ->select('e.id', 'e.cite', 't.nombre as entidad', 'e.fecha_registro', 'e.remitente', 'e.referencia')
            // ->where('e.registrado_por_id_direccion', $funcionariodea->DA)
            ->whereRaw($query_filtro)
            ->where('e.category_id',$cat, $request->category_id)
            ->where('e.entity_id',$ori, $request->origen)
            ->where('e.fecha_registro', '>=', $request->start)
            ->where('e.fecha_registro', '<=', $request->finish)
            // ->where('e.id', 8539)
            ->where('e.deleted_at', null)
            ->orderBy('e.id','desc')
            ->get();

        // dd($data);

        // dd($data);


        // select id, cite, fecha_registro, remitente, referencia from entradas where id = 415

        
        // return $funcionariodea;
        // dd($funcionario);

        // return view('report.printf.report_list', compact('data'));


        if($request->print){
            return view('report.printf.report_list_printf', compact('data', 'name'));

        }else{
            return view('report.printf.report_list', compact('data'));

        }
    }




}
