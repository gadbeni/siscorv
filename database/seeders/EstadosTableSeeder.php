<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Estado::count() == 0) {
            Estado::create([
             'key' => 'A',
             'nombre' => 'Archivado',
             'estado' => 'ACTIVO'
             ]);
             Estado::create([
                 'key' => 'D',
                 'nombre' => 'Despachado',
                 'estado' => 'ACTIVO'
             ]);
             Estado::create([
                 'key' => 'E',
                 'nombre' => 'Enviado',
                 'estado' => 'ACTIVO'
             ]);
             Estado::create([
                 'key' => 'F',
                 'nombre' => 'Finalizado',
                 'estado' => 'ACTIVO'
             ]);
             Estado::create([
                 'key' => 'O',
                 'nombre' => 'Observado',
                 'estado' => 'ACTIVO'
             ]);
             Estado::create([
                 'key' => 'P',
                 'nombre' => 'Pendiente',
                 'estado' => 'ACTIVO'
             ]);
             Estado::create([
                 'key' => 'R',
                 'nombre' => 'Resp. Elaborada',
                 'estado' => 'ACTIVO'
             ]);
             Estado::create([
                 'key' => 'M',
                 'nombre' => 'Migrado',
                 'estado' => 'ACTIVO'
             ]);
         }
    }
}
