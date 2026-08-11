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

        // La consulta vive en el modelo porque el aviso de inicio de sesion
        // (partials.modal-aviso-seguridad) necesita los mismos numeros.
        $stats = Derivation::resumenPara($funcionarioId);

        return Voyager::view('voyager::index', compact('stats'));
    }

    /**
     * Marca como visto el aviso de tramites pendientes del inicio de sesion.
     *
     * El flag no se puede fijar al incluir el modal en la vista: si el usuario
     * navega antes de que llegue a mostrarse -por ejemplo cuando desde el modal
     * de cambio de contrasena elige "Cambiar ahora"- el aviso quedaria consumido
     * sin haberse visto nunca. Por eso lo marca el propio partial: al abrirse el
     * modal, o de inmediato cuando no hay pendientes y no hay nada que mostrar.
     */
    public function marcarAvisoPendientesVisto(Request $request)
    {
        $request->session()->put('aviso_seguridad_shown', true);

        return response()->noContent();
    }
}
