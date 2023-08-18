<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Embargo;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmbargoImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmbargoController extends Controller
{
    public function index(){
        return view('embargo.browse');
    }

    public function list(){
        $search = request('search') ?? NULL;
        $paginate = request('paginate') ?? 10;
        $embargo = Embargo::where('deleted_at', null)
                    ->where(function($query) use ($search){
                        if($search){
                            // $query->OrwhereHas('city', function($query) use($search){
                            //     $query->whereRaw("name like '%$search%'");
                            // })
                            $query->OrWhereRaw("id = '$search'")
                            ->OrWhereRaw("nro like '%$search%'")
                            ->OrWhereRaw("nroPiet like '%$search%'")
                            ->OrWhereRaw("rutNit like '%$search%'")
                            ->OrWhereRaw("ci like '%$search%'")
                            ->OrWhereRaw("nombre like '%$search%'")
                            ->OrWhereRaw("notaEmbargo like '%$search%'");
                        }
                    })
                    ->orderBy('id', 'DESC')->paginate($paginate);
        return view('embargo.list', compact('embargo'));
    }

    
    public function importExcel(Request $request)
    {
        $nro = Embargo::max('nroImportacion');
        if($nro == null){
            $nro = 1;
        }else{
            $nro++;
        }
        $file = $request->file('file');
        Excel::import(new EmbargoImport, $file);
        return back()->with('message', 'Importacion completada..');
    }

    public function inhabilitar(Request $request)
    {
        DB::beginTransaction();
        try {
            Embargo::where('id', $request->id)->update(['status'=>0]);
            DB::commit();
            return redirect()->route('voyager.embargos.index')->with(['message' => 'Inhabilitado exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('voyager.embargos.index')->with(['message'=>'Ocurrió un error', 'alert-type' => 'error']);
        }
        
    }

    public function eliminar()
    {
        DB::beginTransaction();
        try {
            Embargo::where('deleted_at', null)->update(['deleted_at'=>Carbon::now()]);
            DB::commit();
            return redirect()->route('voyager.embargos.index')->with(['message' => 'Eliminado todo los registro exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('voyager.embargos.index')->with(['message'=>'Ocurrió un error', 'alert-type' => 'error']);
        }
        
    }
    public function habilitar(Request $request)
    {
        DB::beginTransaction();
        try {
            Embargo::where('id', $request->id)->update(['status'=>1]);
            DB::commit();
            return redirect()->route('voyager.embargos.index')->with(['message' => 'Habilitado exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('voyager.embargos.index')->with(['message'=>'Ocurrió un error', 'alert-type' => 'error']);
        }
        
    }
}
