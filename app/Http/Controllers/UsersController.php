<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona;
use DB;

class UsersController extends Controller
{

    public function getFuncionario($search){

        $personas = DB::connection('mysqlgobe')->table('contribuyente as c')
                        ->join('contratos as cont', 'c.N_Carnet', '=', 'cont.idContribuyente')
                        ->where('c.Estado',1)
                        ->where('cont.Estado',1)
                        ->select([
                            'c.ID as id_funcionario',
                            'c.NombreCompleto as nombre_completo',
                            'c.APaterno as paterno','c.alfanu',
                            'c.AMaterno as materno','c.Expedido',
                            DB::raw("CONCAT(PNombre, ' ', SNombre) as nombre"),
                            'c.N_carnet as ci',
                            'c.Estado as estado',
                        ])->where('c.N_carnet', 'like', '%' .$search . '%')->limit(5)->get();

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
    public function create_user(){
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
            'email.unique' => 'El campo Usuario ya existe.',
            'password.required' => 'El campo Contraseña es obligatorio.',
        ];

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $input['estado'] = 'ACTIVO';
        $input['name'] = $input['nombre'] . ' ' . $input['ap_paterno'] . ' ' . $input['ap_materno'];
        $input['registrado_por'] = $request->user()->email;

        DB::beginTransaction();
        try {
            
            $user = User::create([
                'name' =>  $input['nombre'] . ' ' . $input['ap_paterno'] . ' ' . $input['ap_materno'],
                'role_id' => (int)$request->roles[0],
                'email' => $request->email,
                'avatar' => 'users/default.png',
                'password' => bcrypt($request->password),
            ]);
            $input['user_id'] = $user_id;
            Persona::create($input);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }  

        if ($request->roles <> '') {
            $user->roles()->attach($request->roles);
        }
        return redirect()
        ->route('voyager.users.index')
        ->with([
                'message' => "El usuario, se registro con exito.",
                'alert-type' => 'info'
            ]);
    }
}
