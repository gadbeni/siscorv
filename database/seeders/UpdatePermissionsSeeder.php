<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UpdatePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            // PermissionRoleTableSeeder::class
        ]);
    }
}
