<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Acction;

class AcctionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Acction::count() == 0) {
			Acction::create([
        	'key' => 'AH',
        	'nombre' => 'Archivese',
        	'estado' => 'ACTIVO'
			]);
			Acction::create([
				'key' => 'AO',
				'nombre' => 'Acuda a mi Oficina',
				'estado' => 'ACTIVO'
			]);
			Acction::create([
        	'key' => 'AR',
        	'nombre' => 'Acuse Recibo',
        	'estado' => 'ACTIVO'
			]);
			Acction::create([
				'key' => 'CC',
				'nombre' => 'Coordine Con',
				'estado' => 'ACTIVO'
			]);
			Acction::create([
        	'key' => 'DC',
        	'nombre' => 'De Curso',
        	'estado' => 'ACTIVO'
			]);
			Acction::create([
				'key' => 'ES',
				'nombre' => 'Efectue Seguimiento',
				'estado' => 'ACTIVO'
			]);
			Acction::create([
				'key' => 'IN',
				'nombre' => 'Informe',
				'estado' => 'ACTIVO'
			]);
			Acction::create([
        	'key' => 'PC',
        	'nombre' => 'Para su Conocimiento',
        	'estado' => 'ACTIVO'
			]);
			Acction::create([
				'key' => 'PR',
				'nombre' => 'Prepare Respuesta',
				'estado' => 'ACTIVO'
			]);
			Acction::create([
				'key' => 'TA',
				'nombre' => 'Tome Accion Necesaria',
				'estado' => 'ACTIVO'
			]);
			Acction::create([
				'key' => 'UR',
				'nombre' => 'Urgente',
				'estado' => 'ACTIVO'
			]);
		} 
    }
}
