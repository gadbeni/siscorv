<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use App\Models\Entrada;
use App\Models\Person;
use Dflydev\DotAccessData\Data;
use Dotenv\Parser\Entry;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;
use App\Models\Derivation;

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




        $data = DB::table('entradas as e')
            ->join('entities as en', 'e.entity_id', 'en.id')
            ->join('derivations as d', 'd.entrada_id', 'e.id')
            ->select('e.created_at', 'e.cite', 'en.nombre as origen', 'e.remitente', 'e.referencia', 'd.funcionario_nombre_para', 'd.funcionario_cargo_para')
            ->where('e.deleted_at', null)
            ->where('e.tipo', 'E')
            ->where('d.deleted_at', null)
            // ->whereDate('e.created_at', '>=', $request->start)
            // ->whereDate('e.created_at', '<=', $request->finish)

            ->whereDate('e.created_at', '>=', date('Y-m-d', strtotime($request->start)))
            ->whereDate('e.created_at', '<=', date('Y-m-d', strtotime($request->finish)))



            ->groupBy('e.cite')
            ->get();

            // $data = DB::table('entradas as e')
            // ->leftJoin('entities as en', 'e.entity_id', 'en.id')
            // ->leftJoin('derivations as d', 'd.entrada_id', 'e.id')
            // ->select('e.created_at', 'e.cite', 'en.nombre as origen', 'e.remitente', 'e.referencia')
            // ->where('e.deleted_at', null)
            // ->where('e.tipo', 'E')
            // ->where('e.entity_id', null)
            // ->whereDate('e.created_at', '>=', $request->start)
            // ->whereDate('e.created_at', '<=', $request->finish)
            // ->groupBy('e.cite')
            // ->get();
        // dd($data);


        // $data = DB::table('entradas as e')
        //     ->leftJoin('entities as en', 'e.entity_id', 'en.id')
        //     ->leftJoin('derivations as d', function ($join) {
        //         $join->on('d.id', '=', DB::raw('(SELECT derivations.entrada_id FROM derivations WHERE derivations.entrada_id = e.id and derivations.via = 0 and derivations.deleted_at is null LIMIT 1)'));
        //         })
        //     ->select('e.created_at', 'e.cite', 'en.nombre as origen', 'e.remitente', 'e.referencia', 'd.funcionario_nombre_para', 'd.funcionario_cargo_para')
        //     ->where('e.deleted_at', null)
        //     ->where('e.tipo', 'E')
        //     ->whereDate('e.created_at', '>=', $request->start)
        //     ->whereDate('e.created_at', '<=', $request->finish)
        //     ->groupBy('e.id')
        //     ->get();

        











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

        // dd($funcionario);
        // $funcionariodea =  DB::connection('mysqlgobe')
        //                         ->table('contribuyente as c')
        //                         ->leftJoin('unidadadminstrativa as ua', 'c.idDependencia', '=', 'ua.id')
        //                         ->leftJoin('direccionadministrativa as da', 'c.DA', '=', 'da.ID')
        //                         ->join('contratos as co', 'c.N_Carnet', 'co.idContribuyente')
        //                         ->where('c.Estado', '=', '1')->where('co.Estado', '1')
        //                         ->where('c.id', $funcionario->funcionario_id)
        //                         ->select('c.id', 'c.DA')
        //                         ->first();

        // dd($funcionariodea);

        //                         if (auth()->user()->hasRole('ventanilla') && auth()->user()->hasRole('funcionario')) {
        //                             $query_filtro = 'e.registrado_por_id_direccion = '.$funcionariodea->DA;
        //                         } elseif (auth()->user()->hasRole('ventanilla') && !auth()->user()->hasRole('funcionario')) {
        //                             // $query_filtro = 'e.tipo = "E" and e.registrado_por_id_direccion = '.$funcionariodea->DA;
        //                             $query_filtro = 'e.tipo = "E"';
        //                         } elseif (auth()->user()->isAdmin() || auth()->user()->id == 28) {
        //                             $query_filtro = 1;
        //                         }
        //                         elseif (!auth()->user()->hasRole('ventanilla') && auth()->user()->hasRole('funcionario')) {
        //                             $query_filtro = 'e.tipo = "I" and e.funcionario_id_remitente = '.$funcionario->funcionario_id;
        //                         } 
        // return $funcionariodea;
        // return $query_filtro;

        $query_filtro = 'e.tipo = "E"';

        // dump($query_filtro);


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
            // ->where('e.fecha_registro', '>=', $request->start)
            // ->where('e.fecha_registro', '<=', $request->finish)

            ->whereDate('e.fecha_registro', '>=', date('Y-m-d', strtotime($request->start)))
            ->whereDate('e.fecha_registro', '<=', date('Y-m-d', strtotime($request->finish)))
            // ->where('e.id', 8539)
            ->where('e.deleted_at', null)
            ->orderBy('e.id','desc')
            ->get();

        // dd($data);



        if($request->print){
            return view('report.printf.report_list_printf', compact('data', 'name'));
        }else{
            return view('report.printf.report_list', compact('data'));
        }
    }






    // Para los Ingresos 
    public function view_report_ingreso()
    {
        $people = Person::where('deleted_at', null)->get();
        return view('report.salida.report' , compact('people'));
    }
    
    public function printf_report_ingreso(Request $request)
    {

        // dump($request);
        $data = Entrada::with(['entity:id,nombre', 'estado:id,nombre'])
                        ->where('people_id_de',$request->people)
                        ->select([
                            'id','tipo','gestion','estado_id','cite', 'detalles', 'hr','remitente','referencia','entity_id','created_at', 'people_id_para'
                        ])
                        ->where('deleted_at', NULL)->orderBy('id', 'ASC')->get();
        // dump($data);
        
        $people = Person::where('id', $request->people)->first();
        if($request->print){
            $start = $request->start;
            $finish = $request->finish;
            return view('report.salida.print', compact('data', 'finish', 'start', 'people'));

        }else{
            return view('report.salida.list', compact('data'));

        }
    }


    // Para LA BANDEJA DE ENTRADA
    public function view_report_bandeja()
    {
        // $data = DB::table('dbo.Personas')->get();
        // dump($data);
        // $data = DB::select('select * from Personas');
        // return $data;

        $people = Person::where('deleted_at', null)->get();
        return view('report.bandeja.report' , compact('people'));
    }
    
    public function printf_report_bandeja(Request $request)
    {
        $data = Derivation::where('transferred', 0)->where('people_id_para', $request->people)
                                        ->whereHas('entrada', function($q){
                                            $q->whereNotIn('estado_id', [4, 6]);
                                        })
                                        ->whereDate('created_at', '>=', $request->start)
                                        ->whereDate('created_at', '<=', $request->finish)
                                        // ->where('ok', 'ARCHIVADO')
                                        ->orderBy('id', 'DESC')->get();
        $people = Person::where('id', $request->people)->first();
        if($request->print){
            $start = $request->start;
            $finish = $request->finish;
            return view('report.bandeja.print', compact('data', 'finish', 'start', 'people'));

        }else{
            return view('report.bandeja.list', compact('data'));

        }
    }
}
