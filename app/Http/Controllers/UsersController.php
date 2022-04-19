<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona;
use DB;

class UsersController extends Controller
{
    public function getFuncionariotocreate(Request $request){
        $search = $request->search;
        $type = $request->type;
            if($type==1)
            {
                $personas = DB::connection('mamore')->table('people as p')
                    ->join('contracts as c', 'c.person_id', 'p.id')
                    ->select('p.id', 'p.first_name as nombre', 'p.last_name as apellido', 'p.ci' , DB::raw("CONCAT(p.first_name, ' ', p.last_name) as nombre_completo"))
                    ->where('c.status', 'firmado')
                    ->where('p.deleted_at', null)
                    ->where('c.deleted_at', null)
                    // ->where('p.ci', 'like', '%' .$search . '%')
                    ->whereRaw('(p.ci like "%' .$search . '%" or '.DB::raw("CONCAT(p.first_name, ' ', p.last_name)"). 'like "%' . $search . '%")')
                    ->get();
                    $response = array();
                foreach($personas as $persona){

                    $response[] = array(
                        "id"=>$persona->id,
                        "text"=>$persona->nombre_completo,
                        "nombre" => $persona->nombre,
                        "apellido" => $persona->apellido,
                        // "ap_materno" => $persona->apellido,
                        "ci" => $persona->ci,
                        // "alfanum" => $persona->alfanu,
                        // "departamento_id" => $persona->Expedido
                    );
                }
            }
            else
            {
                $personas = DB::table('siscorv2.people_exts as s')
                ->join('sysadmin.people as m', 'm.id', '=', 's.person_id')
                ->select(
                    'm.id',
                    DB::raw("CONCAT(m.first_name, ' ', m.last_name) as text"),
                    'm.first_name as nombre', 'm.last_name as apellido',
                    'm.ci',
                )
                ->whereRaw('(m.ci like "%' .$search . '%" or '.DB::raw("CONCAT(m.first_name, ' ', m.last_name)").' like "%' .$search . '%")')
                // ->groupBy('text')
                ->get();

                $response = array();
                foreach($personas as $persona){

                    $response[] = array(
                        "id"=>$persona->id,
                        "text"=>$persona->text,
                        "nombre" => $persona->nombre,
                        "apellido" => $persona->apellido,
                        // "ap_materno" => $persona->apellido,
                        "ci" => $persona->ci,
                        // "alfanum" => $persona->alfanu,
                        // "departamento_id" => $persona->Expedido
                    );
                }
            }  
        return response()->json($response);
    }

    // public function create_user(Request $request){
        
    //     $rules = [
    //         'nombre' => 'required|max:100',
    //         'ap_paterno' => 'required|max:75',
    //         'ap_materno' => 'required|max:75',
    //         'ci' => 'required',
    //         'email' => 'required|max:255|unique:users',
    //         'password' => 'required|min:6',
    //     ];
    //     $messages = [
    //         'nombre.required' => 'El campo Nombre es obligatorio.',
    //         'ap_paterno.required' => 'El campo Apellido paterno es obligatorio.',
    //         'ap_materno.required' => 'El campo Apellido materno es obligatorio.',
    //         'ci.required' => 'El campo Carnet de indentidad es obligatorio.',
    //         'email.required' => 'El campo Usuario es obligatorio.',
    //         'email.unique' => 'El Usuario ya existe.',
    //         'password.required' => 'El campo Contraseña es obligatorio.',
    //     ];

    //     $input = $request->all();
    //     $input['estado'] = 'ACTIVO';

    //     $input['name'] = $input['nombre'];
    //     $input['registrado_por'] = $request->user()->email;

    //     DB::beginTransaction();
    //     try {
            
    //         $user = User::create([
    //             'name' =>  $input['nombre'].' '.$input['ap_paterno'],
    //             'role_id' => $request->role_id,
    //             'email' => $request->email,
    //             'avatar' => 'users/default.png',
    //             'password' => bcrypt($request->password),
    //         ]);
    //         $input['user_id'] = $user->id;
    //         $input['tipo'] = 'user';
    //         $input['full_name'] = $input['nombre'] . ' ' . $input['ap_paterno'] . ' ' . $input['ap_materno'];
    //         Persona::create($input);

