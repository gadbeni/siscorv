<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('personas')->delete();
        
        \DB::table('personas')->insert(array (
            0 => 
            array (
                'id' => 18,
                'nombre' => 'GUIVER ',
                'ap_paterno' => 'GARCIA',
                'ap_materno' => 'LEON',
                'ci' => '5642147',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'javier.condori',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'GUIVER GARCIA LEON',
                'departamento_id' => 4,
                'funcionario_id' => 542,
                'user_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 19,
                'nombre' => 'CARLOS ',
                'ap_paterno' => 'COCARICO',
                'ap_materno' => 'RAPU',
                'ci' => '5626921',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'CARLOS COCARICO RAPU',
                'departamento_id' => 5,
                'funcionario_id' => 5703,
                'user_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 20,
                'nombre' => 'FANOR ',
                'ap_paterno' => 'AMAPO',
                'ap_materno' => 'YUBANERA',
                'ci' => '4199118',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'FANOR AMAPO YUBANERA',
                'departamento_id' => 5,
                'funcionario_id' => 4361,
                'user_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 21,
                'nombre' => 'SERGIO ',
                'ap_paterno' => 'COCA',
                'ap_materno' => 'MARTINEZ',
                'ci' => '4380052',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'javier.condori',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'SERGIO COCA MARTINEZ',
                'departamento_id' => 3,
                'funcionario_id' => 5708,
                'user_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 22,
                'nombre' => 'YRMA LUZ',
                'ap_paterno' => 'BANEGAS',
                'ap_materno' => 'NOE',
                'ci' => '12880114',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'YRMA LUZ BANEGAS NOE',
                'departamento_id' => 5,
                'funcionario_id' => 830,
                'user_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 23,
                'nombre' => 'MESIAS MESAC',
                'ap_paterno' => 'ZABALA',
                'ap_materno' => 'PALMA',
                'ci' => '4189023',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'MESIAS MESAC ZABALA PALMA',
                'departamento_id' => 5,
                'funcionario_id' => 5492,
                'user_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 24,
                'nombre' => 'MARITA ',
                'ap_paterno' => 'NOE',
                'ap_materno' => 'RODRIGUEZ',
                'ci' => '5597335',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'MARITA NOE RODRIGUEZ',
                'departamento_id' => 5,
                'funcionario_id' => 618,
                'user_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 25,
                'nombre' => 'LAUREANO',
                'ap_paterno' => 'PEDRIEL ',
                'ap_materno' => 'EGUEZ',
                'ci' => '1916956',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'LAUREANO PEDRIEL  EGUEZ',
                'departamento_id' => 5,
                'funcionario_id' => 615,
                'user_id' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 26,
                'nombre' => 'SANTIAGO',
                'ap_paterno' => 'ARRAZOLA ',
                'ap_materno' => 'VACA',
                'ci' => '1717015',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'SANTIAGO ARRAZOLA VACA',
                'departamento_id' => 5,
                'funcionario_id' => 641,
                'user_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 27,
                'nombre' => 'CRISTIAN JEHÚ',
                'ap_paterno' => 'NOE',
                'ap_materno' => 'ROSALES',
                'ci' => '10780160',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => '1P',
                'full_name' => 'CRISTIAN JEHÚ NOE ROSALES',
                'departamento_id' => 5,
                'funcionario_id' => 461,
                'user_id' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 28,
                'nombre' => 'ALEXANDER',
                'ap_paterno' => 'FRANCO',
                'ap_materno' => 'DIEZ',
                'ci' => '4175795',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'ALEXANDER  FRANCO DIEZ',
                'departamento_id' => 5,
                'funcionario_id' => 323,
                'user_id' => 13,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 29,
                'nombre' => 'MARLENY',
                'ap_paterno' => 'TEREBA',
                'ap_materno' => 'ESCALANTE',
                'ci' => '1722292',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'MARLENY TEREBA ESCALANTE',
                'departamento_id' => 5,
                'funcionario_id' => 597,
                'user_id' => 14,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 30,
                'nombre' => 'INGRID JAZMÍN',
                'ap_paterno' => 'CHURIPUY',
                'ap_materno' => 'SALOMÓN',
                'ci' => '5604800',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'INGRID JAZMÍN CHURIPUY SALOMÓN',
                'departamento_id' => 5,
                'funcionario_id' => 491,
                'user_id' => 15,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 31,
                'nombre' => 'CHRISTIAN ',
                'ap_paterno' => 'NOTO',
                'ap_materno' => 'SAAVEDRA',
                'ci' => '7636476',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'guiver.garcia',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'CHRISTIAN NOTO SAAVEDRA',
                'departamento_id' => 5,
                'funcionario_id' => 2402,
                'user_id' => 16,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 32,
                'nombre' => 'AUGUSTO',
                'ap_paterno' => 'CARVALHO',
                'ap_materno' => 'CHÁVEZ',
                'ci' => '7635088',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'javier.condori',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => '1F',
                'full_name' => 'AUGUSTO CARVALHO CHÁVEZ',
                'departamento_id' => 5,
                'funcionario_id' => 844,
                'user_id' => 17,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 33,
                'nombre' => 'CAROLINA',
                'ap_paterno' => 'CARBALHO',
                'ap_materno' => 'SUAREZ',
                'ci' => '5597919',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'augustogany',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => NULL,
                'full_name' => 'CAROLINA CARBALHO SUAREZ',
                'departamento_id' => 5,
                'funcionario_id' => 6615,
                'user_id' => 19,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 34,
                'nombre' => 'DARIENT GERARDO',
                'ap_paterno' => 'PEÑA',
                'ap_materno' => 'GARCIA',
                'ci' => '10838067',
                'tipo' => 'users',
                'oficina' => NULL,
                'estado' => 'ACTIVO',
                'registrado_por' => 'augustogany',
                'fecha_baja' => NULL,
                'baja_por' => NULL,
                'alfanum' => '',
                'full_name' => 'DARIENT GERARDO PEÑA GARCIA',
                'departamento_id' => 5,
                'funcionario_id' => 552,
                'user_id' => 20,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}