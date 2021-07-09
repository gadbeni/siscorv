<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Departamento::count() == 0) {
            $departamentos = [
                [
                    'name' => 'SANTA CRUZ',
                    'sigla' => 'SC'
                ],
                [
                    'name' => 'LA PAZ',
                    'sigla' => 'LP'
                ],
                [
                    'name' => 'COCHABAMBA',
                    'sigla' => 'CBB'
                ],
                [
                    'name' => 'CHUQUISACA',
                    'sigla' => 'CH'
                ],
                [
                    'name' => 'BENI',
                    'sigla' => 'BN'
                ],
                [
                    'name' => 'POTOSI',
                    'sigla' => 'PO'
                ],
                [
                    'name' => 'TARIJA',
                    'sigla' => 'TJ'
                ],
                [
                    'name' => 'ORURO',
                    'sigla' => 'OR'
                ],
                [
                    'name' => 'PANDO',
                    'sigla' => 'PD'
                ],
                [
                    'name' => 'OTRO',
                    'sigla' => 'OT'
                ]
            ];

            foreach ($departamentos as $dep) {
                Departamento::create($dep);
            }
        }
    }
}
