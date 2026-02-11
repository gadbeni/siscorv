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
    public function rde_index()
    {
        $categoria = Category::where('deleted_at', null)->get();
        $entidad = Entity::where('deleted_at', null)->get();
        return view('report.rde.browse', compact('categoria', 'entidad'));
    }

    public function rde_list(Request $request)
    {
        $funcionario = Persona::where('user_id', Auth::user()->id)->first();
        $query_filtro = 'e.tipo = "E"';
        $start = $request->start ?? date('Y-m-d', strtotime('-30 days'));
        $finish = $request->finish ?? date('Y-m-d');
        $db_mamore = config('database.connections.mamore.database');
        $data = DB::table('entradas as e')
            ->leftJoin($db_mamore.'.people as p', 'p.id', 'e.people_id_para')
            ->leftJoin('entities as t', 't.id', 'e.entity_id')
            ->select('e.id', 'e.cite', 't.nombre as entidad', 'e.fecha_registro', 'e.remitente', 'e.referencia', 'p.first_name', 'p.last_name', 'e.job_para')
            ->whereRaw($query_filtro)
            ->whereRaw($request->category_id ? 'e.category_id = ' . $request->category_id : 1)
            ->whereRaw($request->category_id ? 'e.entity_id = ' . $request->origen : 1)
            ->whereDate('e.fecha_registro', '>=', date('Y-m-d', strtotime($start)))
            ->whereDate('e.fecha_registro', '<=', date('Y-m-d', strtotime($finish)))
            ->where('e.deleted_at', null)
            ->orderBy('e.id', 'ASC')
            ->get();

        if ($request->print) {
            return view('report.rde.print', compact('data'));
        } else {
            return view('report.rde.list', compact('data'));
        }
    }

    public function rde_documents_index()
    {
        return view('report.rde.browse-document');
    }

    public function rde_documents_list(Request $request)
    {
        $people = persona::where('user_id', Auth::user()->id)->first();
        $data = DB::table('entradas as e')
            ->join('entities as en', 'e.entity_id', 'en.id')
            ->join('derivations as d', 'd.entrada_id', 'e.id')
            ->select('e.created_at', 'e.cite', 'en.nombre as origen', 'e.remitente', 'e.referencia', 'd.funcionario_nombre_para', 'd.funcionario_cargo_para')
            ->where('e.deleted_at', null)
            ->where('e.tipo', 'E')
            ->where('d.deleted_at', null)
            ->whereDate('e.created_at', '>=', date('Y-m-d', strtotime($request->start)))
            ->whereDate('e.created_at', '<=', date('Y-m-d', strtotime($request->finish)))
            ->groupBy('e.cite')
            ->get();

        if ($request->print) {
            return view('report.rde.print-documents', compact('data'));
        } else {
            return view('report.rde.list-documents', compact('data'));
        }
    }

    public function view_report_ingreso()
    {
        $people = Person::where('deleted_at', null)->get();
        return view('report.salida.report', compact('people'));
    }

    public function printf_report_ingreso(Request $request)
    {
        $data = Entrada::with(['entity:id,nombre', 'estado:id,nombre'])
            ->where('people_id_de', $request->people)
            ->select([
                'id',
                'tipo',
                'gestion',
                'estado_id',
                'cite',
                'detalles',
                'hr',
                'remitente',
                'referencia',
                'entity_id',
                'created_at',
                'people_id_para'
            ])
            ->where('deleted_at', NULL)->orderBy('id', 'ASC')->get();

        $people = Person::where('id', $request->people)->first();
        if ($request->print) {
            $start = $request->start;
            $finish = $request->finish;
            return view('report.salida.print', compact('data', 'finish', 'start', 'people'));
        } else {
            return view('report.salida.list', compact('data'));
        }
    }

    public function view_report_bandeja()
    {
        $people = Person::where('deleted_at', null)->get();
        return view('report.bandeja.report', compact('people'));
    }

    public function printf_report_bandeja(Request $request)
    {
        $data = Derivation::with(['entrada' => function($q){
                $q->withTrashed()->with(['entity', 'estado']);
            }])
            ->where('transferred', 0)->where('people_id_para', $request->people)
            ->whereHas('entrada', function ($q) {
                $q->whereNotIn('estado_id', [4, 6]);
            })
            ->whereDate('created_at', '>=', $request->start)
            ->whereDate('created_at', '<=', $request->finish)
            ->orderBy('id', 'DESC')->get();
        $people = Person::where('id', $request->people)->first();
        if ($request->print) {
            $start = $request->start;
            $finish = $request->finish;
            return view('report.bandeja.print', compact('data', 'finish', 'start', 'people'));
        } else {
            return view('report.bandeja.list', compact('data'));
        }
    }
}
