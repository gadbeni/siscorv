<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('organizations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $organizaciones = [
            ['nombre' => 'JUNTA VECINAL', 'tipo' => 'organizaciones'],
            ['nombre' => 'URBANIZACION', 'tipo' => 'organizaciones'],
            ['nombre' => 'BARRIO', 'tipo' => 'organizaciones'],
            ['nombre' => 'COMUNIDAD INDIGENA', 'tipo' => 'organizaciones'],
            ['nombre' => 'COMUNIDAD INTERCULTURAL', 'tipo' => 'organizaciones'],
            ['nombre' => 'COMUNIDAD CAMPESINA', 'tipo' => 'organizaciones'],
            ['nombre' => 'COMUNIDAD AGRICOLA', 'tipo' => 'organizaciones'],
            ['nombre' => 'COMUNIDAD AGRICOLA GANADERA', 'tipo' => 'organizaciones'],
            ['nombre' => 'COMUNIDAD AGRICOLA FORESTAL', 'tipo' => 'organizaciones'],
            ['nombre' =>  'COMUNIDAD GANADERA', 'tipo' => 'organizaciones'],
            ['nombre' => 'PUEBLO INDIGENA', 'tipo' => 'organizaciones'],
            ['nombre' => 'CABILDO INDIGENA', 'tipo' => 'organizaciones'],

            //ambitos de aplicaciones
            ['nombre' => 'ORGANIZACIONES SOCIALES', 'tipo' => 'ambitosaplicacion'],
            ['nombre' => 'ORGANIZACIONES NO GUBERNAMENTALES', 'tipo' => 'ambitosaplicacion'],
            ['nombre' => 'FUNDACIONES', 'tipo' => 'ambitosaplicacion'],
            ['nombre' => 'OTRAS ENTIDADES CIVILES S/F LUCRO', 'tipo' => 'ambitosaplicacion'],

            //objetos
            ['nombre' => 'OTORGACION', 'tipo' => 'objetos'],
            ['nombre' => 'RECONOCIMIENTO', 'tipo' => 'objetos'],
            ['nombre' => 'MODIFICACION', 'tipo' => 'objetos'],
            ['nombre' => 'EXTINCION', 'tipo' => 'objetos'],
            ['nombre' => 'RENOVACION', 'tipo' => 'objetos'],
            ['nombre' => 'ANULACION', 'tipo' => 'objetos'],
            ['nombre' => 'REPOSICION', 'tipo' => 'objetos'],
            ['nombre' => 'ACTUALIZACION', 'tipo' => 'objetos'],

            //categorias
            ['nombre' => 'PERSONERIAS JURIDICAS', 'tipo' => 'tptramites'],
            ['nombre' => 'INVITACIONES', 'tipo' => 'tptramites'],
            ['nombre' => 'SOLICITUDES', 'tipo' => 'tptramites']
        ];

        foreach ($organizaciones as $organizacion) {
            Organization::create($organizacion);
        }
    }
}
