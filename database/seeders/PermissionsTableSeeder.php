<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'browse_admin',
            'browse_bread',
            'browse_database',
            'browse_media',
            'browse_compass',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => null,
            ]);
        }

        // Permission::create(['key' => 'index_bandeja','table_name' => null]);
        // Permission::create(['key' => 'edit_bandeja','table_name' => null]);
        // Permission::create(['key' => 'show_bandeja','table_name' => null]);
        // Permission::create(['key' => 'create_bandeja','table_name' => null]);
        // Permission::create(['key' => 'delete_bandeja','table_name' => null]);

        // Permission::create(['key' => 'index_seguimiento','table_name' => null]);
        // Permission::create(['key' => 'edit_seguimiento','table_name' => null]);

        Permission::generateFor('menus');
        Permission::generateFor('roles');
        Permission::generateFor('users');
        Permission::generateFor('entities');
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
            // 'browse_report'
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
            'edit_enlacefile',
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
