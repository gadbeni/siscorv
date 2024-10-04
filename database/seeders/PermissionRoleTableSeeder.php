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
                                                
                                                `key` = "browse_report" or
                                                `key` = "browse_report_list-document" or
                                                
                                                `key` = "browse_directorio_telefonico" or
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
                                                `key` = "browse_directorio_telefonico" or
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
                                                `key` = "browse_directorio_telefonico" or
                                                `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());



        // ORDEN DE EMBARGO
        // Para la orden de embargo all
        $role = Role::where('name', 'embargos')->firstOrFail();
        $permissions = Permission::whereRaw('   table_name = "admin" or
                                                table_name = "embargos" or
                                                `key` = "browse_directorio_telefonico" or

                                                `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());

        // Para las orden de embargos solo vista y funcionalidad de TRAMITE Y CORRESPONDENCIA
        $role = Role::where('name', 'funcionario_embargos_view')->firstOrFail();
        $permissions = Permission::whereRaw('   table_name = "admin" or
                                                table_name = "entradas" or
                                                table_name = "bandeja" or

                                                `key` = "browse_embargos" or
                                                `key` = "browse_directorio_telefonico" or

                                                `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());


        // PARA QUE TENGA TODAS LAS FUNCIUONES DE TRAMITE CORRESPONDENCIA Y ORDEN DE EMBARGO
        $role = Role::where('name', 'funcionario_embargos')->firstOrFail();
        $permissions = Permission::whereRaw('   table_name = "admin" or
                                                table_name = "entradas" or
                                                table_name = "bandeja" or

                                                table_name = "embargos" or

                                                `key` = "browse_directorio_telefonico" or

                                                `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());
        
        // PARA VER SOLO VISTA DE ENBARGO
        $role = Role::where('name', 'embargos_view')->firstOrFail();
        $permissions = Permission::whereRaw('   table_name = "admin" or
                                                `key` = "browse_embargos" or

                                                `key` = "browse_directorio_telefonico" or

                                                `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());

        

        // admin_directorio_telefonico
        $role = Role::where('name', 'admin_directorio_telefonico')->firstOrFail();
        $permissions = Permission::whereRaw('   table_name = "admin" or
                                                table_name = "directorio_telefonico" or
                                                `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());
    }
}
