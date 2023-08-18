<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdditionalJob;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdditionalJobController extends Controller
{
    public function index()
    {

        $people = DB::connection('mamore')->table('people')
            ->where('deleted_at', null)
            ->select('*')
            ->get();
            // return $people;

        $data = AdditionalJob::with(['person'])->where('deleted_at', null)->get();


        return view('additionaljob.browse', compact('people', 'data'));
    }

    public function store(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {

            $request->merge(['status'=>1]);
            AdditionalJob::create($request->all());
            DB::commit();
            return redirect()->route('additional_jobs.index')->with(['message' => 'Cargo Registrado Exitosamente', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('additional_jobs.index')->with(['message' => 'Error', 'alert-type' => 'error']);
        }
    }

    public function baja(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $job = AdditionalJob::find($request->id);
            $job->update(['status'=>0]);
            DB::commit();
            return redirect()->route('additional_jobs.index')->with(['message' => 'Cargo dado de baja exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('additional_jobs.index')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $job = AdditionalJob::find($request->id);
            $job->update(['deleted_at' => Carbon::now()]);
            DB::commit();
            return redirect()->route('additional_jobs.index')->with(['message' => 'Cargo eliminado exitosamente', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('additional_jobs.index')->with(['message' => 'Ocurrió un error', 'alert-type' => 'error']);
        }
    }
}
