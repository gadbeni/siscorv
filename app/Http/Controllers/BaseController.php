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

        $stats = Derivation::join('entradas', 'derivations.entrada_id', '=', 'entradas.id')
            ->where('derivations.people_id_para', $funcionarioId) // Especificamos la tabla aquí
            ->whereNotIn('entradas.estado_id', [4, 6])
            ->whereNull('derivations.deleted_at') // Importante para no contar datos borrados
            ->selectRaw("
                    COUNT(*) as total,
                    COUNT(CASE WHEN derivations.visto IS NULL AND derivations.ok = 'NO' THEN 1 END) as pendientes,
                    COUNT(CASE WHEN derivations.visto IS NULL AND derivations.ok = 'NO' AND entradas.urgent = 1 THEN 1 END) as urgentes
            ")
            ->first();

        return Voyager::view('voyager::index', compact('stats'));
    }
}
