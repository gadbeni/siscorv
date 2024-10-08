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
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'created_at' => '2021-06-02 17:55:30',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'display_name_plural' => 'Users',
                'display_name_singular' => 'User',
                'generate_permissions' => 1,
                'icon' => 'voyager-person',
                'id' => 1,
                'model_name' => 'App\\Models\\User',
                'name' => 'users',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'server_side' => 0,
                'slug' => 'users',
                'updated_at' => '2023-08-11 18:32:14',
            ),
            1 => 
            array (
                'controller' => '',
                'created_at' => '2021-06-02 17:55:30',
                'description' => '',
                'details' => NULL,
                'display_name_plural' => 'Menus',
                'display_name_singular' => 'Menu',
                'generate_permissions' => 1,
                'icon' => 'voyager-list',
                'id' => 2,
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'name' => 'menus',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'menus',
                'updated_at' => '2021-06-02 17:55:30',
            ),
            2 => 
            array (
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'created_at' => '2021-06-02 17:55:31',
                'description' => '',
                'details' => NULL,
                'display_name_plural' => 'Roles',
                'display_name_singular' => 'Role',
                'generate_permissions' => 1,
                'icon' => 'voyager-lock',
                'id' => 3,
                'model_name' => 'TCG\\Voyager\\Models\\Role',
                'name' => 'roles',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'roles',
                'updated_at' => '2021-06-02 17:55:31',
            ),
            3 => 
            array (
                'controller' => NULL,
                'created_at' => '2021-07-09 16:17:41',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'display_name_plural' => 'Entidades',
                'display_name_singular' => 'Entidad',
                'generate_permissions' => 1,
                'icon' => 'voyager-company',
                'id' => 4,
                'model_name' => 'App\\Models\\Entity',
                'name' => 'entities',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'entities',
                'updated_at' => '2021-07-09 17:13:14',
            ),
            4 => 
            array (
                'controller' => NULL,
                'created_at' => '2021-07-09 16:36:52',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'display_name_plural' => 'Acciones',
                'display_name_singular' => 'Acción',
                'generate_permissions' => 1,
                'icon' => 'voyager-paperclip',
                'id' => 5,
                'model_name' => 'App\\Models\\Acction',
                'name' => 'acctions',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'acctions',
                'updated_at' => '2021-07-09 17:12:47',
            ),
            5 => 
            array (
                'controller' => NULL,
                'created_at' => '2021-07-09 16:40:33',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'display_name_plural' => 'Departamentos',
                'display_name_singular' => 'Departamento',
                'generate_permissions' => 1,
                'icon' => 'voyager-milestone',
                'id' => 6,
                'model_name' => 'App\\Models\\Departamento',
                'name' => 'departamentos',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'departamentos',
                'updated_at' => '2021-07-09 17:13:04',
            ),
            6 => 
            array (
                'controller' => NULL,
                'created_at' => '2021-07-09 16:53:03',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'display_name_plural' => 'Estados',
                'display_name_singular' => 'Estado',
                'generate_permissions' => 1,
                'icon' => 'voyager-list-add',
                'id' => 7,
                'model_name' => 'App\\Models\\Estado',
                'name' => 'estados',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'estados',
                'updated_at' => '2021-09-20 14:00:56',
            ),
            7 => 
            array (
                'controller' => NULL,
                'created_at' => '2021-07-09 17:11:58',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'display_name_plural' => 'Tipos',
                'display_name_singular' => 'Tipo',
                'generate_permissions' => 1,
                'icon' => 'voyager-tag',
                'id' => 8,
                'model_name' => 'App\\Models\\Tipo',
                'name' => 'tipos',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'tipos',
                'updated_at' => '2021-07-09 17:13:32',
            ),
            8 => 
            array (
                'controller' => NULL,
                'created_at' => '2021-09-07 16:20:45',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'display_name_plural' => 'Categorias',
                'display_name_singular' => 'Categoria',
                'generate_permissions' => 1,
                'icon' => NULL,
                'id' => 9,
                'model_name' => 'App\\Models\\Category',
                'name' => 'categories',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'categories',
                'updated_at' => '2021-09-07 16:28:23',
            ),
            9 => 
            array (
                'controller' => NULL,
                'created_at' => '2022-10-03 12:18:45',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'display_name_plural' => 'Orden Embargos',
                'display_name_singular' => 'Orden Embargo',
                'generate_permissions' => 1,
                'icon' => 'fa-solid fa-square-pen',
                'id' => 10,
                'model_name' => 'App\\Models\\Embargo',
                'name' => 'embargos',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'embargos',
                'updated_at' => '2022-10-03 12:18:45',
            ),
            10 => 
            array (
                'controller' => NULL,
                'created_at' => '2023-01-12 15:56:07',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'display_name_plural' => 'Enlaces',
                'display_name_singular' => 'Enlace',
                'generate_permissions' => 1,
                'icon' => 'fa-solid fa-file',
                'id' => 11,
                'model_name' => 'App\\Models\\Enlace',
                'name' => 'enlaces',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'enlaces',
                'updated_at' => '2023-01-12 15:56:07',
            ),
            11 => 
            array (
                'controller' => NULL,
                'created_at' => '2024-10-08 16:10:30',
                'description' => NULL,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'display_name_plural' => 'Directorio Grupos',
                'display_name_singular' => 'Directorio Grupo',
                'generate_permissions' => 1,
                'icon' => 'voyager-pizza',
                'id' => 15,
                'model_name' => 'App\\Models\\DirectorioGrupo',
                'name' => 'directorio_grupos',
                'policy_name' => NULL,
                'server_side' => 0,
                'slug' => 'directorio-grupos',
                'updated_at' => '2024-10-08 16:10:30',
            ),
        ));
        
        
    }
}