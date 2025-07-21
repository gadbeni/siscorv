<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Derivation;
use App\Models\Entrada;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

class BaseController extends Controller
{
    //
    public function admin()
    {
        $funcionarioId = Persona::where('user_id', Auth::user()->id)->value('people_id');

        if (is_null($funcionarioId)) {
            $stats = (object) [
                'total' => 0,
                'pendientes' => 0,
                'urgentes' => 0,
            ];
            return Voyager::view('voyager::index', compact('stats'));
        }
        $baseQuery = Derivation::where('people_id_para', $funcionarioId)
            ->whereHas('entrada', function ($q) {
                $q->whereNotIn('estado_id', [4, 6]);
            });

        $totalDerivaciones = (clone $baseQuery)->count();

        $pendientes = (clone $baseQuery)->where('visto', NULL)
            ->where('ok', 'NO')
            ->count();

        $urgentes = (clone $baseQuery)
            ->where('visto', NULL)
            ->where('ok', 'NO')
            ->whereHas('entrada', function ($q) {
                $q->where('urgent', 1);
            })
            ->count();

        // $derivaciones->where('visto', NULL)->where('ok', 'NO')->where('entrada.urgent', 1)->count();
        $stats = (object) [
            'total' => $totalDerivaciones,
            'pendientes' =>  $pendientes,
            'urgentes' => $urgentes
        ];
        return Voyager::view('voyager::index', compact('stats'));
    }
}
