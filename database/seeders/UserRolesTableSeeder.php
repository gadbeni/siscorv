<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_roles')->delete();
        
        \DB::table('user_roles')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'user_id' => 2,
                'role_id' => 2,
            ),
            2 => 
            array (
                'user_id' => 3,
                'role_id' => 1,
            ),
            3 => 
            array (
                'user_id' => 4,
                'role_id' => 2,
            ),
            4 => 
            array (
                'user_id' => 5,
                'role_id' => 3,
            ),
            5 => 
            array (
                'user_id' => 6,
                'role_id' => 1,
            ),
            6 => 
            array (
                'user_id' => 7,
                'role_id' => 2,
            ),
            7 => 
            array (
                'user_id' => 8,
                'role_id' => 3,
            ),
            8 => 
            array (
                'user_id' => 9,
                'role_id' => 3,
            ),
            9 => 
            array (
                'user_id' => 10,
                'role_id' => 3,
            ),
            10 => 
            array (
                'user_id' => 11,
                'role_id' => 3,
            ),
            11 => 
            array (
                'user_id' => 13,
                'role_id' => 3,
            ),
            12 => 
            array (
                'user_id' => 14,
                'role_id' => 3,
            ),
            13 => 
            array (
                'user_id' => 15,
                'role_id' => 3,
            ),
            14 => 
            array (
                'user_id' => 16,
                'role_id' => 3,
            ),
            15 => 
            array (
                'user_id' => 17,
                'role_id' => 1,
            ),
            16 => 
            array (
                'user_id' => 19,
                'role_id' => 2,
            ),
            17 => 
            array (
                'user_id' => 20,
                'role_id' => 1,
            ),
            18 => 
            array (
                'user_id' => 21,
                'role_id' => 1,
            ),
        ));
        
        
    }
}