    //         if ($request->warehouses[0]) {
    //             $user->warehouses()->attach($request->warehouses);
    //         } 
    //         DB::commit();
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //     }  

    //     if ($request->user_belongstomany_role_relationship <> '') {
    //         $user->roles()->attach($request->user_belongstomany_role_relationship);
    //     }
    //     return redirect()
    //     ->route('voyager.users.index')
    //     ->with([
    //             'message' => "El usuario, se registro con exito.",
    //             'alert-type' => 'success'
    //         ]);
    // }

    public function create_user(Request $request){

        $rules = [
            'nombre' => 'required|max:100',
            'ap_paterno' => 'required|max:75',
            'ap_materno' => 'required|max:75',
            'ci' => 'required',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:6',
        ];
        $messages = [
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'ap_paterno.required' => 'El campo Apellido paterno es obligatorio.',
            'ap_materno.required' => 'El campo Apellido materno es obligatorio.',
            'ci.required' => 'El campo Carnet de indentidad es obligatorio.',
            'email.required' => 'El campo Usuario es obligatorio.',
            'email.unique' => 'El Usuario ya existe.',
            'password.required' => 'El campo Contraseña es obligatorio.',
        ];
        
        $input = $request->all();
        
        $input['estado'] = 'ACTIVO';

        $input['name'] = $input['first_name'];
        $input['registrado_por'] = $request->user()->email;
        
        DB::beginTransaction();
        try {
            
            $user = User::create([
                'name' =>  $input['first_name'].' '.$input['last_name'],
                'role_id' => $request->role_id,
                'email' => $request->email,
                'avatar' => 'users/default.png',
                'password' => bcrypt($request->password),
            ]);
            
            
            $input['user_id'] = $user->id;
            $input['tipo'] = 'user';
            $input['first_name'] = $request->first_name;
            $input['last_name'] = $request->last_name;
            $input['full_name'] = $input['first_name'] . ' ' . $input['last_name'];
          

            // $exis = Persona::where('ci', $input['ci'])->where('tipo','user')->where('deleted_at', null)->first();
            // if(count($exis) > 0){
            //     return redirect()
            //     ->route('voyager.users.index')
            //     ->with([
            //             'message' => "El usuario ya existe.",
            //             'alert-type' => 'error'
            //         ]);
            // }
            Persona::create($input);

            if ($request->warehouses[0]) {
                $user->warehouses()->attach($request->warehouses);
            } 
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }  

        if ($request->user_belongstomany_role_relationship <> '') {
            $user->roles()->attach($request->user_belongstomany_role_relationship);
        }
        return redirect()
        ->route('voyager.users.index')
        ->with([
                'message' => "El usuario, se registro con exito.",
                'alert-type' => 'success'
            ]);
    }

    public function update_user(Request $request, User $user){
       
        $rules = [
            'email' => "required|max:255|unique:users,email,{$user->id}",
        ];
        $messages = [
            'email.required' => 'El campo Usuario es obligatorio.',
            'email.unique' => 'El Usuario ya existe.',
        ];

        $input = $request->all();   
             
        DB::beginTransaction();
        try {
            $user->update([
                'role_id' => $request->role_id,
                'email' => $request->email,
            ]);
            if ($request->warehouses[0]) {
                $user->warehouses()->sync($request->warehouses);
            } 
            if ($request->password != '') {
                $user->password = bcrypt($request->password);
                $user->save();
            }
            if ($request->avatar != '') {
            }
            $input['user_id'] = $user->id;
            if ($request->funcionario_id != '') {
                $user->name = $input['nombre'].' '.$input['ap_paterno'];
                $input['full_name'] = $input['nombre'] . ' ' . $input['ap_paterno'] . ' ' . $input['ap_materno'];
                $user->update();
                Persona::update($input);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }  

        if ($request->user_belongstomany_role_relationship <> '') {
            $user->roles()->sync($request->user_belongstomany_role_relationship);
        }
        return redirect()
        ->route('voyager.users.index')
        ->with([
                'message' => "El usuario, se actualizo con exito.",
                'alert-type' => 'success'
            ]);
    }
}
