<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdditionalJob;
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

        $data = AdditionalJob::with(['person'])->where('status',1)->get();


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
            return redirect()->route('additional_jobs.index')->with(['message' => 'Cargo Registrado Exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('additional_jobs.index')->with(['message' => 'Error.', 'alert-type' => 'error']);
        }
    }
}
