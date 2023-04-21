<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArchivoDate;
use App\Models\Entrada;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{

    public function file($file, $direc)
    {
        $nombre_origen = $file->getClientOriginalName();
        $newFileName = Str::random(20).'.'.$file->getClientOriginalExtension();
        $dir = $direc."/".date('F').date('Y');
        Storage::makeDirectory($dir);
        Storage::disk('sidepej')->put($dir.'/'.$newFileName, file_get_contents($file));
        return $dir.'/'.$newFileName;
    }

    public function UpdateDateEntrada(Request $request, $id)
    {
        // return $request;
        DB::beginTransaction();
        try {

            $entrada = Entrada::where('id', $id)->first();

            $file = $request->file('file');
            if ($file) {
                    $nombre_origen = $file->getClientOriginalName();
                    $newFileName = Str::random(20).'.'.$file->getClientOriginalExtension();
                    $dir = "cambiofechadocumento/".date('F').date('Y');
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));
                    ArchivoDate::create([
                        'entrada_id' => $entrada->id,
                        'dateActual' => $request->date,
                        'dateHistoria' => $entrada->created_at,
                        'file' => $dir.'/'.$newFileName,
                        'observation'=>$request->observation,
                        'registerUser_id' => Auth::user()->id,
                        'nci'=>1
                    ]);
                
            }
            $entrada->update(['created_at'=>$request->date]);
            DB::commit();
            return redirect()->route('entradas.index')->with(['message' => 'Cambio de fecha con exito..', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return 0;
            return redirect()->route('entradas.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }
}
