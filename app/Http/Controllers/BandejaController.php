<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

// Models
use App\Models\Entrada;
use App\Models\Persona;
use App\Models\Derivation;

class BandejaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (env('APP_MAINTENANCE') && !auth()->user()->hasRole('admin')) {
            Auth::logout();
            return redirect()->route('maintenance');
        }

        $funcionario = Persona::where('user_id', Auth::user()->id)->first();
        $funcionario_id = null;

        if ($funcionario) {
            $funcionario_id = $funcionario->people_id;
            if (!$funcionario_id) {
                return redirect('admin')->with(['message' => 'Falta tu código de funcionario contáctate con la Unidad de Sistemas para solucionarlo por favor', 'alert-type' => 'error']);
            }
        }
        // Mismos contadores que el tablero y el aviso de inicio de sesion.
        $resumen = Derivation::resumenPara($funcionario_id);
        return view('bandeja.browse', compact('funcionario_id', 'resumen'));
    }

    public function list($funcionario_id, $type)
    {
        $paginate = request('paginate') ?? 10;
        $search = request('search') ?? null;
        switch ($type) {
            case 'pendientes':
                $derivaciones = Derivation::whereHas('entrada', function ($q) {
                    $q->where('personeria', 0)->where('urgent', 0)->whereNotIn('estado_id', [4, 6]);
                })->where('transferred', 0)->where('people_id_para', $funcionario_id)
                    ->sinVias()
                    ->where('ok', 'NO')
                    ->where(function ($query) use ($search) {
                        if ($search) {
                            $query->OrwhereHas('entrada', function ($query) use ($search) {
                                $query->whereRaw("(hr like '%$search%' or cite like '%$search%' or remitente like '%$search%' or referencia like '%$search%')");
                            })
                                ->OrWhereRaw("id = '$search'");
                        }
                    })
                    ->orderBy('id', 'DESC')->paginate($paginate);
                return view('bandeja.pendientes', compact('derivaciones'));
                break;
            case 'derivados':
                $derivaciones = Derivation::whereHas('entrada', function ($q) {
                    $q->where('personeria', 0)->whereNotIn('estado_id', [4, 6]);
                })->where('transferred', 0)->where('people_id_para', $funcionario_id)
                    ->sinVias()
                    ->where('ok', 'SI')
                    ->where(function ($query) use ($search) {
                        if ($search) {
                            $query->OrwhereHas('entrada', function ($query) use ($search) {
                                $query->whereRaw("(hr like '%$search%' or cite like '%$search%' or remitente like '%$search%' or referencia like '%$search%')");
                            })
                                ->OrWhereRaw("id = '$search'");
                        }
                    })
                    ->orderBy('id', 'DESC')->paginate($paginate);
                return view('bandeja.pendientes', compact('derivaciones'));
                break;
            case 'urgentes':
                $derivaciones = Derivation::whereHas('entrada', function ($q) {
                    $q->where('personeria', 0)->where('urgent', 1)->whereNotIn('estado_id', [4, 6]);
                })->where('transferred', 0)->where('people_id_para', $funcionario_id)
                    ->sinVias()
                    ->where('ok', 'NO')
                    ->where(function ($query) use ($search) {
                        if ($search) {
                            $query->OrwhereHas('entrada', function ($query) use ($search) {
                                $query->whereRaw("(hr like '%$search%' or cite like '%$search%' or remitente like '%$search%' or referencia like '%$search%')");
                            })
                                ->OrWhereRaw("id = '$search'");
                        }
                    })
                    ->orderBy('id', 'DESC')->paginate($paginate);
                return view('bandeja.urgentes', compact('derivaciones'));
                break;
            case 'vias':
                // Tramites que pasan por el funcionario camino a su destinatario.
                // Los archivados van a su propia pestana.
                $derivaciones = Derivation::with('entrada')
                    ->whereHas('entrada', function ($q) {
                        $q->where('personeria', 0)->whereNotIn('estado_id', [4, 6]);
                    })->where('transferred', 0)->where('people_id_para', $funcionario_id)
                    ->soloVias()
                    ->whereIn('ok', ['NO', 'SI'])
                    ->when($search, function ($query) use ($search) {
                        $like = '%' . $search . '%';
                        $query->where(function ($query) use ($search, $like) {
                            $query->whereHas('entrada', function ($q) use ($like) {
                                $q->where(function ($q) use ($like) {
                                    $q->where('hr', 'like', $like)->orWhere('cite', 'like', $like)
                                        ->orWhere('remitente', 'like', $like)->orWhere('referencia', 'like', $like);
                                });
                            })->orWhere('id', $search);
                        });
                    })
                    ->orderBy('id', 'DESC')->paginate($paginate);
                return view('bandeja.vias', compact('derivaciones'));
                break;
            case 'archivados':
                $derivaciones = Derivation::where('transferred', 0)->where('people_id_para', $funcionario_id)
                    ->where('ok', 'ARCHIVADO')
                    ->where(function ($query) use ($search) {
                        if ($search) {
                            $query->OrwhereHas('entrada', function ($query) use ($search) {
                                $query->whereRaw("(hr like '%$search%' or cite like '%$search%' or remitente like '%$search%' or referencia like '%$search%')");
                            })
                                ->OrWhereRaw("id = '$search'");
                        }
                    })
                    ->orderBy('id', 'DESC')->paginate($paginate);
                return view('bandeja.archivados', compact('derivaciones'));
                break;
        }
    }

    public function show($id)
    {

        try {
            $derivacion =  Derivation::where('id', $id)->first();
            $derivacion->visto = Carbon::now();
            $derivacion->save();
            $data = Entrada::with(['entity', 'estado', 'archivos.user', 'derivaciones' => function ($q) {
                $q->where('deleted_at', null);
            }])
                ->where('id', $derivacion->entrada_id)
                ->where('deleted_at', NULL)
                ->first();
            $ok = date("d-m-Y", strtotime($data->created_at));

            $origen = '';
            $destino = NULL;
            if ($data->tipo == 'I') {
                // El origen sale de la direccion/unidad que registro la nota: en las
                // internas es la del remitente, y es la unica poblada al 100%.
                $direccion = $this->getIdDireccionInfo($data->registrado_por_id_direccion);
                $unidad = $this->getIdUnidadInfo($data->registrado_por_id_unidad);
                if ($direccion) {
                    $origen = $direccion->nombre;
                }
                if ($unidad) {
                    $origen = $unidad->nombre;
                }
            }
            return view('bandeja.read', compact('data', 'origen', 'derivacion', 'ok'));
        } catch (\Throwable $th) {
            return redirect()->route('voyager.dashboard');
        }
    }

    public function archivar(Request $request)
    {
        try {
            /* Cambiar el estado de la entrada a finalizada */
            Derivation::where('id', $request->derivacion_id)->update(['ok' => 'ARCHIVADO', 'observationArchivado' => $request->observacion]);
            return redirect()->route('bandeja.index')->with(['message' => 'Correspondencia archivada exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->route('bandeja.index')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }

    public function rechazar($id, Request $request)
    {
        DB::beginTransaction();
        try {

            $persona = Persona::where('user_id', Auth::user()->id)->first();

            $derivacion = Derivation::where('id', $request->derivacion_id)->first();

            if ($derivacion->people_id_de) {
                $funcionario = $this->getPeople($derivacion->people_id_de);
                if ($funcionario == 'Error') {
                    return redirect()->route('bandeja.index')->with(['message' => 'El funcionario no se encuentra disponible... Contactese con el administrador', 'alert-type' => 'error']);
                }

                Derivation::create([
                    'entrada_id' => $id,
                    'people_id_de' => $derivacion->people_id_para,
                    'people_id_para' => $funcionario->id_funcionario,
                    'funcionario_nombre_para' => $funcionario->nombre,
                    'funcionario_cargo_para' => $funcionario->cargo,
                    'funcionario_direccion_id_para' => $funcionario->id_direccion ?? null,
                    'funcionario_direccion_para' => $funcionario->direccion ?? null,
                    'funcionario_unidad_id_para' => $funcionario->id_unidad ?? null,
                    'funcionario_unidad_para' => $funcionario->unidad ?? null,
                    'responsable_actual' => 1,
                    'rechazo' => 1,
                    'via'   => 0,
                    'user_id' => Auth::user()->id,
                    'registro_por' => Auth::user()->email,
                    'observacion' => $request->observacion,
                    'parent_id' => $request->derivacion_id,
                    'parent_type' => 'App\Models\Derivation'
                ]);
            } else {
                $entrada = Entrada::where('id', $id)->where('deleted_at', null)->first();
                $funcionario = $this->getPeople($entrada->people_id_de);
                if ($funcionario == 'Error') {
                    return redirect()->route('bandeja.index')->with(['message' => 'El funcionario no se encuentra disponible, contáctese con el administrador de SISCOR', 'alert-type' => 'error']);
                }
                Derivation::create([
                    'entrada_id' => $id,
                    'people_id_de' => $entrada->people_id_para,
                    'people_id_para' => $funcionario->id_funcionario,
                    'funcionario_nombre_para' => $funcionario->nombre,
                    'funcionario_cargo_para' => $funcionario->cargo,
                    'funcionario_direccion_id_para' => $funcionario->id_direccion ?? null,
                    'funcionario_direccion_para' => $funcionario->direccion ?? null,
                    'funcionario_unidad_id_para' => $funcionario->id_unidad ?? null,
                    'funcionario_unidad_para' => $funcionario->unidad ?? null,
                    'responsable_actual' => 1,
                    'rechazo' => 1,
                    'via'   => 0,
                    'user_id' => Auth::user()->id,
                    'registro_por' => Auth::user()->email,
                    'observacion' => $request->observacion,
                    'parent_id' => $request->derivacion_id,
                    'parent_type' => 'App\Models\Derivation'
                ]);
            }
            Derivation::where('id', $request->derivacion_id)->update(['derivation' => 1, 'ok' => 'RECHAZADO']);

            // Enviar notificación de Whastapp
            if (setting('servidores.whatsapp') && $derivacion->user) {
                if ($derivacion->user->phone) {
                    $phone = strlen($derivacion->user->phone) == 8 ? '591' . $derivacion->user->phone : $derivacion->user->phone;
                    Http::post(setting('servidores.whatsapp') . '/send', [
                        'phone' => $phone,
                        'text' => $request->observacion
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('bandeja.index')->with(['message' => 'Correspondecia rehazada exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th);
            return redirect()->route('voyager.dashboard')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }

    public function deleteDerivacion(Request $request)
    {
        // return $request;

        DB::beginTransaction();
        try {
            $ok = Derivation::where('deleted_at', null)->where('visto', null)->where('entrada_id', $request->entrada_id)->where('id', $request->id)->first();
            $ok->update(['deleted_at' => Carbon::now()]);
            $data = Derivation::where('deleted_at', null)->where('entrada_id', $request->entrada_id)->where('parent_id', $ok->parent_id)->get();
            if (count($data) == 0) {
                Derivation::where('deleted_at', null)->where('id', $ok->parent_id)->where('entrada_id', $request->entrada_id)->update(['derivation' => 0, 'ok' => 'NO']);
            }
            DB::commit();

            return redirect('admin/bandeja/' . $ok->parent_id)->with(['message' => 'Derivación anulada exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('admin/bandeja/' . $ok->parent_id)->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }
}
