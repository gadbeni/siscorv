<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArchivoDate;
use App\Models\Entrada;
use App\Http\Controllers\StorageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function UpdateDateEntrada(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $entrada = Entrada::where('id', $id)->first();

            $file = $request->file('file');
            if ($file) {
                $storage = new StorageController();
                ArchivoDate::create([
                    'entrada_id'      => $entrada->id,
                    'dateActual'      => $request->date,
                    'dateHistoria'    => $entrada->created_at,
                    'file'            => $storage->file($file, 'cambiofechadocumento'),
                    'observation'     => $request->observation,
                    'registerUser_id' => Auth::user()->id,
                    'nci'             => 1
                ]);
            }
            $entrada->update(['created_at'=>$request->date]);
            DB::commit();
            return redirect()->route('entradas.index')->with(['message' => 'Cambio de fecha con exito', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return 0;
            return redirect()->route('entradas.index')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }
}
