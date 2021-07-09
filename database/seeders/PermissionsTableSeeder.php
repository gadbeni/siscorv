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

        Permission::create(['key' => 'index_bandeja','table_name' => null]);
        Permission::create(['key' => 'edit_bandeja','table_name' => null]);
        Permission::create(['key' => 'show_bandeja','table_name' => null]);
        Permission::create(['key' => 'create_bandeja','table_name' => null]);
        Permission::create(['key' => 'delete_bandeja','table_name' => null]);

        Permission::create(['key' => 'index_seguimiento','table_name' => null]);
        Permission::create(['key' => 'edit_seguimiento','table_name' => null]);

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
        Permission::generateFor('entradas');
    }
}
