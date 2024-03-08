<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\MensajeEnviado;

class MensajesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function showMensajes(Entrada $entrada)
    {
        $mensajes = MensajeEnviado::where('entrada_id', $entrada->id)->get();

        return view('entradas.mensajes', ['entrada'=> $entrada,'mensajes' => $mensajes]);
    }
}
