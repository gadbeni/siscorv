<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipo;
class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Tipo::count() == 0) {
			Tipo::create([
        	'nombre' => 'CIRCULAR',
        	'ingreso' => '0',
        	'salida' => '1',
        	'estado' => 'ACTIVO'
			]);
			Tipo::create([
				'nombre' => 'CARTA',
				'ingreso' => '1',
				'salida' => '1',
				'estado' => 'ACTIVO'
			]);
			Tipo::create([
				'nombre' => 'COMUNICACIÓN INTERNA',
				'ingreso' => '1',
				'salida' => '1',
				'estado' => 'ACTIVO'
			]);
			Tipo::create([
				'nombre' => 'FAX',
				'ingreso' => '1',
				'salida' => '0',
				'estado' => 'ACTIVO'
			]);
			Tipo::create([
				'nombre' => 'INFORME',
				'ingreso' => '0',
				'salida' => '0',
				'estado' => 'ACTIVO'
			]);
			Tipo::create([
				'nombre' => 'MEMORANDUM',
				'ingreso' => '0',
				'salida' => '1',
				'estado' => 'ACTIVO'
			]);
		}
    }
}
