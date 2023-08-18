<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enlace;
use App\Models\EnlaceFile;
use Illuminate\Support\Str;
use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\Storage;


class EnlaceController extends Controller
{
    public function indexFile($enlace)
    {
        $enlace_id=$enlace;
        $enlace = EnlaceFile::where('enlace_id', $enlace)->where('status',1)->where('deleted_at')->get();
        return view('enlace.file', compact('enlace', 'enlace_id'));
    }
    public function storeFile(Request $request)
    {
        DB::beginTransaction();
        try {
            $file = $request->file('archivos');
            if ($file) {
                for ($i=0; $i < count($file); $i++) { 
                    $nombre_origen = $file[$i]->getClientOriginalName();
                    $newFileName = Str::random(20).'.'.$file[$i]->getClientOriginalExtension();
                    $dir = "entradas/".date('F').date('Y');
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file[$i]));
                    EnlaceFile::create([
                        'nombre_origen' => $nombre_origen,
                        'enlace_id' => $request->enlace_id,
                        'ruta' => $dir.'/'.$newFileName,
                        'registerUser_id' => Auth::user()->id
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('enlaces-file.index', ['enlace' => $request->enlace_id])->with(['message' => 'Registro guardado exitosamente', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return 0;
            return redirect()->route('enlaces-file.index', ['enlace' => $request->enlace_id])->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }
    public function destroyFile(Request $request)
    {
        DB::beginTransaction();
        try {
            EnlaceFile::where('id', $request->id)->update(['deleted_at'=>Carbon::now(), 'deleteUser_id'=>Auth::user()->id]);
            DB::commit();
            return redirect()->route('enlaces-file.index', ['enlace' => $request->enlace_id])->with(['message' => 'Registro eliminado exitosamente', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('enlaces-file.index', ['enlace' => $request->enlace_id])->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }


}
