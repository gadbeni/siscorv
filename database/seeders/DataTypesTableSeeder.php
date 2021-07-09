<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_types')->delete();
        
        \DB::table('data_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'User',
                'display_name_plural' => 'Users',
                'icon' => 'voyager-person',
                'model_name' => 'TCG\\Voyager\\Models\\User',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2021-06-02 17:55:30',
                'updated_at' => '2021-06-02 17:55:30',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'menus',
                'slug' => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural' => 'Menus',
                'icon' => 'voyager-list',
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'policy_name' => NULL,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2021-06-02 17:55:30',
                'updated_at' => '2021-06-02 17:55:30',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'roles',
                'slug' => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural' => 'Roles',
                'icon' => 'voyager-lock',
                'model_name' => 'TCG\\Voyager\\Models\\Role',
                'policy_name' => NULL,
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2021-06-02 17:55:31',
                'updated_at' => '2021-06-02 17:55:31',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'entities',
                'slug' => 'entities',
                'display_name_singular' => 'Entidad',
                'display_name_plural' => 'Entidades',
                'icon' => 'voyager-company',
                'model_name' => 'App\\Models\\Entity',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-07-09 16:17:41',
                'updated_at' => '2021-07-09 17:13:14',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'acctions',
                'slug' => 'acctions',
                'display_name_singular' => 'Acción',
                'display_name_plural' => 'Acciones',
                'icon' => 'voyager-paperclip',
                'model_name' => 'App\\Models\\Acction',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-07-09 16:36:52',
                'updated_at' => '2021-07-09 17:12:47',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'departamentos',
                'slug' => 'departamentos',
                'display_name_singular' => 'Departamento',
                'display_name_plural' => 'Departamentos',
                'icon' => 'voyager-milestone',
                'model_name' => 'App\\Models\\Departamento',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-07-09 16:40:33',
                'updated_at' => '2021-07-09 17:13:04',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'estados',
                'slug' => 'estados',
                'display_name_singular' => 'Estado',
                'display_name_plural' => 'Estados',
                'icon' => 'voyager-list-add',
                'model_name' => 'App\\Models\\Estado',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2021-07-09 16:53:03',
                'updated_at' => '2021-07-09 16:53:03',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'tipos',
                'slug' => 'tipos',
                'display_name_singular' => 'Tipo',
                'display_name_plural' => 'Tipos',
                'icon' => 'voyager-tag',
                'model_name' => 'App\\Models\\Tipo',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-07-09 17:11:58',
                'updated_at' => '2021-07-09 17:13:32',
            ),
        ));
        
        
    }
}