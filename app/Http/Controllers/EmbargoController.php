<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Embargo;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmbargoImport;
use Illuminate\Support\Facades\DB;

class EmbargoController extends Controller
{
    public function index()
    {
        $embargo = Embargo::where('deleted_at', null)->get();
        return view('embargo.browse', compact('embargo'));
    }

    public function importExcel(Request $request)
    {
        $nro = Embargo::max('nroImportacion');
        if($nro == null)
        {
            $nro = 1;
        }
        else
        {
            $nro++;
        }

        $file = $request->file('file');
        Excel::import(new EmbargoImport, $file);
        // return 1;
        return back()->with('message', 'Importacion completada..');
    }

    public function inhabilitar(Request $request)
    {
        DB::beginTransaction();
        try {
            Embargo::where('id', $request->id)->update(['status'=>0]);
            DB::commit();
            return redirect()->route('voyager.embargos.index')->with(['message' => 'Inhabilitado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('voyager.embargos.index')->with(['message'=>'Ocurrio un error.', 'alert-type' => 'error']);
        }
        
    }
    public function habilitar(Request $request)
    {
        DB::beginTransaction();
        try {
            Embargo::where('id', $request->id)->update(['status'=>1]);
            DB::commit();
            return redirect()->route('voyager.embargos.index')->with(['message' => 'Habilitado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('voyager.embargos.index')->with(['message'=>'Ocurrio un error.', 'alert-type' => 'error']);
        }
        
    }
    // public function delete()
    // {
    //     DB::delete('DELETE FROM embargos');
    //     return back()->with('message', 'Importacion completada..');
    // }


    
}
