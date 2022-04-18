<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\PeopleExt;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class PeopleExtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // $people = DB::connection('mamore')->table('people as p')
        //                         ->join('contracts as c', 'c.person_id', 'p.id')
        //                         ->where('c.status','firmado')
        //                         ->where('c.deleted_at', null)
        //                         ->where('p.deleted_at', null)
        //                         ->select([
        //                             'p.id',
        //                             DB::raw("CONCAT(p.first_name, ' ', p.last_name) as text"),
        //                             'p.first_name', 'last_name',
        //                             'p.ci',
        //                         ])
        //                         // ->whereRaw('(p.ci like "%' .$search . '%" or '.DB::raw("CONCAT(p.first_name, ' ', p.last_name)").' like "%' .$search . '%")')
        //                         ->groupBy('text')
        //                         ->limit(10)
        //                         ->get();
    
        // $data = DB::table('siscorv2.people_exts as s')
        //     ->join('sysadmin.people as m', 'm.id', '=', 's.person_id')
        //     ->select(
        //         'm.id',
        //         DB::raw("CONCAT(m.first_name, ' ', m.last_name) as text"),
        //         'm.first_name', 'm.last_name',
        //         'm.ci',
        //     )
        //     // ->whereRaw('(s.cargo like "%sisstema%")')    
        //     // ->groupBy('text')
        //     ->get();


        // // return count($people);

        // $i=count($people);
        // $j=0;
        
        // array_push($people[11]->id =$data[0]->id);
        // // while($i < count($people)+count($data)-1)
        // // {
        //     // return $data[$j]->text;
        //     // $people->id =$data[0]->id;
        //     // $people->text =$data[0]->text;
        //     // $people->first_name =$data[0]->first_name;
        //     // $people->last_name =$data[0]->last_name;
        //     // $people->ci =$data[0]->ci;
        //     // $i++;
        //     // $j++;
        // // }

        // return $people;
        
        // // $data=$data.''.$people;
        // return $data;


        // dd(\App\Models\PeopleExt::with('person')->get());
        $data = PeopleExt::with(['person'])->where('status',1)->get();


        $people = DB::connection('mamore')->table('people')
            ->where('deleted_at', null)
            ->select('*')
            ->get();
        $direcciones = DB::connection('mamore')->table('direcciones')
            ->where('deleted_at', null)
            ->select('*') 
            ->get();
        
        $unidades = DB::connection('mamore')->table('unidades')
            ->where('deleted_at', null)
            ->select('*')
            ->get();

        // $data = PeopleExt::where('status',1)->where('deleted_at', null)->get();

        // foreach($data as $item)
        // {
        //     $aux = DB::connection('mamore')->table('people')->where('id',$item->person_id)->first();
        //     if($aux){
        //         $item->full_name= $aux->first_name.' '.$aux->last_name;
        //         $item->ci=$aux->ci;
        //     }
            
        // }

        // return $data;

        return view('peopleext.browse', compact('people','data', 'direcciones', 'unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {

            $request->merge(['status'=>1]);
            PeopleExt::create($request->all());
            DB::commit();
            return redirect()->route('people_exts.index')->with(['message' => 'Correspondecia derivada exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('people_exts.index')->with(['message' => 'Error.', 'alert-type' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeopleExt  $peopleExt
     * @return \Illuminate\Http\Response
     */
    public function show(PeopleExt $peopleExt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeopleExt  $peopleExt
     * @return \Illuminate\Http\Response
     */
    public function edit(PeopleExt $peopleExt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PeopleExt  $peopleExt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeopleExt $peopleExt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeopleExt  $peopleExt
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeopleExt $peopleExt)
    {
        //
    }
}
