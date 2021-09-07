<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provincia;
use App\Models\Municipio;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ProvinciaMunicipiosSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('municipios')->truncate();
        DB::table('provincias')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $arrayOfProvincesNames = [
            'CERCADO', 'ITENES','JOSE BALLIVIAN','MAMORÉ','MARBÁN','MOXOS','VACA DIEZ','YACUMA'
        ];

        $fecha = Carbon::now();

        $provinces = collect($arrayOfProvincesNames)->map(function ($province) use($fecha) {

            return [
                'nombre' => $province,
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ];

        });
        Provincia::insert($provinces->toArray());

        $municipios = [
            ['nombre' => 'TRINIDAD','provincia_id'=> 1],
            ['nombre' => 'SAN JAVIER','provincia_id'=> 1],
            ['nombre' => 'MAGDALENA','provincia_id'=> 2],
            ['nombre' => 'MAURES','provincia_id'=> 2],
            ['nombre' => 'HUACARAJE','provincia_id'=> 2],
            ['nombre' => 'REYES','provincia_id'=> 3],
            ['nombre' => 'SAN BORJA','provincia_id'=> 3],
            ['nombre' => 'RURRENABAQUE','provincia_id'=> 3],
            ['nombre' => 'SANTA ROSA','provincia_id'=> 3],
            ['nombre' => 'SAN JOAQUIN','provincia_id'=> 4],
            ['nombre' => 'PUERTO SILES','provincia_id'=> 4],
            ['nombre' => 'SAN RAMON','provincia_id'=> 4],
            ['nombre' => 'LORETO','provincia_id'=> 5],
            ['nombre' => 'SAN ANDRES','provincia_id'=> 5],
            ['nombre' => 'SAN IGNACIO','provincia_id'=> 6],
            ['nombre' => 'RIBERALTA','provincia_id'=> 7],
            ['nombre' => 'GUAYARAMERIN','provincia_id'=> 7],
            ['nombre' => 'SANTA ANA','provincia_id'=> 8],
            ['nombre' => 'EXALTACIÓN','provincia_id'=> 8]
        ];

        foreach ($municipios as $municipio) {
            Municipio::create($municipio);
         }
    }
}
