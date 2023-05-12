<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;


class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // Root
        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill(['display_name' => __('voyager::seeders.roles.admin')])->save();
        }

        // Caja
        $role = Role::firstOrNew(['name' => 'ventanilla']);
        if (!$role->exists) {
            $role->fill(['display_name' => 'Ventanilla'])->save();
        }

        $role = Role::firstOrNew(['name' => 'funcionario']);
        if (!$role->exists) {
            $role->fill(['display_name' => 'Funcionario'])->save();
        }

        $role = Role::firstOrNew(['name' => 'certificados']);
        if (!$role->exists) {
            $role->fill(['display_name' => 'Certificados'])->save();
        }

        $role = Role::firstOrNew(['name' => 'adminpersonerias']);
        if (!$role->exists) {
            $role->fill(['display_name' => 'Administrador SIDEPEJ'])->save();
        }

        $role = Role::firstOrNew(['name' => 'enlace']);
        if (!$role->exists) {
            $role->fill(['display_name' => 'Enlace'])->save();
        }

        //Embargo

        $role = Role::firstOrNew(['name' => 'funcionario_embargos']);
        if (!$role->exists) {
            $role->fill(['display_name' => 'Tramite Correspondencia && Orden Embargo "ALL"'])->save();
        }

        $role = Role::firstOrNew(['name' => 'funcionario_embargos_view']);
        if (!$role->exists) {
            $role->fill(['display_name' => 'Tramite Correspondencia && Orden Embargo "VIEW"'])->save();
        }
        $role = Role::firstOrNew(['name' => 'embargos']);
        if (!$role->exists) {
            $role->fill(['display_name' => 'Orden de Embargos'])->save();
        }
        $role = Role::firstOrNew(['name' => 'embargos_view']);
        if (!$role->exists) {
            $role->fill(['display_name' => 'Orden de Embargos "VIEW'])->save();
        }


        // \DB::table('roles')->delete();
        
        // \DB::table('roles')->insert(array (
        //     0 => 
        //     array (
        //         'id' => 1,
        //         'name' => 'admin',
        //         'display_name' => 'Administrador',
        //         'created_at' => '2021-08-15 13:12:42',
        //         'updated_at' => '2021-08-15 13:12:42',
        //     ),
        //     1 => 
        //     array (
        //         'id' => 2,
        //         'name' => 'ventanilla',
        //         'display_name' => 'Ventanilla',
        //         'created_at' => '2021-08-15 13:12:42',
        //         'updated_at' => '2021-08-15 13:12:42',
        //     ),
        //     2 => 
        //     array (
        //         'id' => 3,
        //         'name' => 'funcionario',
        //         'display_name' => 'Funcionario',
        //         'created_at' => '2021-08-15 13:12:42',
        //         'updated_at' => '2021-08-15 13:12:42',
        //     ),
        //     3 => 
        //     array (
        //         'id' => 4,
        //         'name' => 'certificados',
        //         'display_name' => 'Certificados',
        //         'created_at' => '2021-08-15 13:12:42',
        //         'updated_at' => '2021-08-15 13:12:42',
        //     ),
        //     4 => 
        //     array (
        //         'id' => 5,
        //         'name' => 'adminpersonerias',
        //         'display_name' => 'Administrador SIDEPEJ',
        //         'created_at' => '2021-09-15 14:27:56',
        //         'updated_at' => '2021-09-15 14:27:56',
        //     ),

        //     array (
        //         'id' => 6,
        //         'name' => 'enlace',
        //         'display_name' => 'Enlace',
        //         'created_at' => '2021-09-15 14:27:56',
        //         'updated_at' => '2021-09-15 14:27:56',
        //     ),
        // ));
        
        
    }
}