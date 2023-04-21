<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permission_role')->delete();
        
        // Root
        $role = Role::where('name', 'admin')->firstOrFail();
        $permissions = Permission::all();
        $role->permissions()->sync($permissions->pluck('id')->all());



        $role = Role::where('name', 'ventanilla')->firstOrFail();
        $permissions = Permission::whereRaw('   table_name = "admin" or
                                                table_name = "entradas" or
                                                table_name = "entities" or
                                                `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());

        // Roles de ventanilla
        // $role = Role::where('name', 'ventanilla')->firstOrFail();
        // $permissions = Permission::whereRaw('table_name = "entradas" or table_name = "entities" or id = 1')->get();
        // $role->permissions()->sync(
        //     $permissions->pluck('id')->all()
        // );


        $role = Role::where('name', 'funcionario')->firstOrFail();
        $permissions = Permission::whereRaw('   table_name = "admin" or
                                                table_name = "entradas" or
                                                table_name = "bandeja" or
                                                `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());

        // Roles de funcionario
        // $role = Role::where('name', 'funcionario')->firstOrFail();
        // $permissions = Permission::whereRaw('table_name = "entradas" or table_name = "bandeja" or id = 1')->get();
        // $role->permissions()->sync(
        //     $permissions->pluck('id')->all()
        // );


        $role = Role::where('name', 'certificados')->firstOrFail();
        $permissions = Permission::whereRaw('   table_name = "admin" or
                                                table_name = "certificates" or
                                                `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());


        // Para la orden de embargo
        $role = Role::where('name', 'embargos')->firstOrFail();
        $permissions = Permission::whereRaw('   table_name = "admin" or
                                                table_name = "embargos" or
                                                `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());
        // Roles de funcionario
        // $role = Role::where('name', 'certificados')->firstOrFail();
        // $permissions = Permission::whereRaw('table_name = "certificates" or id = 1')->get();
        // $role->permissions()->sync(
        //     $permissions->pluck('id')->all()
        // );


    }
}
