<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enlace;
use App\Models\EnlaceFile;
use App\Http\Controllers\StorageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


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
                $storage = new StorageController();
                for ($i = 0; $i < count($file); $i++) {
                    EnlaceFile::create([
                        'nombre_origen'   => $file[$i]->getClientOriginalName(),
                        'enlace_id'       => $request->enlace_id,
                        'ruta'            => $storage->file($file[$i], 'entradas'),
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
