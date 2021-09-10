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
        if ($type) {
            $personas = DB::connection('mysqlgobe')->table('contribuyente as c')
                        ->join('contratos as cont', 'c.N_Carnet', '=', 'cont.idContribuyente')
                        ->where('c.Estado',1)
                        ->where('cont.Estado',1)
                        ->select([
                            'c.ID as id_funcionario','c.Expedido',
                            'c.NombreCompleto as nombre_completo','c.alfanu',
                            'c.APaterno as paterno','c.AMaterno as materno',
                            DB::raw("CONCAT(PNombre, ' ', SNombre) as nombre"),
                            'c.N_carnet as ci',
                            'c.Estado as estado',
                        ])->where('c.N_carnet', 'like', '%' .$search . '%')
                          ->orWhere('c.NombreCompleto', 'like', '%' . $search . '%')
                          ->groupBy('c.NombreCompleto')
                          ->limit(5)->get();
        } else {
            $personas = DB::connection('mysqlgobe')->table('contribuyente')
                            ->where('Estado',1)
                            ->select([
                                'ID as id_funcionario','Expedido',
                                'NombreCompleto as nombre_completo','alfanu',
                                'APaterno as paterno','AMaterno as materno',
                                DB::raw("CONCAT(PNombre, ' ', SNombre) as nombre"),
                                'N_carnet as ci','tipo'
                            ])
                            ->where('N_carnet', 'like', '%' .$search . '%')
                            ->orWhere('NombreCompleto', 'like', '%' . $search . '%')
                            ->where('tipo','=','externo')
                            ->groupBy('NombreCompleto')
                            ->limit(5)->get();
        }
        $response = array();
        foreach($personas as $persona){
            $response[] = array(
                    "id"=>$persona->id_funcionario,
                    "text"=>$persona->nombre_completo,
                    "nombre" => $persona->nombre,
                    "ap_paterno" => $persona->paterno,
                    "ap_materno" => $persona->materno,
                    "ci" => $persona->ci,
                    "alfanum" => $persona->alfanu,
                    "departamento_id" => $persona->Expedido
        );
        }
        return response()->json($response);
    }
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

        $input['name'] = $input['nombre'];
        $input['registrado_por'] = $request->user()->email;

        DB::beginTransaction();
        try {
            
            $user = User::create([
                'name' =>  $input['nombre'].' '.$input['ap_paterno'],
                'role_id' => $request->role_id,
                'email' => $request->email,
                'avatar' => 'users/default.png',
                'password' => bcrypt($request->password),
            ]);
            $input['user_id'] = $user->id;
            $input['tipo'] = 'user';
            $input['full_name'] = $input['nombre'] . ' ' . $input['ap_paterno'] . ' ' . $input['ap_materno'];
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
