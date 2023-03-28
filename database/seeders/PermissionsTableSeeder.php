<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        \DB::table('permissions')->delete();
        
        Permission::firstOrCreate([
            'key'        => 'browse_admin',
            'table_name' => 'admin',
        ]);
        
        $keys = [
            'browse_bread',
            'browse_database',
            'browse_media',
            'browse_compass',
            'browse_clear-cache',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => null,
            ]);
        }


        Permission::generateFor('menus');
        Permission::generateFor('roles');
        Permission::generateFor('users');
        Permission::generateFor('entities');
        Permission::generateFor('categories');
        Permission::generateFor('entradas');
        Permission::generateFor('certificates');
        Permission::generateFor('settings');
        Permission::generateFor('acctions');
        Permission::generateFor('departamentos');
        Permission::generateFor('estados');
        Permission::generateFor('tipos');
        Permission::generateFor('bandeja');
        Permission::generateFor('people_exts');
        Permission::generateFor('additional_jobs');




        $keys = [
            'browse_report_list-document',
            'browse_report'
            // 'browse_report'
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'report_rde',
            ]);
        }

        //para transferencia de mensaje de persona a persona
        $keys = [
            'browse_exchange',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'exchange',
            ]);
        }


        $keys = [
            'browse_embargos',
            'statu_embargos',
            'add_embargos',   
            'read_embargos'         
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'embargos',
            ]);
        }

        $keys = [
            'browse_enlaces',
            'edit_enlaces',
            'add_enlaces',   
            'read_enlaces',    
            'delete_enlaces',
            
            'browse_enlacefile',
            'add_enlacefile',   
            'read_enlacefile',    
            'delete_enlacefile' 
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'enlaces',
            ]);
        }



    }
}
