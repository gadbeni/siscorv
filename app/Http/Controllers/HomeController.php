<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Entrada;
use App\Models\RequestsClient;
use App\Models\Derivation;
use Carbon\Carbon;
use App\Models\OldData;
use Illuminate\Support\Facades\DB;

// Models count
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        /* Capturar datos de la petición del cliente */
        try {
            RequestsClient::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $_SERVER['HTTP_USER_AGENT']
            ]);
        } catch (\Throwable $th) {
        }

        // Contadores cache
        $count = cache()->remember('dashboard_counts', 600, function () {
            return [
                'visitas' => RequestsClient::count(),
                'usuarios' => User::count(),
                'tramites' => Entrada::count(), // Laravel ya filtra deleted_at solo
                'tramites_pendientes' => Entrada::where('estado_id', 6)->count(),
            ];
        });


        return view('welcome', compact('count'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $query = Entrada::with(['entity', 'estado', 'archivos', 'derivaciones'])
            ->where('deleted_at', NULL);

        if (strpos($search, '-') !== false) {
            $parts = explode('-', $search);
            if (count($parts) == 3) {
                $query->where('tipo', $parts[0])
                    ->where('gestion', $parts[1])
                    ->where('id', $parts[2]);
            } else {
                $query->where('cite', $search);
            }
        } else {
            $query->where('cite', $search);
        }

        $data = $query->first();
        return view('search', compact('data'));
    }

    public function searchtramite(Request $request)
    {
        // dd(request('search'));
        $data = Entrada::with(['entity', 'estado', 'derivaciones'])
            ->where('cite', request('search'))
            ->where('deleted_at', NULL)
            ->first();
        $results = Derivation::select([
            'id',
            'funcionario_nombre_para as name',
            'funcionario_direccion_para as title',
            'parent_id as pid'
        ])
            ->where('entrada_id', $data->id)
            ->whereNotnull('parent_id')
            ->get();

        return response()->json([
            "entrada" => $data,
            "derivaciones" => $results
        ]);
    }

    public function documents_expired()
    {
        $now = Carbon::now()->format('Y-m-d');
        $old = Carbon::now()->addDays(3)->format('Y-m-d');
        $data = Entrada::with(['entity'])
            ->select('id', 'cite', 'tipo', 'gestion', 'remitente', 'deadline', 'created_at', 'entity_id')
            ->whereBetween('deadline', [$now, $old])
            ->get();
        return view('entradas.documents_to_expired', compact('data'));
    }
}
