<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrador',
                'created_at' => '2021-08-15 13:12:42',
                'updated_at' => '2021-08-15 13:12:42',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'ventanilla',
                'display_name' => 'Ventanilla',
                'created_at' => '2021-08-15 13:12:42',
                'updated_at' => '2021-08-15 13:12:42',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'funcionario',
                'display_name' => 'Funcionario',
                'created_at' => '2021-08-15 13:12:42',
                'updated_at' => '2021-08-15 13:12:42',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'certificados',
                'display_name' => 'Certificados',
                'created_at' => '2021-08-15 13:12:42',
                'updated_at' => '2021-08-15 13:12:42',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'adminpersonerias',
                'display_name' => 'Administrador SIDEPEJ',
                'created_at' => '2021-09-15 14:27:56',
                'updated_at' => '2021-09-15 14:27:56',
            ),

            array (
                'id' => 6,
                'name' => 'enlace',
                'display_name' => 'Enlace',
                'created_at' => '2021-09-15 14:27:56',
                'updated_at' => '2021-09-15 14:27:56',
            ),
        ));
        
        
    }
}