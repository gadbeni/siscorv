<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EntitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('entities')->delete();
        
        \DB::table('entities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sigla' => 'ALDB',
                'nombre' => 'ASAMBLEA LEGISLATIVA DEPARTAMENTAL DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-22 07:30:04',
                'updated_at' => '2020-12-22 07:30:04',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'sigla' => 'MDRYT',
                'nombre' => 'MINISTERIO DE DESARROLLO RURAL Y TIERRAS',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 04:39:41',
                'updated_at' => '2020-12-28 04:39:41',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'sigla' => 'CGE',
                'nombre' => 'CONTRALORIA GENERAL DEL ESTADO',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 08:22:15',
                'updated_at' => '2020-12-28 08:22:15',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'sigla' => 'ABC',
                'nombre' => 'ADMINISTRADORA BOLIVIANA DE CARRETERA DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:24:39',
                'updated_at' => '2021-01-04 07:15:42',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'sigla' => 'GAMT',
                'nombre' => 'GOBIERNO AUTONOMO MUNICIPAL DE TRINIDAD',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:26:14',
                'updated_at' => '2020-12-28 10:26:14',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'sigla' => 'SGPMAR',
                'nombre' => 'SUB GOBERNACION PROVINCIA MARBAN',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:30:14',
                'updated_at' => '2020-12-28 11:16:35',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'sigla' => 'SGPYA',
                'nombre' => 'SUB GOBERNACION PROVINCIA YACUMA',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:34:25',
                'updated_at' => '2020-12-28 11:16:12',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'sigla' => 'SGPBA',
                'nombre' => 'SUB GOBERNACION PROVINCIA GRAL. JOSE BALLIVIAN',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:36:52',
                'updated_at' => '2020-12-28 11:13:52',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'sigla' => 'SGPVD',
                'nombre' => 'SUB GOBERNACION PROVINCIA VACA DIEZ- RIBERALTA',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:38:18',
                'updated_at' => '2021-06-09 07:26:54',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'sigla' => 'SGPCE',
                'nombre' => 'SUB GOBERNACION PROVINCIA CERCADO',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:40:51',
                'updated_at' => '2020-12-28 11:13:21',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'sigla' => 'SGPMA',
                'nombre' => 'SUB GOBERNACION PROVINCIA MAMORE',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:42:04',
                'updated_at' => '2020-12-28 11:12:58',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'sigla' => 'SGPI',
                'nombre' => 'SUB GOBERNACION PROVINCIA ITENEZ',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:43:11',
                'updated_at' => '2020-12-28 11:12:38',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'sigla' => 'SGPM',
                'nombre' => 'SUB GOBERNACION PROVINCIA MOXOS',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:44:55',
                'updated_at' => '2020-12-28 11:11:59',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'sigla' => 'CMLO',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE LORETO',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:47:50',
                'updated_at' => '2020-12-28 11:11:12',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'sigla' => 'CMMA',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE MAGDALENA',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:49:22',
                'updated_at' => '2020-12-28 11:10:55',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'sigla' => 'CMSIG',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE SAN IGNACIO DE MOXOS',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:50:57',
                'updated_at' => '2020-12-28 11:10:41',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'sigla' => 'CMBA',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE BAURES',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:52:07',
                'updated_at' => '2020-12-28 11:10:23',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'sigla' => 'CMSJ',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE SAN JOAQUIN',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:53:06',
                'updated_at' => '2020-12-28 11:10:01',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'sigla' => 'CMSAN',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE SAN ANDRES',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:54:23',
                'updated_at' => '2020-12-28 11:09:45',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'sigla' => 'CMTR',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE TRINIDAD',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:56:48',
                'updated_at' => '2020-12-28 11:09:22',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'sigla' => 'CMSRA',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE SAN RAMON',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 10:58:31',
                'updated_at' => '2020-12-28 11:08:50',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'sigla' => 'CMSR',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE SANTA ROSA DEL YACUMA',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:00:14',
                'updated_at' => '2020-12-28 11:08:34',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'sigla' => 'CMSA',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE SANTA ANA DEL YACUMA',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:01:25',
                'updated_at' => '2020-12-28 11:07:52',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'sigla' => 'DEGO',
                'nombre' => 'DESPACHO DE GOBERNACION',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:03:21',
                'updated_at' => '2020-12-28 11:03:21',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'sigla' => 'CMR',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE REYES',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:03:32',
                'updated_at' => '2020-12-28 11:07:33',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'sigla' => 'SDJ',
                'nombre' => 'SECRETARIA DEPARTAMENTAL DE JUSTICIA',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:03:51',
                'updated_at' => '2020-12-28 11:03:51',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'sigla' => 'SDTLC',
                'nombre' => 'SECRETARIA DE TRANSPARENCIA Y LUCHA CONTRA LA CORRUPCION',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:04:40',
                'updated_at' => '2020-12-28 11:04:40',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'sigla' => 'CMG',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE GUAYARAMERIN',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:04:43',
                'updated_at' => '2020-12-28 11:06:59',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'sigla' => 'SDAF',
                'nombre' => 'SECRETARIA DE ADMINISTRACION Y FINANZAS',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:05:11',
                'updated_at' => '2020-12-28 11:05:11',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'sigla' => 'CMEX',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE EXALTACION',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:06:02',
                'updated_at' => '2020-12-28 11:07:10',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'sigla' => 'SDMEH',
                'nombre' => 'SECRETARIA DEPARTAMENTAL DE MINERIA, ENERGIA E  HIDROCARBUROS',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:06:33',
                'updated_at' => '2020-12-28 11:06:33',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'sigla' => 'CMRR',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE RURRENABAQUE',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:07:02',
                'updated_at' => '2020-12-28 11:08:14',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'sigla' => 'CMRI',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE RIBERALTA',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:08:18',
                'updated_at' => '2020-12-28 11:09:05',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'sigla' => 'CMHU',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE HUACARAJE',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:10:03',
                'updated_at' => '2020-12-28 11:11:27',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'sigla' => 'CMSB',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE SAN BORJA',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:11:53',
                'updated_at' => '2020-12-28 11:12:16',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'sigla' => 'CMSJA',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE SAN JAVIER',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:13:50',
                'updated_at' => '2020-12-28 11:14:13',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'sigla' => 'SDDC',
                'nombre' => 'SECRETARIA DEPARTAMENTAL  DE DESARROLLO CAMPESINO',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:18:54',
                'updated_at' => '2020-12-28 11:18:54',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'sigla' => 'SGG',
                'nombre' => 'SECRETARIA DEPARTAMENTAL DE GOBERNACION GENERAL',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:19:31',
                'updated_at' => '2020-12-28 11:19:31',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'sigla' => 'SDPDE',
                'nombre' => 'SECRETARIA DEPARTAMENTAL DE PLANIFICACION Y DESARROLLO ECONOMICO',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:20:17',
                'updated_at' => '2020-12-28 11:20:17',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'sigla' => 'SDDA',
                'nombre' => 'SECRETARIA DEPARTAMENTAL DESARROLLO AMAZONICO',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:20:52',
                'updated_at' => '2020-12-28 11:20:52',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'sigla' => 'SDMARN',
                'nombre' => 'SECRETARIA DEPARTAMENTAL DE MEDIO AMBIENTE Y RECURSOS NATURALES',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:21:35',
                'updated_at' => '2020-12-28 11:21:35',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'sigla' => 'SDDH',
                'nombre' => 'SECRETARIA DEPARTAMENTAL DESARROLLO HUMANO',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:22:10',
                'updated_at' => '2020-12-28 11:22:10',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'sigla' => 'SDOP',
                'nombre' => 'SECRETARIA DEPARTAMENTAL DE OBRAS PUBLICAS',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:22:55',
                'updated_at' => '2020-12-28 11:22:55',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'sigla' => 'SDDPEP',
                'nombre' => 'SECRETARIA DEPARTAMENTAL DESARROLLO PRODUCTIVO Y ECONOMÍA PLURAL',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:24:04',
                'updated_at' => '2020-12-28 11:24:04',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'sigla' => 'DDF',
                'nombre' => 'DIRECCION DEPARTAMENTAL DE FRONTERA /GUAYARAMERIN',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:25:33',
                'updated_at' => '2021-07-13 06:03:20',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'sigla' => 'DDGR',
                'nombre' => 'DIRECCION DEPARTAMENTAL DE GESTION DE RIESGO',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:26:07',
                'updated_at' => '2020-12-28 11:26:07',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'sigla' => 'CORRG. PUERTO SILES',
                'nombre' => 'CORREGIMIENTO MUNICIPIO DE PUERTO SILES',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:28:09',
                'updated_at' => '2020-12-28 11:28:09',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'sigla' => 'CODEPEDIS- BENI',
                'nombre' => 'CONDERACION DEPARTAMENTAL DE PERSONAS CON DISCAPACIDAD - BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:28:11',
                'updated_at' => '2020-12-28 11:28:35',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'sigla' => 'SDDI',
                'nombre' => 'SECRETARIA DEPARTAMENTAL DESARROLLO INDIGENA',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:29:15',
                'updated_at' => '2020-12-28 11:29:15',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'sigla' => 'SEDEGES',
                'nombre' => 'SERVICIO DEPARTAMENTAL DE GESTION SOCIAL',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:29:58',
                'updated_at' => '2020-12-28 11:29:58',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'sigla' => 'SDRMC',
                'nombre' => 'SERVICIO DEPARTAMENTAL DE FORTALECIMIENTO MUNICIPAL  Y COMUNAL',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:30:50',
                'updated_at' => '2020-12-28 11:30:50',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'sigla' => 'SEDES',
                'nombre' => 'SERVICIO DEPARTAMENTAL DE SALUD',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:31:19',
                'updated_at' => '2020-12-28 11:31:19',
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'sigla' => 'HPGBCH',
                'nombre' => 'HOSPITAL  PRESIDENTE GERMAN BUCH',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:32:13',
                'updated_at' => '2020-12-28 11:32:13',
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'sigla' => 'SEDEDE',
                'nombre' => 'SERVICIO DEPARTAMENTAL DEPORTES',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:32:49',
                'updated_at' => '2020-12-28 11:32:49',
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'sigla' => 'SEBASA',
                'nombre' => 'SERVICIO DEPARTAMENTAL DE BANCO DE SANGRE',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:33:26',
                'updated_at' => '2020-12-28 11:33:26',
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'sigla' => 'HMI',
                'nombre' => 'HOSPITAL MATERNO INFALTIL',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:33:55',
                'updated_at' => '2020-12-28 11:33:55',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'sigla' => 'DIS',
                'nombre' => 'DIRECCION DE INTERACCION SOCIAL',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:34:24',
                'updated_at' => '2020-12-28 11:34:24',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'sigla' => 'DAI',
                'nombre' => 'DIRECCION AUDITORIA INTERNA',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:34:49',
                'updated_at' => '2020-12-28 11:34:49',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'sigla' => 'DCMS',
                'nombre' => 'DIRECCION COORDINACION MOVIMIENTOS SOCIALES',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:35:24',
                'updated_at' => '2020-12-28 11:35:24',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'sigla' => 'DSC',
                'nombre' => 'DIRECCION SEGURIDAD CIUDADANA',
                'estado' => 'ACTIVO',
                'created_at' => '2020-12-28 11:35:49',
                'updated_at' => '2020-12-28 11:35:49',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'sigla' => 'PERSONAL',
                'nombre' => 'PERSONAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-04 06:15:32',
                'updated_at' => '2021-01-04 06:15:32',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'sigla' => 'RED SALUD',
                'nombre' => 'RED DE SALUD 06 BALLIVIAN REYES RURE Y SANTA ROSA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-04 06:44:36',
                'updated_at' => '2021-01-04 06:44:36',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'sigla' => 'PROCURADURIA',
                'nombre' => 'PROCURADURIA GENERAL DEL ESTADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-06 08:43:21',
                'updated_at' => '2021-01-06 08:43:21',
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'sigla' => 'MSALUD',
                'nombre' => 'MINISTERIO DE SALUD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-06 11:36:35',
                'updated_at' => '2021-01-06 11:36:35',
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'sigla' => 'M ECONOMIA',
                'nombre' => 'MINISTERIO DE ECONOMIA Y FINANZAS PUBLICAS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-06 11:56:11',
                'updated_at' => '2021-01-06 11:56:11',
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'sigla' => 'CORDES',
                'nombre' => 'CAJA CORDES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 06:19:30',
                'updated_at' => '2021-01-07 06:19:30',
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'sigla' => 'COMUNIDAD',
                'nombre' => 'COMUNIDAD AGRARIA CAMPESINA ROSARIO DEL YATA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 06:45:23',
                'updated_at' => '2021-01-07 06:45:23',
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'sigla' => 'PERS',
                'nombre' => 'PERSONAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 07:16:25',
                'updated_at' => '2021-01-07 07:16:25',
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'sigla' => 'COMITE',
                'nombre' => 'COMITE CIVICO DEPARTAMENTAL DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 07:23:05',
                'updated_at' => '2021-01-07 07:23:05',
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'sigla' => 'POLICIA',
                'nombre' => 'COMANDO DEPARTAMENTAL  DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 07:32:01',
                'updated_at' => '2021-01-07 07:32:01',
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'sigla' => 'CONTACTO',
                'nombre' => 'EDITORIAL EL BAJIO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 07:42:54',
                'updated_at' => '2021-01-07 07:42:54',
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'sigla' => 'CAMARA ',
                'nombre' => 'CAMARA DE DIPUTADO DE TRINIDAD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 08:01:37',
                'updated_at' => '2021-01-07 08:01:37',
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'sigla' => 'FEDERACION',
                'nombre' => 'FEDERACION SINDICAL DE TRABAJADORES EN SALUD  PUBLICA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 08:25:02',
                'updated_at' => '2021-01-07 08:25:02',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'sigla' => 'REGIMEN',
                'nombre' => 'REGIMEN PENITENCIARIO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 08:29:43',
                'updated_at' => '2021-01-07 08:29:43',
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'sigla' => 'FISCALIA',
                'nombre' => 'FISCALIA DEPARTAMENTAL DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 08:49:45',
                'updated_at' => '2021-06-24 09:04:57',
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'sigla' => 'COURRIER',
                'nombre' => 'COURRIER',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 10:04:12',
                'updated_at' => '2021-01-07 10:04:12',
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'sigla' => 'BANCO',
                'nombre' => 'BANCO CENTRAL DE BOLIVIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 10:43:54',
                'updated_at' => '2021-01-07 10:43:54',
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'sigla' => 'JUNTA',
                'nombre' => 'JUNTA VECINAL /BARRIO EL ARENAL  GUAYARAMERIN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 11:21:54',
                'updated_at' => '2021-01-07 11:21:54',
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'sigla' => 'AFP',
                'nombre' => 'AFP PREVISION',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 11:51:39',
                'updated_at' => '2021-07-06 07:21:05',
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'sigla' => 'GOBIERNO',
                'nombre' => 'GOBIERNO AUTONOMO MUNICIPAL DE SANTA ANA   DEL  YACUMA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-07 12:04:41',
                'updated_at' => '2021-07-23 09:23:54',
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'sigla' => 'SOCIEDAD',
                'nombre' => 'SOCIEDAD DE INGENIERO DE BOLIVIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-08 07:03:53',
                'updated_at' => '2021-01-08 07:03:53',
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'sigla' => 'MINISTERIO',
                'nombre' => 'MINISTERIO DE HIDROCARBURO Y ENERGIA /LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-08 07:28:21',
                'updated_at' => '2021-01-08 07:28:21',
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'sigla' => 'HIDROCARBURO',
                'nombre' => 'MINISTERIO DE HIDROCARBURO Y EMERGIA /LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-08 07:30:57',
                'updated_at' => '2021-01-08 07:30:57',
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'sigla' => 'PALO HUECO',
                'nombre' => 'COMUNIDAD CAMPESINA PALO HUECO /PROV BARBAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-08 08:55:24',
                'updated_at' => '2021-01-08 08:55:24',
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'sigla' => 'INTEGRAL PRODUCTORE',
                'nombre' => 'ASOCIACION INTEGRAL PROD..20 DE AGOSTO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-08 09:23:31',
                'updated_at' => '2021-01-08 09:23:31',
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'sigla' => 'DEFENSORIA',
                'nombre' => 'DEFENSORIA DEPARTAMENTAL DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-08 09:31:43',
                'updated_at' => '2021-01-08 09:31:43',
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'sigla' => 'IGLESIA ',
                'nombre' => 'IGLESIA DE JESUCRISTO MISIONERA DE GUAYARAMERIN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-08 11:31:07',
                'updated_at' => '2021-01-08 11:31:07',
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'sigla' => 'DEL PUEBLO',
                'nombre' => 'DEFENSORIA DEL PUEBLO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-11 10:00:45',
                'updated_at' => '2021-01-11 10:00:45',
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'sigla' => 'TIGO',
                'nombre' => 'EMPRESA DE TIGO /SANTA CRUZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-12 06:01:00',
                'updated_at' => '2021-01-12 06:01:00',
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 90,
                'sigla' => 'COLEGIO',
                'nombre' => 'COLEGIO MEDICO DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-12 07:45:11',
                'updated_at' => '2021-01-12 07:45:11',
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 91,
                'sigla' => 'SEGURO ',
                'nombre' => 'SEGURO SOCIAL  MILITAR COSSMIL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-12 08:08:45',
                'updated_at' => '2021-01-18 08:40:15',
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 92,
                'sigla' => 'PROTECCION ',
                'nombre' => 'ASOCIACION PROTECCION ANIMAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-12 08:40:27',
                'updated_at' => '2021-01-12 08:40:27',
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 93,
                'sigla' => 'AUTONOMO',
                'nombre' => 'GOBIERNO AUTONOMO MUNIC DE SAN JAVIER',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-13 07:32:06',
                'updated_at' => '2021-01-13 07:32:06',
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 94,
                'sigla' => 'DISCACIDAD',
                'nombre' => 'FEDERACION DE PERSONA CON DISCACIDAD.FEDEPD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-13 07:53:31',
                'updated_at' => '2021-01-13 07:53:31',
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 95,
                'sigla' => 'DISCAPACIDAD',
                'nombre' => 'FEDERACION  DE PERSONA CON DISCAPACIDAD -FEBEPDI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-13 08:08:27',
                'updated_at' => '2021-01-13 08:08:27',
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 96,
                'sigla' => 'PARLAMENTARIA',
                'nombre' => 'BRIGADA PARLAMENTARIA DEL BENI-CAMARA DE SENADORES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-13 08:15:17',
                'updated_at' => '2021-01-13 08:15:17',
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'sigla' => 'ALCALDIA',
                'nombre' => 'SUB ALCALDIA MUNIC DE  YUCUMO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-13 08:21:45',
                'updated_at' => '2021-01-13 08:21:45',
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 98,
                'sigla' => 'SUPERIOR DE MAESTRO',
                'nombre' => 'MINISTERIO DE EDUCACION  -CLARA PARADA DE PINTO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-14 04:39:06',
                'updated_at' => '2021-01-14 04:39:06',
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 99,
                'sigla' => 'VIDA',
                'nombre' => 'INSTITUTO VIDA-CONSULTORES  ASOCIADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-14 05:01:51',
                'updated_at' => '2021-01-14 05:01:51',
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 100,
                'sigla' => 'TIPNIS',
                'nombre' => 'SUB CENTRAL    DE SECURE  TIPNIS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-14 05:12:14',
                'updated_at' => '2021-01-14 05:12:14',
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'sigla' => 'COREGIMIENTO',
                'nombre' => 'COREGIMIENTO DE SAN RAMON',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-14 06:33:02',
                'updated_at' => '2021-01-14 06:33:02',
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'id' => 102,
                'sigla' => 'ASOBENA',
                'nombre' => 'ASOCIACION BENIANA DE NATACION',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-14 07:27:08',
                'updated_at' => '2021-01-14 07:27:08',
                'deleted_at' => NULL,
            ),
            102 => 
            array (
                'id' => 103,
                'sigla' => 'SAN RAMON',
                'nombre' => 'CORREGIMIENTO DEL MUNICIPIO DE SAN RAMON',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-14 07:38:41',
                'updated_at' => '2021-01-14 07:38:41',
                'deleted_at' => NULL,
            ),
            103 => 
            array (
                'id' => 104,
                'sigla' => 'SEXTA DIVISION',
                'nombre' => 'COMANDO  GENERAL  SEXTA DIVISION',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-14 08:42:27',
                'updated_at' => '2021-01-14 08:42:27',
                'deleted_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'sigla' => 'COSMIL',
                'nombre' => 'COSMIL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-15 07:42:33',
                'updated_at' => '2021-01-15 07:42:33',
                'deleted_at' => NULL,
            ),
            105 => 
            array (
                'id' => 106,
                'sigla' => 'CMIB',
                'nombre' => 'CENTRAL DE MUJERES INDIGENAS  DEL BENI  -CMIB-',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-15 08:13:15',
                'updated_at' => '2021-01-15 08:13:15',
                'deleted_at' => NULL,
            ),
            106 => 
            array (
                'id' => 107,
                'sigla' => 'URBANIZACION ',
                'nombre' => 'URBANIZACION 11 DE JULIO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-15 10:28:03',
                'updated_at' => '2021-01-15 10:28:03',
                'deleted_at' => NULL,
            ),
            107 => 
            array (
                'id' => 108,
                'sigla' => 'COREGIMIENTO TCO',
                'nombre' => 'COREGIMIENTO COMUNIDAD SANTISIMA TRINIDAD TCO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-18 05:08:15',
                'updated_at' => '2021-01-18 05:08:15',
                'deleted_at' => NULL,
            ),
            108 => 
            array (
                'id' => 109,
                'sigla' => 'MTEPS',
                'nombre' => 'MINISTERIO DE TRABAJO, EMPLEO Y PREVISION SOCIAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-18 07:35:03',
                'updated_at' => '2021-01-18 07:35:03',
                'deleted_at' => NULL,
            ),
            109 => 
            array (
                'id' => 110,
                'sigla' => 'CENTRO COVID',
                'nombre' => 'CENTRO COVID UNIVERSIDAD AUTONOMA RIBERALTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-18 09:12:20',
                'updated_at' => '2021-01-18 09:12:20',
                'deleted_at' => NULL,
            ),
            110 => 
            array (
                'id' => 111,
                'sigla' => 'MINISTERIO PUBLICO',
                'nombre' => 'FISCALIA GENERAL DEL ESTADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-18 09:56:44',
                'updated_at' => '2021-01-18 09:56:44',
                'deleted_at' => NULL,
            ),
            111 => 
            array (
                'id' => 112,
                'sigla' => 'COREGIMIENTOS',
                'nombre' => 'COREGIMIENTO DE RURENABAQUE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-18 11:07:19',
                'updated_at' => '2021-01-18 11:07:19',
                'deleted_at' => NULL,
            ),
            112 => 
            array (
                'id' => 113,
                'sigla' => 'MINIS',
                'nombre' => 'MINISTERIO DE RELACIONES EXTERIORES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-18 11:42:45',
                'updated_at' => '2021-01-18 11:42:45',
                'deleted_at' => NULL,
            ),
            113 => 
            array (
                'id' => 114,
                'sigla' => 'CAMPESINA',
                'nombre' => 'COMUNIDAD CAMPESINA  VILLA LAGUNA LA BOMBA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-18 11:48:02',
                'updated_at' => '2021-01-18 11:48:02',
                'deleted_at' => NULL,
            ),
            114 => 
            array (
                'id' => 115,
                'sigla' => 'COMUNIDADES',
                'nombre' => 'COMUNIDAD INDIGENA PUERTO GERALDA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-20 07:27:02',
                'updated_at' => '2021-01-20 07:27:02',
                'deleted_at' => NULL,
            ),
            115 => 
            array (
                'id' => 116,
                'sigla' => 'MINISTERIO PUBLICOS',
                'nombre' => 'HIDROCARBURO Y ENERGIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-20 09:04:25',
                'updated_at' => '2021-01-20 09:04:25',
                'deleted_at' => NULL,
            ),
            116 => 
            array (
                'id' => 117,
                'sigla' => 'UNIVERSIDAD',
                'nombre' => 'UNIVERSIDAD AUTONOMA DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-20 09:41:10',
                'updated_at' => '2021-01-20 09:41:10',
                'deleted_at' => NULL,
            ),
            117 => 
            array (
                'id' => 118,
                'sigla' => 'CCT',
                'nombre' => 'CORREGIMIENTO CERCADO TRINIDAD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-20 10:16:30',
                'updated_at' => '2021-01-20 10:16:30',
                'deleted_at' => NULL,
            ),
            118 => 
            array (
                'id' => 119,
                'sigla' => 'INE',
                'nombre' => 'INSTITUTO NACIONAL DE ESTADISTICAS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-20 10:35:49',
                'updated_at' => '2021-01-20 10:35:49',
                'deleted_at' => NULL,
            ),
            119 => 
            array (
                'id' => 120,
                'sigla' => 'PBCD',
                'nombre' => 'POLICIA BOLIVIANA COMANDO DPTAL TRINIDAD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-20 10:41:28',
                'updated_at' => '2021-01-20 10:41:28',
                'deleted_at' => NULL,
            ),
            120 => 
            array (
                'id' => 121,
                'sigla' => 'FNDDR',
                'nombre' => 'FONDO NACIONAL DE DESARROLLO REGIONAL - LA PAZ ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-20 10:58:57',
                'updated_at' => '2021-07-15 10:47:52',
                'deleted_at' => NULL,
            ),
            121 => 
            array (
                'id' => 122,
                'sigla' => 'CORREGIMIENTO',
                'nombre' => 'COREGIMIENTO SANTA ANA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-21 11:52:40',
                'updated_at' => '2021-01-21 11:52:40',
                'deleted_at' => NULL,
            ),
            122 => 
            array (
                'id' => 123,
                'sigla' => 'IMPUESTO ',
                'nombre' => 'IMPUESTO NACIONALES  DE TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-21 11:58:58',
                'updated_at' => '2021-01-21 11:58:58',
                'deleted_at' => NULL,
            ),
            123 => 
            array (
                'id' => 124,
                'sigla' => 'MAMORE ',
                'nombre' => 'SUB GOBERNACION -MAMORE /PUERTO SILES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-25 07:24:16',
                'updated_at' => '2021-01-25 07:24:16',
                'deleted_at' => NULL,
            ),
            124 => 
            array (
                'id' => 125,
                'sigla' => 'MAMORE SAN JOAQUIN',
                'nombre' => 'SUB GOBERNACION  MAMORE /SAN JOAQUIN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-25 07:27:25',
                'updated_at' => '2021-01-25 07:27:25',
                'deleted_at' => NULL,
            ),
            125 => 
            array (
                'id' => 126,
                'sigla' => 'SUB ',
                'nombre' => 'SUBCENTRAL  DE CABILDO INDIGENALES MULTIETNICO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-25 08:26:35',
                'updated_at' => '2021-01-25 08:26:35',
                'deleted_at' => NULL,
            ),
            126 => 
            array (
                'id' => 127,
                'sigla' => 'EVANGELICO',
                'nombre' => 'MINISTERIO  EVANGELICO   EL ALFARERO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-25 08:37:14',
                'updated_at' => '2021-01-25 08:37:14',
                'deleted_at' => NULL,
            ),
            127 => 
            array (
                'id' => 128,
                'sigla' => 'RADIO',
                'nombre' => 'SUPER FM 101.5',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-25 08:53:52',
                'updated_at' => '2021-01-25 08:53:52',
                'deleted_at' => NULL,
            ),
            128 => 
            array (
                'id' => 129,
                'sigla' => 'ASOCABA',
                'nombre' => 'ASOCABA ASOCIACION DE CAÑEROS BALLIVIAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-25 09:04:21',
                'updated_at' => '2021-01-25 09:04:21',
                'deleted_at' => NULL,
            ),
            129 => 
            array (
                'id' => 130,
                'sigla' => 'AGROFORESTAL',
                'nombre' => 'ASOCIACION  DE PRODUCTORES AGROFORESTALES  DE LA REGION ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-25 10:24:29',
                'updated_at' => '2021-01-25 10:24:29',
                'deleted_at' => NULL,
            ),
            130 => 
            array (
                'id' => 131,
                'sigla' => 'ABC --TDD',
                'nombre' => 'ABC -TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-25 10:31:02',
                'updated_at' => '2021-01-25 10:31:02',
                'deleted_at' => NULL,
            ),
            131 => 
            array (
                'id' => 132,
                'sigla' => 'BENIANA',
                'nombre' => 'ASOCIACION BENIANA  DE FUTBOL DE SALON',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-25 11:19:56',
                'updated_at' => '2021-01-25 11:19:56',
                'deleted_at' => NULL,
            ),
            132 => 
            array (
                'id' => 133,
                'sigla' => 'ACCIDENTAL JPCM',
                'nombre' => 'ASOCIACION ACCIDENTAL  "JPCM"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-25 11:25:07',
                'updated_at' => '2021-01-25 11:25:07',
                'deleted_at' => NULL,
            ),
            133 => 
            array (
                'id' => 134,
                'sigla' => 'PUERTO ALMACEN',
                'nombre' => 'SUB ALCALDIA PUERTO ALMACEN --TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-26 08:05:02',
                'updated_at' => '2021-01-26 08:05:02',
                'deleted_at' => NULL,
            ),
            134 => 
            array (
                'id' => 135,
                'sigla' => 'SEMENA ',
                'nombre' => 'SEMENA--TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-26 09:05:29',
                'updated_at' => '2021-01-26 09:05:29',
                'deleted_at' => NULL,
            ),
            135 => 
            array (
                'id' => 136,
                'sigla' => 'GOBIERNO  --TDD',
                'nombre' => 'MINISTERIO DE GOBIERNO DE TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-26 09:18:21',
                'updated_at' => '2021-01-26 09:18:21',
                'deleted_at' => NULL,
            ),
            136 => 
            array (
                'id' => 137,
                'sigla' => 'MUNICIPAL',
                'nombre' => 'GOBIERNO AUTONOMO  MUNICIPAL DE SAN ANDRES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-26 09:40:10',
                'updated_at' => '2021-01-26 09:40:10',
                'deleted_at' => NULL,
            ),
            137 => 
            array (
                'id' => 138,
                'sigla' => 'SUBCENTRAL',
                'nombre' => 'SUB CENTRAL  TIPNIS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-26 11:31:09',
                'updated_at' => '2021-01-26 11:31:09',
                'deleted_at' => NULL,
            ),
            138 => 
            array (
                'id' => 139,
                'sigla' => 'SANTA CRUZ ',
                'nombre' => 'MEDIPORT  -SANTA CRUZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-27 05:37:17',
                'updated_at' => '2021-01-27 05:37:17',
                'deleted_at' => NULL,
            ),
            139 => 
            array (
                'id' => 140,
                'sigla' => 'YPFB',
                'nombre' => 'YPFB / SANTA  CRUZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-27 06:26:39',
                'updated_at' => '2021-01-27 06:26:39',
                'deleted_at' => NULL,
            ),
            140 => 
            array (
                'id' => 141,
                'sigla' => 'SANTA ROSA',
                'nombre' => 'CORREGIMIENTO MUNICIPAL DE SANTA ROSA DEL YACUMA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-27 10:46:17',
                'updated_at' => '2021-01-27 10:46:17',
                'deleted_at' => NULL,
            ),
            141 => 
            array (
                'id' => 142,
                'sigla' => 'SAN IGNACIO DE MOXOS',
                'nombre' => 'CORREGIMIENTO  PROV DE MOXOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-27 11:08:52',
                'updated_at' => '2021-01-27 11:08:52',
                'deleted_at' => NULL,
            ),
            142 => 
            array (
                'id' => 143,
                'sigla' => 'TSIMANE',
                'nombre' => 'GRAN CONCEJO  TSIMANE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-28 08:37:58',
                'updated_at' => '2021-01-28 08:37:58',
                'deleted_at' => NULL,
            ),
            143 => 
            array (
                'id' => 144,
                'sigla' => 'CENTRAL ',
                'nombre' => 'CENTRAL CAMPESINOS DE LA PROVINCIA DE MARBAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-28 11:10:12',
                'updated_at' => '2021-01-28 11:10:12',
                'deleted_at' => NULL,
            ),
            144 => 
            array (
                'id' => 145,
                'sigla' => 'MINISTERI',
                'nombre' => 'MINISTERIO DE SALUD Y DEPORTES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-29 07:06:27',
                'updated_at' => '2021-01-29 07:06:27',
                'deleted_at' => NULL,
            ),
            145 => 
            array (
                'id' => 146,
                'sigla' => 'MINISTERIOS',
                'nombre' => 'MINISTERIO DE MEDIO AMBIENTE Y AGUA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-29 07:47:51',
                'updated_at' => '2021-01-29 07:47:51',
                'deleted_at' => NULL,
            ),
            146 => 
            array (
                'id' => 147,
                'sigla' => 'CORRE',
                'nombre' => 'COREGIMIENTO CERCADO TRINIDAD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-29 08:02:42',
                'updated_at' => '2021-01-29 08:02:42',
                'deleted_at' => NULL,
            ),
            147 => 
            array (
                'id' => 148,
                'sigla' => 'PER',
                'nombre' => 'PERSONAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-29 08:13:47',
                'updated_at' => '2021-01-29 08:13:47',
                'deleted_at' => NULL,
            ),
            148 => 
            array (
                'id' => 149,
                'sigla' => 'CORREGIMIEN',
                'nombre' => 'CORREGIMIENTO DE RIBERALTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-29 08:19:25',
                'updated_at' => '2021-06-22 05:34:07',
                'deleted_at' => NULL,
            ),
            149 => 
            array (
                'id' => 150,
                'sigla' => 'CORE',
                'nombre' => 'COREGIMIENTO DE SAN JAVIER',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-29 08:32:42',
                'updated_at' => '2021-01-29 08:32:42',
                'deleted_at' => NULL,
            ),
            150 => 
            array (
                'id' => 151,
                'sigla' => 'ITONAMA',
                'nombre' => 'SUB CENTRAL DE PUEBLO INDIGENA  ITONAMA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-29 09:21:13',
                'updated_at' => '2021-01-29 09:21:13',
                'deleted_at' => NULL,
            ),
            151 => 
            array (
                'id' => 152,
                'sigla' => 'INDIGENA',
                'nombre' => ' COMUNIDAD INDIGENA  TSIMANE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-29 11:28:15',
                'updated_at' => '2021-01-29 11:28:15',
                'deleted_at' => NULL,
            ),
            152 => 
            array (
                'id' => 153,
                'sigla' => 'HONORABLE CONCEJO',
                'nombre' => 'HONORABLE CONCEJO MUNICIPAL  DE BAURE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-29 11:40:22',
                'updated_at' => '2021-01-29 11:40:22',
                'deleted_at' => NULL,
            ),
            153 => 
            array (
                'id' => 154,
                'sigla' => 'EL TRIUNFO',
                'nombre' => 'COMUNIDAD CAMPESINA EL TRIUNFO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-01-29 11:44:23',
                'updated_at' => '2021-01-29 11:44:23',
                'deleted_at' => NULL,
            ),
            154 => 
            array (
                'id' => 155,
                'sigla' => 'PUENTE SAN PABLO',
                'nombre' => 'JUNTA VECINAL  PUENTE SAN PABLO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-01 10:13:32',
                'updated_at' => '2021-02-01 10:13:32',
                'deleted_at' => NULL,
            ),
            155 => 
            array (
                'id' => 156,
                'sigla' => 'ORGANO ',
                'nombre' => 'TRIBUNAL ELECTORAL DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-02 09:29:22',
                'updated_at' => '2021-02-02 09:29:22',
                'deleted_at' => NULL,
            ),
            156 => 
            array (
                'id' => 157,
                'sigla' => '17 DE JULIO',
                'nombre' => 'ASOCIACION  VIVANDERAS "17 DE JULIO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-02 09:52:24',
                'updated_at' => '2021-02-02 09:52:24',
                'deleted_at' => NULL,
            ),
            157 => 
            array (
                'id' => 158,
                'sigla' => 'VELASCO',
                'nombre' => 'EMPRESA VELASCO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-02 10:29:49',
                'updated_at' => '2021-02-02 10:29:49',
                'deleted_at' => NULL,
            ),
            158 => 
            array (
                'id' => 159,
                'sigla' => 'LA PAZ ',
                'nombre' => 'CAMARA DE ENADORS DE LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-04 06:20:01',
                'updated_at' => '2021-02-04 06:20:01',
                'deleted_at' => NULL,
            ),
            159 => 
            array (
                'id' => 160,
                'sigla' => 'LIVE',
                'nombre' => ' DISTRIBUIDORA LIVE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-04 07:41:09',
                'updated_at' => '2021-02-04 07:41:09',
                'deleted_at' => NULL,
            ),
            160 => 
            array (
                'id' => 161,
                'sigla' => 'CARIÑO CAMBA',
                'nombre' => 'SNACK CARIÑO  CAMBA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-04 08:35:17',
                'updated_at' => '2021-02-04 08:35:17',
                'deleted_at' => NULL,
            ),
            161 => 
            array (
                'id' => 162,
                'sigla' => ' 20  DE AGOSTO',
                'nombre' => 'ASOCIACION   PRODUCTORES  20  DE AGOSTO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-04 09:03:37',
                'updated_at' => '2021-02-04 09:03:37',
                'deleted_at' => NULL,
            ),
            162 => 
            array (
                'id' => 163,
                'sigla' => 'TRANSPORTE PESADO',
                'nombre' => 'SINDICATO  DE TRANSPORTE   PESADO " MOXOS"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-04 09:12:29',
                'updated_at' => '2021-02-04 09:12:29',
                'deleted_at' => NULL,
            ),
            163 => 
            array (
                'id' => 164,
                'sigla' => 'YP',
                'nombre' => 'YPFB',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-04 11:08:30',
                'updated_at' => '2021-02-04 11:08:30',
                'deleted_at' => NULL,
            ),
            164 => 
            array (
                'id' => 165,
                'sigla' => 'MINISTERIOS  DE',
                'nombre' => 'MINISTERIO DE LA PRESIDENCIA LA PAZ COURIER',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-04 11:18:03',
                'updated_at' => '2021-02-04 11:18:03',
                'deleted_at' => NULL,
            ),
            165 => 
            array (
                'id' => 166,
                'sigla' => 'CAJA',
                'nombre' => 'CAJA DE SALUD DE CAMINOS ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-04 11:23:30',
                'updated_at' => '2021-02-04 11:23:30',
                'deleted_at' => NULL,
            ),
            166 => 
            array (
                'id' => 167,
                'sigla' => 'COREGIMIENTOS DE',
                'nombre' => 'COREGIMIENTO DE SAN JOAQUIN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-04 11:34:42',
                'updated_at' => '2021-02-04 11:34:42',
                'deleted_at' => NULL,
            ),
            167 => 
            array (
                'id' => 168,
                'sigla' => 'GOBIERNO AU',
                'nombre' => 'GOBIERNO AUTONOMO MUNICIPAL DE LORETO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-04 11:50:40',
                'updated_at' => '2021-02-04 11:50:40',
                'deleted_at' => NULL,
            ),
            168 => 
            array (
                'id' => 169,
                'sigla' => 'COREGIMIENTOS DE MAG',
                'nombre' => 'COREGIMIENTO DE MAGDALENA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-04 12:00:18',
                'updated_at' => '2021-02-04 12:00:18',
                'deleted_at' => NULL,
            ),
            169 => 
            array (
                'id' => 170,
                'sigla' => 'TOTAIZAL',
                'nombre' => 'COMUNIDAD INIGENA TOTAIZAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-10 10:49:33',
                'updated_at' => '2021-02-10 10:49:33',
                'deleted_at' => NULL,
            ),
            170 => 
            array (
                'id' => 171,
                'sigla' => 'INCOS',
                'nombre' => 'INSTITUTO TECNICO INCOS - BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-10 10:58:43',
                'updated_at' => '2021-02-10 10:58:43',
                'deleted_at' => NULL,
            ),
            171 => 
            array (
                'id' => 172,
                'sigla' => 'COR',
                'nombre' => 'CORREGIMIENTO DE EXALTACION PROVINCIA YACUMA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-11 04:32:11',
                'updated_at' => '2021-02-11 04:32:11',
                'deleted_at' => NULL,
            ),
            172 => 
            array (
                'id' => 173,
                'sigla' => 'ASOPEMO',
            'nombre' => 'ASOCIACION DE PESCADORS MOJEÑOS (ASOPMO)',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-11 10:15:09',
                'updated_at' => '2021-02-11 10:15:09',
                'deleted_at' => NULL,
            ),
            173 => 
            array (
                'id' => 174,
                'sigla' => 'SAN BORJA',
                'nombre' => 'GOB AUTONOMO MUNICIPAL DE SAN BORJA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-12 05:20:33',
                'updated_at' => '2021-02-12 05:20:33',
                'deleted_at' => NULL,
            ),
            174 => 
            array (
                'id' => 175,
                'sigla' => 'CAM',
                'nombre' => 'CAMARA AGROPECUARIA DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-12 07:22:04',
                'updated_at' => '2021-02-12 07:22:04',
                'deleted_at' => NULL,
            ),
            175 => 
            array (
                'id' => 176,
                'sigla' => 'PERS',
                'nombre' => 'PERSONERIA JURIDICA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-12 07:22:24',
                'updated_at' => '2021-02-23 06:57:23',
                'deleted_at' => NULL,
            ),
            176 => 
            array (
                'id' => 177,
                'sigla' => 'ASAMBLEA LEG.',
                'nombre' => 'ASAMBLEA LEGISLATIVA PLURINACIONAL DE BOLIVIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-17 05:59:07',
                'updated_at' => '2021-02-17 05:59:07',
                'deleted_at' => NULL,
            ),
            177 => 
            array (
                'id' => 178,
                'sigla' => 'CONIF',
                'nombre' => 'CONFEDERACION TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-17 06:57:30',
                'updated_at' => '2021-02-17 06:57:30',
                'deleted_at' => NULL,
            ),
            178 => 
            array (
                'id' => 179,
                'sigla' => 'TURIRO',
                'nombre' => 'CONSTRUCTORA CONSULTORA TURIRO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-17 07:20:11',
                'updated_at' => '2021-02-17 07:20:11',
                'deleted_at' => NULL,
            ),
            179 => 
            array (
                'id' => 180,
                'sigla' => 'RIBERALTA',
            'nombre' => 'JUNTA VECINAL 18 DE ABRIL (RIBERALTA)',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-18 04:39:11',
                'updated_at' => '2021-02-18 04:49:30',
                'deleted_at' => NULL,
            ),
            180 => 
            array (
                'id' => 181,
                'sigla' => 'METEOROLOGIA',
                'nombre' => 'SERVICIO NACIONAL DE METEOROLOGIA E HIDROLOGIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-18 07:09:17',
                'updated_at' => '2021-02-18 07:09:17',
                'deleted_at' => NULL,
            ),
            181 => 
            array (
                'id' => 182,
                'sigla' => 'ATL EL BENIANO',
                'nombre' => 'ASOCIACION DEPARTAMENTAL DE TRANSPORTE LIBRE "EL BENIANO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-18 08:06:42',
                'updated_at' => '2021-02-18 08:06:42',
                'deleted_at' => NULL,
            ),
            182 => 
            array (
                'id' => 183,
                'sigla' => 'GOB. RIBERALTA',
                'nombre' => 'GOBIERNO AUTONOMO MUNICIPAL DE RIBERALTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-18 09:12:12',
                'updated_at' => '2021-02-18 09:12:12',
                'deleted_at' => NULL,
            ),
            183 => 
            array (
                'id' => 184,
                'sigla' => 'CIASPRO',
                'nombre' => 'CIASPRO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-19 06:23:19',
                'updated_at' => '2021-02-19 06:23:19',
                'deleted_at' => NULL,
            ),
            184 => 
            array (
                'id' => 185,
                'sigla' => 'DOMINGO',
                'nombre' => 'UNIVRSIAD PRIVADA DOMINGO SAVIO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-19 06:34:59',
                'updated_at' => '2021-02-19 06:34:59',
                'deleted_at' => NULL,
            ),
            185 => 
            array (
                'id' => 186,
                'sigla' => 'MOPSV',
                'nombre' => 'MINISTERIO DE OBRAS PUBLICAS,SERVICIOS Y VIVIENDA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-19 06:48:57',
                'updated_at' => '2021-02-19 06:48:57',
                'deleted_at' => NULL,
            ),
            186 => 
            array (
                'id' => 187,
                'sigla' => 'TIG0',
                'nombre' => 'TIGO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-19 08:58:11',
                'updated_at' => '2021-02-19 08:58:11',
                'deleted_at' => NULL,
            ),
            187 => 
            array (
                'id' => 188,
                'sigla' => 'NOTARIA',
                'nombre' => 'NOTARIA DE FE PUBLICA N°3',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-19 10:46:30',
                'updated_at' => '2021-02-19 10:46:30',
                'deleted_at' => NULL,
            ),
            188 => 
            array (
                'id' => 189,
                'sigla' => 'REGION MILITAR',
                'nombre' => 'DIRECCION GENERAL TERRITORIAL REGION MILITAR N°6 BOLIVIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-23 05:39:03',
                'updated_at' => '2021-02-23 05:39:03',
                'deleted_at' => NULL,
            ),
            189 => 
            array (
                'id' => 190,
                'sigla' => 'COLONIA',
                'nombre' => 'COLONIA AGROPECUARIA 3 DE MAYO NUCLEO 37',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-23 05:55:14',
                'updated_at' => '2021-02-23 05:55:14',
                'deleted_at' => NULL,
            ),
            190 => 
            array (
                'id' => 191,
                'sigla' => 'PARAISO',
                'nombre' => 'PARAISO TRAVEL VIAJES Y TURISMO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-23 06:12:43',
                'updated_at' => '2021-02-23 06:12:43',
                'deleted_at' => NULL,
            ),
            191 => 
            array (
                'id' => 192,
                'sigla' => 'PRO ',
                'nombre' => 'PRO VIVIENDA S.A.',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-24 05:11:47',
                'updated_at' => '2021-02-24 05:11:47',
                'deleted_at' => NULL,
            ),
            192 => 
            array (
                'id' => 193,
                'sigla' => 'MJTI',
                'nombre' => 'MINISTERIO DE JUSTICIA Y TRANSPARENCIA INSTITUCIONAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-24 05:45:33',
                'updated_at' => '2021-02-24 05:45:33',
                'deleted_at' => NULL,
            ),
            193 => 
            array (
                'id' => 194,
                'sigla' => 'CHINA',
                'nombre' => 'DEPARTAMENTO DE PROYECTO DE CHINA RAILWAY CONSTRUCTION CORPORATION LIMITED',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-24 06:25:54',
                'updated_at' => '2021-02-24 06:25:54',
                'deleted_at' => NULL,
            ),
            194 => 
            array (
                'id' => 195,
                'sigla' => 'PACU',
                'nombre' => 'ASOCIACION DE PISCICULTORES "PACU"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-24 06:52:33',
                'updated_at' => '2021-02-24 06:52:33',
                'deleted_at' => NULL,
            ),
            195 => 
            array (
                'id' => 196,
                'sigla' => 'ITSA',
                'nombre' => 'INSTITUTO TECNOLOGICO SUPERIOR DE LA AMAZONIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-24 07:20:13',
                'updated_at' => '2021-02-24 07:20:13',
                'deleted_at' => NULL,
            ),
            196 => 
            array (
                'id' => 197,
                'sigla' => 'MD',
                'nombre' => 'MINISTERIO DE DEFENSA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-24 08:53:33',
                'updated_at' => '2021-02-24 08:53:33',
                'deleted_at' => NULL,
            ),
            197 => 
            array (
                'id' => 198,
                'sigla' => 'ARMADA',
                'nombre' => 'ARMADA BOLIVIANA SEGUNDO DISTRITO NAVAL MAMORE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-25 04:09:01',
                'updated_at' => '2021-02-25 04:09:01',
                'deleted_at' => NULL,
            ),
            198 => 
            array (
                'id' => 199,
                'sigla' => 'S. ROSA',
                'nombre' => 'CORREGIMIENTO DE SANTA ROSA GRAL. JOSE BALLIVIAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-25 04:58:18',
                'updated_at' => '2021-02-25 04:58:18',
                'deleted_at' => NULL,
            ),
            199 => 
            array (
                'id' => 200,
                'sigla' => 'AVAROA',
                'nombre' => 'COMUNIDAD EDUARDO AVAROA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-25 05:54:38',
                'updated_at' => '2021-02-25 05:54:38',
                'deleted_at' => NULL,
            ),
            200 => 
            array (
                'id' => 201,
                'sigla' => 'INRA',
                'nombre' => 'INSTITUTO NACIONAL DE REFORMA AGRARIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-25 07:04:10',
                'updated_at' => '2021-02-25 07:04:10',
                'deleted_at' => NULL,
            ),
            201 => 
            array (
                'id' => 202,
                'sigla' => 'GREMIALES ',
                'nombre' => 'FEDERACION REGIONAL DE GREMIALES PUENTE SAN PABLO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-25 08:29:31',
                'updated_at' => '2021-02-25 08:29:31',
                'deleted_at' => NULL,
            ),
            202 => 
            array (
                'id' => 203,
                'sigla' => 'PFSAP',
                'nombre' => 'PRESENTE Y FUTURO SOCIEDAD ACADEMICA Y PROFESIONAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-26 03:57:26',
                'updated_at' => '2021-02-26 03:57:26',
                'deleted_at' => NULL,
            ),
            203 => 
            array (
                'id' => 204,
                'sigla' => 'CD',
                'nombre' => 'CAMARA DE DIPUTADOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-26 04:57:37',
                'updated_at' => '2021-02-26 04:57:37',
                'deleted_at' => NULL,
            ),
            204 => 
            array (
                'id' => 205,
                'sigla' => 'FEGABENI',
                'nombre' => 'FEDERACION DE GANADEROS DEL BENI "FEGABENI"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-02-26 10:33:17',
                'updated_at' => '2021-02-26 10:33:17',
                'deleted_at' => NULL,
            ),
            205 => 
            array (
                'id' => 206,
                'sigla' => 'OEP',
                'nombre' => 'ORGANO ELECTORAL PLURINACIONAL  BOLIVIA - LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-02 04:14:24',
                'updated_at' => '2021-07-15 10:56:34',
                'deleted_at' => NULL,
            ),
            206 => 
            array (
                'id' => 207,
                'sigla' => 'MEDI',
                'nombre' => 'MEDIQUIP',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-02 05:11:32',
                'updated_at' => '2021-03-02 05:11:32',
                'deleted_at' => NULL,
            ),
            207 => 
            array (
                'id' => 208,
                'sigla' => 'ASUSS',
                'nombre' => 'AUTORIDAD DE SUPERVISION DE LA SEGURIDAD SOCIAL DE CORTO PLAZO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-08 04:19:02',
                'updated_at' => '2021-03-08 04:19:02',
                'deleted_at' => NULL,
            ),
            208 => 
            array (
                'id' => 209,
                'sigla' => 'PICASO SRL',
                'nombre' => 'PICASO S.R.L.',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-08 06:27:34',
                'updated_at' => '2021-03-08 06:27:34',
                'deleted_at' => NULL,
            ),
            209 => 
            array (
                'id' => 210,
                'sigla' => 'E.C.U.',
                'nombre' => 'URIZAR',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-08 06:44:22',
                'updated_at' => '2021-03-08 06:44:22',
                'deleted_at' => NULL,
            ),
            210 => 
            array (
                'id' => 211,
                'sigla' => 'MUTUAL ',
                'nombre' => 'MUTUAL DE FUTBOLISTAS GUAYARAMERIN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-08 06:50:01',
                'updated_at' => '2021-03-08 06:50:01',
                'deleted_at' => NULL,
            ),
            211 => 
            array (
                'id' => 212,
                'sigla' => 'CCA',
                'nombre' => 'CARMEN DEL DORADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-08 09:17:14',
                'updated_at' => '2021-03-08 09:17:14',
                'deleted_at' => NULL,
            ),
            212 => 
            array (
                'id' => 213,
                'sigla' => 'UNIR',
                'nombre' => 'FUNDACION UNIR BOLIVIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-08 11:08:00',
                'updated_at' => '2021-03-08 11:08:00',
                'deleted_at' => NULL,
            ),
            213 => 
            array (
                'id' => 214,
                'sigla' => 'PMA',
                'nombre' => 'PROGRAMA MUNDIAL DE ALIMENTOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-08 11:36:12',
                'updated_at' => '2021-03-08 11:36:12',
                'deleted_at' => NULL,
            ),
            214 => 
            array (
                'id' => 215,
                'sigla' => 'NOTARIA.',
                'nombre' => 'NOTARIA DE FE PUBLICA N°80',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-09 06:34:39',
                'updated_at' => '2021-03-09 06:34:39',
                'deleted_at' => NULL,
            ),
            215 => 
            array (
                'id' => 216,
                'sigla' => '6 DE ENERO',
                'nombre' => 'JUNTA VECINAL 6 DE ENERO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-09 07:43:39',
                'updated_at' => '2021-03-09 07:43:39',
                'deleted_at' => NULL,
            ),
            216 => 
            array (
                'id' => 217,
                'sigla' => 'JUANA AZURDUY',
                'nombre' => 'JUANA AZURDUY',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-09 07:56:51',
                'updated_at' => '2021-03-09 07:56:51',
                'deleted_at' => NULL,
            ),
            217 => 
            array (
                'id' => 218,
                'sigla' => 'CORREGIMIENTO.',
                'nombre' => 'CORREGIMIENTO MAMORE/ PUERTO SILES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-09 09:11:38',
                'updated_at' => '2021-03-09 09:11:38',
                'deleted_at' => NULL,
            ),
            218 => 
            array (
                'id' => 219,
                'sigla' => 'ECM',
                'nombre' => 'ESCUELA CRISTIANA DE MINISTERIOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-09 09:16:41',
                'updated_at' => '2021-03-09 09:16:41',
                'deleted_at' => NULL,
            ),
            219 => 
            array (
                'id' => 220,
                'sigla' => 'MAESTRANZA',
                'nombre' => 'UNIDAD DE MANTENIMIENTO Y REPARACION DIRECCION DEPARTAMENTAL ADMINISTRATIVO GAD BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-10 08:17:44',
                'updated_at' => '2021-03-10 08:17:44',
                'deleted_at' => NULL,
            ),
            220 => 
            array (
                'id' => 221,
                'sigla' => 'SEDEGES.',
                'nombre' => 'SEDEGES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-10 10:59:26',
                'updated_at' => '2021-03-10 10:59:26',
                'deleted_at' => NULL,
            ),
            221 => 
            array (
                'id' => 222,
                'sigla' => 'EL PALMAR ',
                'nombre' => 'CORREGIMIENTO TERRITORIAL "EL PALMAR"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-11 07:05:13',
                'updated_at' => '2021-03-11 07:05:13',
                'deleted_at' => NULL,
            ),
            222 => 
            array (
                'id' => 223,
                'sigla' => 'FED',
                'nombre' => 'FEDERACION TRANSPORTITAS DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-11 11:56:38',
                'updated_at' => '2021-03-11 11:57:59',
                'deleted_at' => NULL,
            ),
            223 => 
            array (
                'id' => 224,
                'sigla' => 'TORONJAL',
                'nombre' => 'COMUNIDAD INDIGENA TSIMANE TORONJAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-12 05:34:31',
                'updated_at' => '2021-03-12 05:34:31',
                'deleted_at' => NULL,
            ),
            224 => 
            array (
                'id' => 225,
                'sigla' => 'T.C.O.',
                'nombre' => 'TACANA CAVINEÑO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-15 04:28:08',
                'updated_at' => '2021-03-15 04:28:08',
                'deleted_at' => NULL,
            ),
            225 => 
            array (
                'id' => 226,
                'sigla' => 'EL JUMBO',
                'nombre' => 'COMUNIDAD INDIGENA TACANA "EL JUMBO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-15 04:29:33',
                'updated_at' => '2021-03-15 04:29:33',
                'deleted_at' => NULL,
            ),
            226 => 
            array (
                'id' => 227,
                'sigla' => 'MDCYD',
                'nombre' => 'MINISTERIO DE CULTURAS, DESCOLONIZACION Y DESPATRIARCALIZACION',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-17 05:15:57',
                'updated_at' => '2021-03-17 05:15:57',
                'deleted_at' => NULL,
            ),
            227 => 
            array (
                'id' => 228,
                'sigla' => 'GERMAN BUSCH',
                'nombre' => 'SINDICATO DE CHOFERES TAXISTAS TTE. GRAL. "GERMAN BUSCH"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-17 05:26:05',
                'updated_at' => '2021-03-17 05:26:05',
                'deleted_at' => NULL,
            ),
            228 => 
            array (
                'id' => 229,
                'sigla' => 'BUEN DESTINO ',
                'nombre' => 'COMUNIDAD INDIGENA CAVINEÑA "BUEN DESTINO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-18 05:12:07',
                'updated_at' => '2021-03-18 05:12:07',
                'deleted_at' => NULL,
            ),
            229 => 
            array (
                'id' => 230,
                'sigla' => 'COMUNIDA',
                'nombre' => 'COMUNIDAD BELLA VISTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-18 08:10:09',
                'updated_at' => '2021-03-18 08:10:09',
                'deleted_at' => NULL,
            ),
            230 => 
            array (
                'id' => 231,
                'sigla' => 'MC',
                'nombre' => 'ESTACION DE SERVICIOS-MC',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-22 05:54:37',
                'updated_at' => '2021-03-22 05:54:37',
                'deleted_at' => NULL,
            ),
            231 => 
            array (
                'id' => 232,
                'sigla' => 'MINISTERIO.',
                'nombre' => 'MINISTERIO DE GOBIERNO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-24 05:05:58',
                'updated_at' => '2021-03-24 05:05:58',
                'deleted_at' => NULL,
            ),
            232 => 
            array (
                'id' => 233,
                'sigla' => 'ENDE',
                'nombre' => 'ENDE DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-26 05:10:13',
                'updated_at' => '2021-03-26 05:10:13',
                'deleted_at' => NULL,
            ),
            233 => 
            array (
                'id' => 234,
                'sigla' => 'ASOBETRI',
                'nombre' => 'ASOCIACION BENIANA DE TRIATLON',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-26 05:14:19',
                'updated_at' => '2021-03-26 05:14:19',
                'deleted_at' => NULL,
            ),
            234 => 
            array (
                'id' => 235,
                'sigla' => 'GAM HUACARAJE',
                'nombre' => 'G.A.M. HUACARAJE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-26 05:30:49',
                'updated_at' => '2021-03-26 05:30:49',
                'deleted_at' => NULL,
            ),
            235 => 
            array (
                'id' => 236,
                'sigla' => 'NOTARIA,',
                'nombre' => 'NOTARIA DE FE PUBLICA N°2',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-26 06:00:29',
                'updated_at' => '2021-03-26 06:00:29',
                'deleted_at' => NULL,
            ),
            236 => 
            array (
                'id' => 237,
                'sigla' => 'C.O.R.',
                'nombre' => 'CENTRAL OBRERA REGIONAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-26 06:17:22',
                'updated_at' => '2021-03-26 06:17:22',
                'deleted_at' => NULL,
            ),
            237 => 
            array (
                'id' => 238,
                'sigla' => 'DDCB',
                'nombre' => 'DEPARTAMENTAL DE DEFENSA CIVIL DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-29 04:37:22',
                'updated_at' => '2021-03-29 04:37:22',
                'deleted_at' => NULL,
            ),
            238 => 
            array (
                'id' => 239,
                'sigla' => 'CDB',
                'nombre' => 'CORREGIMIENTOS DEPARTAMENTAL DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-29 07:50:45',
                'updated_at' => '2021-03-29 07:50:45',
                'deleted_at' => NULL,
            ),
            239 => 
            array (
                'id' => 240,
                'sigla' => 'ASAINAL',
                'nombre' => 'COMUNIDAD CAMPESINA "ASAINAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-29 09:00:08',
                'updated_at' => '2021-03-29 09:00:08',
                'deleted_at' => NULL,
            ),
            240 => 
            array (
                'id' => 241,
                'sigla' => 'MAGAM',
                'nombre' => 'DISTRIBUIDORA MAGAM',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-31 04:49:08',
                'updated_at' => '2021-03-31 04:49:08',
                'deleted_at' => NULL,
            ),
            241 => 
            array (
                'id' => 242,
                'sigla' => 'APLESIM',
                'nombre' => 'ASOCIACION DE PRODUCTORES DE LECHE SAN IGNACIO DE MOXOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-31 06:58:55',
                'updated_at' => '2021-03-31 06:58:55',
                'deleted_at' => NULL,
            ),
            242 => 
            array (
                'id' => 243,
                'sigla' => 'FRIGORIFICO',
                'nombre' => 'MATADERO FRIGORIFICO "MARBAN"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-03-31 10:52:30',
                'updated_at' => '2021-03-31 10:52:30',
                'deleted_at' => NULL,
            ),
            243 => 
            array (
                'id' => 244,
                'sigla' => 'FRICCO',
                'nombre' => 'FEDERACION REGIONAL INTEGRAL DE COMUNIDADES CAMPESINAS ORIGINARIAS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-05 06:36:21',
                'updated_at' => '2021-04-05 06:36:21',
                'deleted_at' => NULL,
            ),
            244 => 
            array (
                'id' => 245,
                'sigla' => 'MUSEO KENNETH LEE',
                'nombre' => 'MUSEO ETNOARQUEOLOGICO KENNETH LEE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-05 07:26:29',
                'updated_at' => '2021-04-05 07:26:29',
                'deleted_at' => NULL,
            ),
            245 => 
            array (
                'id' => 246,
                'sigla' => 'MERAKI S.R.L.',
                'nombre' => 'MERAKI S.R.L.',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-06 05:11:00',
                'updated_at' => '2021-04-06 05:11:00',
                'deleted_at' => NULL,
            ),
            246 => 
            array (
                'id' => 247,
                'sigla' => 'ABP CACAO',
                'nombre' => 'ASOCIACION BENIANA DE PRODUCTORES Y RECOLECTORES DEL CACAO NATIVO AMAZONICO DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-06 06:26:56',
                'updated_at' => '2021-04-06 06:26:56',
                'deleted_at' => NULL,
            ),
            247 => 
            array (
                'id' => 248,
                'sigla' => 'DEX BOLIVIA SRL',
                'nombre' => 'DISTRIBUCION EXPRESSA BOLIVIA SRL- DEX BOLIVIA SRL.',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-06 06:53:47',
                'updated_at' => '2021-04-06 06:53:47',
                'deleted_at' => NULL,
            ),
            248 => 
            array (
                'id' => 249,
                'sigla' => 'SYNAPTIC',
                'nombre' => 'IMPORTADORA SYNAPTIC -TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-06 09:38:08',
                'updated_at' => '2021-04-06 09:38:08',
                'deleted_at' => NULL,
            ),
            249 => 
            array (
                'id' => 250,
                'sigla' => 'UPRE',
                'nombre' => 'UNIDAD DE PROYECTOS ESPECIALES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-09 08:15:08',
                'updated_at' => '2021-04-09 08:15:08',
                'deleted_at' => NULL,
            ),
            250 => 
            array (
                'id' => 251,
                'sigla' => 'CONCEJO',
                'nombre' => 'CONCEJO MUNICIPAL SAN BORJA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-09 08:40:12',
                'updated_at' => '2021-04-09 08:40:32',
                'deleted_at' => NULL,
            ),
            251 => 
            array (
                'id' => 252,
                'sigla' => 'UPRE.',
                'nombre' => 'UPRE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-09 09:37:51',
                'updated_at' => '2021-04-09 09:37:51',
                'deleted_at' => NULL,
            ),
            252 => 
            array (
                'id' => 253,
                'sigla' => 'MDP Y EP',
                'nombre' => 'MINISTERIO DE DESARROLLO PRODUCTIVO Y ECONOMIA PLURAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-09 10:29:33',
                'updated_at' => '2021-04-09 10:29:33',
                'deleted_at' => NULL,
            ),
            253 => 
            array (
                'id' => 254,
                'sigla' => 'MOCOVI',
                'nombre' => 'CENTRO DE REHABILITACION MOCOVI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-12 08:22:44',
                'updated_at' => '2021-04-12 08:22:44',
                'deleted_at' => NULL,
            ),
            254 => 
            array (
                'id' => 255,
                'sigla' => 'ANH',
                'nombre' => 'AGENCIA NACIONAL DE HIDROCARBUROS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-12 09:53:49',
                'updated_at' => '2021-04-12 09:53:49',
                'deleted_at' => NULL,
            ),
            255 => 
            array (
                'id' => 256,
                'sigla' => 'GAM TARIJA',
                'nombre' => 'GOBIERNO AUTONOMO MUNICIPAL DE TARIJA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-13 06:14:28',
                'updated_at' => '2021-04-13 06:14:28',
                'deleted_at' => NULL,
            ),
            256 => 
            array (
                'id' => 257,
                'sigla' => 'TRIBUNAL DE JUSTICIA',
                'nombre' => 'TRIBUNAL DEPARTAMENTAL DE JUSTICIA DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-14 06:54:27',
                'updated_at' => '2021-04-14 06:54:27',
                'deleted_at' => NULL,
            ),
            257 => 
            array (
                'id' => 258,
                'sigla' => 'SCIRS',
                'nombre' => 'SCIRS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-16 05:45:21',
                'updated_at' => '2021-04-16 05:45:21',
                'deleted_at' => NULL,
            ),
            258 => 
            array (
                'id' => 259,
                'sigla' => 'FEICOBOL',
                'nombre' => 'FEICOBOL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-16 07:01:57',
                'updated_at' => '2021-04-16 07:01:57',
                'deleted_at' => NULL,
            ),
            259 => 
            array (
                'id' => 260,
                'sigla' => 'GAM MAGDALENA ',
                'nombre' => 'GOBIERNO AUTONOMO MUNICIPAL DE MAGDALENA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-16 07:10:12',
                'updated_at' => '2021-04-16 07:12:13',
                'deleted_at' => NULL,
            ),
            260 => 
            array (
                'id' => 261,
                'sigla' => 'CIRABO ',
                'nombre' => 'CIRABO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-16 10:09:48',
                'updated_at' => '2021-04-16 10:09:48',
                'deleted_at' => NULL,
            ),
            261 => 
            array (
                'id' => 262,
                'sigla' => 'OIKA',
                'nombre' => 'ORGANIZACION INDIGENA DEL PUEBLO KABINEÑO DE LA AMAZONIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-16 10:15:34',
                'updated_at' => '2021-04-16 10:15:34',
                'deleted_at' => NULL,
            ),
            262 => 
            array (
                'id' => 263,
                'sigla' => 'AMAZONIA SOSTENIBLE',
                'nombre' => 'AMAZONIA SOSTENIBLE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-16 11:17:13',
                'updated_at' => '2021-04-16 11:17:13',
                'deleted_at' => NULL,
            ),
            263 => 
            array (
                'id' => 264,
                'sigla' => 'BENI',
                'nombre' => 'CORREGIMIENTO  DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-22 12:09:17',
                'updated_at' => '2021-04-22 12:09:17',
                'deleted_at' => NULL,
            ),
            264 => 
            array (
                'id' => 265,
                'sigla' => 'MINI',
                'nombre' => 'MINISTERIO DE PLANIFICACION DEL DESARROLLO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-23 05:11:55',
                'updated_at' => '2021-04-23 05:11:55',
                'deleted_at' => NULL,
            ),
            265 => 
            array (
                'id' => 266,
                'sigla' => 'GOBIRNO',
                'nombre' => 'GOBIERNO MUNICIPAL DE RIBERALTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-04-23 08:13:00',
                'updated_at' => '2021-04-23 08:13:00',
                'deleted_at' => NULL,
            ),
            266 => 
            array (
                'id' => 267,
                'sigla' => 'UAB',
                'nombre' => 'UAB JOS BALLIVIAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-05-25 04:34:56',
                'updated_at' => '2021-05-25 04:34:56',
                'deleted_at' => NULL,
            ),
            267 => 
            array (
                'id' => 268,
                'sigla' => 'JOSE',
                'nombre' => 'UAB JOSE BALLIVIAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-05-25 04:41:19',
                'updated_at' => '2021-05-25 04:41:19',
                'deleted_at' => NULL,
            ),
            268 => 
            array (
                'id' => 269,
                'sigla' => 'DE LOS SANTO REYES',
                'nombre' => 'GOBIERNO  AUTONOM. MUNIC. DE LOS SANTO REYES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-05-28 08:53:09',
                'updated_at' => '2021-05-28 08:53:09',
                'deleted_at' => NULL,
            ),
            269 => 
            array (
                'id' => 270,
                'sigla' => 'WWF',
                'nombre' => 'POR UN PLANETA  VIVO-SANTA CRUZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-05-28 10:11:39',
                'updated_at' => '2021-05-28 10:13:23',
                'deleted_at' => NULL,
            ),
            270 => 
            array (
                'id' => 271,
                'sigla' => 'GUAYARAMERIN',
                'nombre' => 'GOBIERNO AUTONOMO MUNICIPAL DE GUAYARAMERIN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-01 05:20:10',
                'updated_at' => '2021-06-01 05:20:10',
                'deleted_at' => NULL,
            ),
            271 => 
            array (
                'id' => 272,
                'sigla' => 'CNIB',
                'nombre' => 'CAMARA  NACIONAL-CNIB -SANTA CRUZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-01 05:37:41',
                'updated_at' => '2021-06-01 05:39:10',
                'deleted_at' => NULL,
            ),
            272 => 
            array (
                'id' => 273,
                'sigla' => 'EGPP -COURRIER -',
                'nombre' => 'EGPP - COURRIER- LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-01 05:49:42',
                'updated_at' => '2021-06-01 05:49:42',
                'deleted_at' => NULL,
            ),
            273 => 
            array (
                'id' => 274,
                'sigla' => 'COLFYKB',
                'nombre' => 'COLEGIO DE FISIOTERAPEUTAS-COLFYKB',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-02 04:57:07',
                'updated_at' => '2021-06-02 04:57:07',
                'deleted_at' => NULL,
            ),
            274 => 
            array (
                'id' => 275,
                'sigla' => 'FRONTERA',
                'nombre' => 'COMUNI, CAMP. -LA FRONTERA DEL MUNIC  DE  SAN ANDRES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-02 07:02:23',
                'updated_at' => '2021-06-02 07:02:23',
                'deleted_at' => NULL,
            ),
            275 => 
            array (
                'id' => 276,
                'sigla' => 'AGUA   ELY',
                'nombre' => 'EMPRESA  AGUA  ELY',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-02 07:24:40',
                'updated_at' => '2021-06-02 07:24:40',
                'deleted_at' => NULL,
            ),
            276 => 
            array (
                'id' => 277,
                'sigla' => 'DEPARTAMENTAL ',
                'nombre' => 'CENTRAL OBRERA DEPARTAMENTAL DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-02 12:36:30',
                'updated_at' => '2021-06-02 12:36:30',
                'deleted_at' => NULL,
            ),
            277 => 
            array (
                'id' => 278,
                'sigla' => 'VECINAL',
                'nombre' => 'DISTRITO  8 VECINAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-02 14:03:53',
                'updated_at' => '2021-06-02 14:03:53',
                'deleted_at' => NULL,
            ),
            278 => 
            array (
                'id' => 279,
                'sigla' => 'SENARECOM',
                'nombre' => 'SENARECOM  -LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-02 14:06:05',
                'updated_at' => '2021-06-02 14:06:05',
                'deleted_at' => NULL,
            ),
            279 => 
            array (
                'id' => 280,
                'sigla' => 'PUBLICA',
                'nombre' => 'MINISTERIO  DE ECONOMIA Y FINANZA  PUBLICA -LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-02 14:30:35',
                'updated_at' => '2021-06-02 14:30:35',
                'deleted_at' => NULL,
            ),
            280 => 
            array (
                'id' => 281,
                'sigla' => 'LA  PAZ ',
                'nombre' => ' CAMARA  DE DIPUTADO  -LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 04:55:40',
                'updated_at' => '2021-06-04 04:55:40',
                'deleted_at' => NULL,
            ),
            281 => 
            array (
                'id' => 282,
                'sigla' => ' AFP',
                'nombre' => 'A F P- FUTURO  DE BOLIVIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 05:40:51',
                'updated_at' => '2021-06-04 05:40:51',
                'deleted_at' => NULL,
            ),
            282 => 
            array (
                'id' => 283,
                'sigla' => 'BELLA VISTA',
                'nombre' => ' SUB CENTRAL IND. BELLA SELVA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 06:06:17',
                'updated_at' => '2021-06-04 06:06:17',
                'deleted_at' => NULL,
            ),
            283 => 
            array (
                'id' => 284,
                'sigla' => 'RAQUET  ',
                'nombre' => 'CENTRO DE AISLAMIENTO INT,COVID-19  -RAQUET  PATUJU',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 08:20:48',
                'updated_at' => '2021-06-04 08:20:48',
                'deleted_at' => NULL,
            ),
            284 => 
            array (
                'id' => 285,
                'sigla' => 'BELLA  VISTA  ',
                'nombre' => 'CENTRO  DE SALUD  BELLA   VISTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 09:38:41',
                'updated_at' => '2021-06-04 09:42:44',
                'deleted_at' => NULL,
            ),
            285 => 
            array (
                'id' => 286,
                'sigla' => 'ISABEL',
                'nombre' => 'COMUNIDAD AGROPECUARIA -- ISABEL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 09:40:35',
                'updated_at' => '2021-06-04 09:40:35',
                'deleted_at' => NULL,
            ),
            286 => 
            array (
                'id' => 287,
                'sigla' => 'TIQUIN',
                'nombre' => 'FERIA  AGROPECUARIA  GANADERA  EXPO  TIQUIN-BAURE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 10:45:25',
                'updated_at' => '2021-06-04 10:45:25',
                'deleted_at' => NULL,
            ),
            287 => 
            array (
                'id' => 288,
                'sigla' => 'EL CARMEN ',
                'nombre' => 'JUNTA VECINAL  EL CARMEN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 10:46:18',
                'updated_at' => '2021-06-04 10:46:18',
                'deleted_at' => NULL,
            ),
            288 => 
            array (
                'id' => 289,
                'sigla' => 'HUACARAJE  ',
                'nombre' => 'GOBIERNO  AUTONOMO  MUNICIPAL DE HUACARAJE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 11:02:34',
                'updated_at' => '2021-06-04 11:02:34',
                'deleted_at' => NULL,
            ),
            289 => 
            array (
                'id' => 290,
                'sigla' => 'A.B.T.',
                'nombre' => 'A.B.T. -TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 13:17:11',
                'updated_at' => '2021-06-04 13:17:47',
                'deleted_at' => NULL,
            ),
            290 => 
            array (
                'id' => 291,
                'sigla' => 'PAZ',
                'nombre' => 'A.B.C -LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 13:39:00',
                'updated_at' => '2021-06-04 13:39:00',
                'deleted_at' => NULL,
            ),
            291 => 
            array (
                'id' => 292,
                'sigla' => 'CIVIL',
                'nombre' => 'MINISTERIO  DE  DEFENSA  CIVIL   - LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-04 13:48:39',
                'updated_at' => '2021-06-04 13:53:38',
                'deleted_at' => NULL,
            ),
            292 => 
            array (
                'id' => 293,
                'sigla' => 'BOV.',
                'nombre' => 'BOMBERO  VOLUNTARIO-TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 07:28:52',
                'updated_at' => '2021-06-07 07:28:52',
                'deleted_at' => NULL,
            ),
            293 => 
            array (
                'id' => 294,
                'sigla' => 'PROV  MOXOS',
                'nombre' => 'MUNICIPIO  DE SAN IGNACIO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 07:30:04',
                'updated_at' => '2021-06-07 07:30:04',
                'deleted_at' => NULL,
            ),
            294 => 
            array (
                'id' => 295,
                'sigla' => 'SALUD  Y DEPORTE',
                'nombre' => 'MINISTERIO  DE SALUD   Y DEPORTE  - LA PAZ COURRIER',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 07:31:40',
                'updated_at' => '2021-06-07 07:32:13',
                'deleted_at' => NULL,
            ),
            295 => 
            array (
                'id' => 296,
                'sigla' => 'FEBEPDI- BENI',
                'nombre' => 'FEDERACION  BENIANA  DISCAPACIDAD -FEBEPDI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 07:34:23',
                'updated_at' => '2021-06-07 08:34:49',
                'deleted_at' => NULL,
            ),
            296 => 
            array (
                'id' => 297,
                'sigla' => 'MOXOS',
                'nombre' => 'GOBIERNO AUTONOMO  MUNICIPAL  DE SAN IGNACIO  DE MOXOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 08:23:07',
                'updated_at' => '2021-06-07 08:23:07',
                'deleted_at' => NULL,
            ),
            297 => 
            array (
                'id' => 298,
                'sigla' => 'SAN JULIAN ',
                'nombre' => 'GOBIERNO  AUTONOMO MUNIC , -SAN JULIAN  -SANTA  CRUZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 11:03:11',
                'updated_at' => '2021-06-07 11:03:11',
                'deleted_at' => NULL,
            ),
            298 => 
            array (
                'id' => 299,
                'sigla' => 'BALLIVIAN .',
                'nombre' => 'CCORREGIMIENTO  DE SANTA ROSA   - PROV BALLIVIAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 11:20:08',
                'updated_at' => '2021-06-07 11:20:08',
                'deleted_at' => NULL,
            ),
            299 => 
            array (
                'id' => 300,
                'sigla' => 'SECCION ',
                'nombre' => 'CORREGIMIENTO DE LA SECCION MUNIC, DE RIBERALTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 11:32:13',
                'updated_at' => '2021-06-07 11:34:05',
                'deleted_at' => NULL,
            ),
            300 => 
            array (
                'id' => 301,
                'sigla' => 'MUNICIPIO',
                'nombre' => 'CORREGIMIENTO  MUNIC, TRINIDAD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 12:00:44',
                'updated_at' => '2021-06-07 12:00:44',
                'deleted_at' => NULL,
            ),
            301 => 
            array (
                'id' => 302,
                'sigla' => 'YATA',
                'nombre' => 'COMUNIDAD AGRARIA CAMPESINA  "ROSARIO DEL YATA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 13:03:20',
                'updated_at' => '2021-06-07 13:03:20',
                'deleted_at' => NULL,
            ),
            302 => 
            array (
                'id' => 303,
                'sigla' => 'CACAO',
                'nombre' => 'ASOCIACION  BENIANA  DE PROD, EL CACAO DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 13:06:10',
                'updated_at' => '2021-06-07 13:06:10',
                'deleted_at' => NULL,
            ),
            303 => 
            array (
                'id' => 304,
                'sigla' => 'BANZER SUAREZ',
                'nombre' => 'HOSPITAL  MUNICIPAL  " HUGO BANZER  SUAREZ  - BAURES"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 13:08:37',
                'updated_at' => '2021-06-07 13:08:37',
                'deleted_at' => NULL,
            ),
            304 => 
            array (
                'id' => 305,
                'sigla' => 'SANGRE',
                'nombre' => 'BANCO  DE SANGRE  DPTAL  DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 13:10:06',
                'updated_at' => '2021-06-07 13:10:06',
                'deleted_at' => NULL,
            ),
            305 => 
            array (
                'id' => 306,
                'sigla' => 'CULTURA',
                'nombre' => 'ARTE  Y CULTURA.',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 13:36:48',
                'updated_at' => '2021-06-07 13:36:48',
                'deleted_at' => NULL,
            ),
            306 => 
            array (
                'id' => 307,
                'sigla' => 'SENADORES',
                'nombre' => 'CAMARA  DE SENADORES  -LA PAZ  ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-07 14:04:05',
                'updated_at' => '2021-06-07 14:04:05',
                'deleted_at' => NULL,
            ),
            307 => 
            array (
                'id' => 308,
                'sigla' => 'DISTRITO  N° 2',
                'nombre' => 'JUNTA VECINALES   DISTRITO N°2',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-08 06:35:19',
                'updated_at' => '2021-06-08 06:35:19',
                'deleted_at' => NULL,
            ),
            308 => 
            array (
                'id' => 309,
                'sigla' => 'BAURES',
                'nombre' => 'GOBIERNO AUTONOMO MUNICIPAL DE BAURES ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-08 07:45:36',
                'updated_at' => '2021-06-08 07:45:36',
                'deleted_at' => NULL,
            ),
            309 => 
            array (
                'id' => 310,
                'sigla' => 'FE',
                'nombre' => 'NOTARIA  DE FE PUBLICA N°4 -TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-08 09:55:40',
                'updated_at' => '2021-06-08 09:56:10',
                'deleted_at' => NULL,
            ),
            310 => 
            array (
                'id' => 311,
                'sigla' => 'INFOCAL',
                'nombre' => 'FUNDACION  INFOCAL  - BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-08 11:07:30',
                'updated_at' => '2021-06-08 11:07:30',
                'deleted_at' => NULL,
            ),
            311 => 
            array (
                'id' => 312,
                'sigla' => 'CPIB ',
                'nombre' => 'CENTRAL DE PUEBLO INDIGENA  DEL BENI CPIB-ORGANICA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-08 11:57:46',
                'updated_at' => '2021-06-08 11:57:46',
                'deleted_at' => NULL,
            ),
            312 => 
            array (
                'id' => 313,
                'sigla' => 'FLORIDA ',
                'nombre' => 'COMUNIDAD  LA FLORIDA  LOS NEGRO-PROV  CERCADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-09 11:24:59',
                'updated_at' => '2021-06-09 11:24:59',
                'deleted_at' => NULL,
            ),
            313 => 
            array (
                'id' => 314,
                'sigla' => 'CONSEJO',
                'nombre' => 'COMUNIDAD IND,- "GRAN CONSEJO TSIMANE "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-09 11:28:17',
                'updated_at' => '2021-06-09 11:28:17',
                'deleted_at' => NULL,
            ),
            314 => 
            array (
                'id' => 315,
                'sigla' => 'H',
                'nombre' => ' H .ASAMBLEA LEGISLATIVA  DEPARTAMENTAL   DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-09 11:29:45',
                'updated_at' => '2021-06-09 11:30:09',
                'deleted_at' => NULL,
            ),
            315 => 
            array (
                'id' => 316,
                'sigla' => 'COCIPOBOL',
                'nombre' => 'COMITE  CIVICO POPULAR DE BOLIVIA- TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-09 11:31:14',
                'updated_at' => '2021-06-09 11:31:14',
                'deleted_at' => NULL,
            ),
            316 => 
            array (
                'id' => 317,
                'sigla' => 'LAS AMAZONAS',
                'nombre' => 'CLUB DE LEONAS "LAS AMAZONAS" /RIBERALTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-10 05:19:57',
                'updated_at' => '2021-06-10 05:19:57',
                'deleted_at' => NULL,
            ),
            317 => 
            array (
                'id' => 318,
                'sigla' => 'PRO.',
                'nombre' => 'PROVIVIENDA - SANTA CRUZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-10 06:05:46',
                'updated_at' => '2021-06-10 06:05:46',
                'deleted_at' => NULL,
            ),
            318 => 
            array (
                'id' => 319,
                'sigla' => 'FPS',
                'nombre' => 'FONDO NACIONAL DE INVERSION  PRODUCTIVO . FPS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-10 06:08:10',
                'updated_at' => '2021-06-10 06:08:10',
                'deleted_at' => NULL,
            ),
            319 => 
            array (
                'id' => 320,
                'sigla' => 'A',
                'nombre' => 'A FP FUTURO  DE BOLIVIA  -BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-10 06:09:45',
                'updated_at' => '2021-06-10 06:09:45',
                'deleted_at' => NULL,
            ),
            320 => 
            array (
                'id' => 321,
                'sigla' => 'F',
                'nombre' => 'AFP  -PREVISION ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-10 06:10:43',
                'updated_at' => '2021-06-10 06:10:43',
                'deleted_at' => NULL,
            ),
            321 => 
            array (
                'id' => 322,
                'sigla' => 'OASIS',
                'nombre' => 'ESTACION DE SERVICIOS "EL OASIS"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-10 08:27:05',
                'updated_at' => '2021-06-10 08:27:05',
                'deleted_at' => NULL,
            ),
            322 => 
            array (
                'id' => 323,
                'sigla' => 'SENASAG',
                'nombre' => 'SENASAG/BENI/JDBE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-10 08:37:37',
                'updated_at' => '2021-06-10 08:37:37',
                'deleted_at' => NULL,
            ),
            323 => 
            array (
                'id' => 324,
                'sigla' => '"ISRAEL "',
                'nombre' => 'COMUNIDAD AGROPECUARIA -"ISRAEL PROV, MARBAN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-10 11:14:16',
                'updated_at' => '2021-06-10 11:14:16',
                'deleted_at' => NULL,
            ),
            324 => 
            array (
                'id' => 325,
                'sigla' => 'SNPE',
                'nombre' => 'SERVICIO NACIONAL  DE  PATRIMONIO DEL ESTADO -LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-10 14:16:10',
                'updated_at' => '2021-06-10 14:16:10',
                'deleted_at' => NULL,
            ),
            325 => 
            array (
                'id' => 326,
                'sigla' => 'BURS\'SH\' CANCHI',
                'nombre' => 'INSTITUTO DE LENGUA Y CULTURA DE LA NACION TSIMANE\'',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 05:06:30',
                'updated_at' => '2021-06-11 05:06:30',
                'deleted_at' => NULL,
            ),
            326 => 
            array (
                'id' => 327,
                'sigla' => 'S.R.L.',
                'nombre' => 'LA PALABRA  DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 05:10:58',
                'updated_at' => '2021-06-11 05:10:58',
                'deleted_at' => NULL,
            ),
            327 => 
            array (
                'id' => 328,
                'sigla' => 'BIOMEDICAL',
                'nombre' => 'BIOMEDICAL INTERNACIONAL "COCHABAMBA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 05:43:03',
                'updated_at' => '2021-06-11 08:02:02',
                'deleted_at' => NULL,
            ),
            328 => 
            array (
                'id' => 329,
                'sigla' => 'FUERZAS UNIDAS ',
                'nombre' => 'ORGANIZACION FUERZAS UNIDAS ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 06:21:54',
                'updated_at' => '2021-06-11 06:21:54',
                'deleted_at' => NULL,
            ),
            329 => 
            array (
                'id' => 330,
                'sigla' => 'RR.PP',
                'nombre' => 'COMANDO  GENERAL  DEL  EJERCITO -SEXTA  DIVISION DEL BENI ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 06:22:34',
                'updated_at' => '2021-06-11 06:22:34',
                'deleted_at' => NULL,
            ),
            330 => 
            array (
                'id' => 331,
                'sigla' => 'BALLIVIAN ',
                'nombre' => 'ASOCIACION  DE PORODUCTORES "PUERTO  BALLIVIAN "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 06:25:48',
                'updated_at' => '2021-06-11 06:25:48',
                'deleted_at' => NULL,
            ),
            331 => 
            array (
                'id' => 332,
                'sigla' => ' TRADICIONALES',
                'nombre' => 'ASOCIACION DE MEDICOS TRADICIONALES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 07:00:35',
                'updated_at' => '2021-06-11 07:00:35',
                'deleted_at' => NULL,
            ),
            332 => 
            array (
                'id' => 333,
                'sigla' => 'MAGDALENA',
                'nombre' => 'HONORABLE CONSEJO MUNICIPAL DE "MAGDALENA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 07:38:20',
                'updated_at' => '2021-06-11 08:01:39',
                'deleted_at' => NULL,
            ),
            333 => 
            array (
                'id' => 334,
                'sigla' => 'NO VIDENTES',
                'nombre' => 'ASOCIACION DE NO VIDENTES "SAN BORJA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 08:01:13',
                'updated_at' => '2021-06-11 08:01:13',
                'deleted_at' => NULL,
            ),
            334 => 
            array (
                'id' => 335,
                'sigla' => 'CAMINO AL CIELO',
                'nombre' => 'CONGREGACION "JESUS CAMINO AL CIELO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 08:07:48',
                'updated_at' => '2021-06-11 08:07:48',
                'deleted_at' => NULL,
            ),
            335 => 
            array (
                'id' => 336,
                'sigla' => 'LORETO',
                'nombre' => 'CORREGIMIENTO MUNICIPIO "LORETO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 08:39:00',
                'updated_at' => '2021-06-11 08:39:00',
                'deleted_at' => NULL,
            ),
            336 => 
            array (
                'id' => 337,
                'sigla' => 'REGIONAL',
                'nombre' => 'OFICINA  REGIONAL  DE LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-11 14:24:57',
                'updated_at' => '2021-06-11 14:24:57',
                'deleted_at' => NULL,
            ),
            337 => 
            array (
                'id' => 338,
                'sigla' => 'CROWN',
                'nombre' => 'CROWN LTDA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-14 07:03:13',
                'updated_at' => '2021-06-14 07:03:13',
                'deleted_at' => NULL,
            ),
            338 => 
            array (
                'id' => 339,
                'sigla' => 'INES',
                'nombre' => 'URBANIZACION SANTA  INES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-14 11:02:06',
                'updated_at' => '2021-06-14 11:02:06',
                'deleted_at' => NULL,
            ),
            339 => 
            array (
                'id' => 340,
                'sigla' => '18',
                'nombre' => 'FEDERACION TRANSPORTISTA  DEL BENI  -18 DE NOVIEMBRE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-14 12:13:20',
                'updated_at' => '2021-06-14 12:13:20',
                'deleted_at' => NULL,
            ),
            340 => 
            array (
                'id' => 341,
                'sigla' => 'O.S.C',
                'nombre' => 'ORG ,SANGRE COMBATIVA - JR -UNIDA  POR  EL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-14 12:17:27',
                'updated_at' => '2021-06-14 12:17:27',
                'deleted_at' => NULL,
            ),
            341 => 
            array (
                'id' => 342,
                'sigla' => 'R',
                'nombre' => 'PROVEEDORA  RODRIGUEZ &  HNOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-15 05:55:13',
                'updated_at' => '2021-06-15 05:55:13',
                'deleted_at' => NULL,
            ),
            342 => 
            array (
                'id' => 343,
                'sigla' => 'ALBORADA',
                'nombre' => 'JUNTA VECINAL "ALBORADA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-15 06:14:25',
                'updated_at' => '2021-06-15 06:14:25',
                'deleted_at' => NULL,
            ),
            343 => 
            array (
                'id' => 344,
                'sigla' => 'CPEM-B',
                'nombre' => 'CENTRAL DE PUEBLOS ETNICOS MOJEÑOS DEL BENI CPEM-B',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-15 06:18:58',
                'updated_at' => '2021-06-15 06:18:58',
                'deleted_at' => NULL,
            ),
            344 => 
            array (
                'id' => 345,
                'sigla' => 'BELLA',
                'nombre' => 'INSTITUCIONES  DEL PUEBLO  DE BELLA  VISTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-15 09:40:53',
                'updated_at' => '2021-06-15 09:40:53',
                'deleted_at' => NULL,
            ),
            345 => 
            array (
                'id' => 346,
                'sigla' => 'EP',
                'nombre' => 'EMPRESA DE ENERGIA  ELECTRICA  Y PETROLERA -LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-15 12:37:50',
                'updated_at' => '2021-06-15 12:37:50',
                'deleted_at' => NULL,
            ),
            346 => 
            array (
                'id' => 347,
                'sigla' => 'REYES',
                'nombre' => 'SINDICATO MIXTO TRANS "REYES"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-16 05:05:21',
                'updated_at' => '2021-06-16 05:05:21',
                'deleted_at' => NULL,
            ),
            347 => 
            array (
                'id' => 348,
                'sigla' => 'PGE',
                'nombre' => 'PROCURADORIA  GENEAL  DEL ESTADO- DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-16 09:05:35',
                'updated_at' => '2021-06-16 09:05:35',
                'deleted_at' => NULL,
            ),
            348 => 
            array (
                'id' => 349,
                'sigla' => 'M.T.S.',
                'nombre' => 'MOVIMINTO   TERCER  SISTEMA  -M.T.S.- BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-16 10:07:59',
                'updated_at' => '2021-06-16 10:07:59',
                'deleted_at' => NULL,
            ),
            349 => 
            array (
                'id' => 350,
                'sigla' => 'P.N.U.D.',
            'nombre' => 'AMERICA  LATINA  Y EL CARIBE - (IRDR )  -COURRIER',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-16 12:28:28',
                'updated_at' => '2021-06-16 12:28:28',
                'deleted_at' => NULL,
            ),
            350 => 
            array (
                'id' => 351,
                'sigla' => 'C.S',
                'nombre' => 'BRIGADA  PARLAMENTARIA   DEL  BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-17 05:27:39',
                'updated_at' => '2021-06-17 05:27:39',
                'deleted_at' => NULL,
            ),
            351 => 
            array (
                'id' => 352,
                'sigla' => 'GAMR',
                'nombre' => 'GOBIERNO  AUTONOMO  MUNICIPAL    DE  "PUERTO RURRENABAQUE"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-17 05:37:17',
                'updated_at' => '2021-06-17 05:37:17',
                'deleted_at' => NULL,
            ),
            352 => 
            array (
                'id' => 353,
                'sigla' => 'MUREJ',
                'nombre' => 'TRIBUNAL  DEPARTAMENTAL    DE JUSTICIA   DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-17 07:25:59',
                'updated_at' => '2021-06-17 07:25:59',
                'deleted_at' => NULL,
            ),
            353 => 
            array (
                'id' => 354,
                'sigla' => 'RED',
                'nombre' => 'MINISTERIO  DE SALUD -SEDES  BENI  07  RIBERALTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-17 07:37:34',
                'updated_at' => '2021-06-17 07:37:34',
                'deleted_at' => NULL,
            ),
            354 => 
            array (
                'id' => 355,
                'sigla' => 'SL',
                'nombre' => 'SABALITO  TRINIDAD.',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-17 09:46:12',
                'updated_at' => '2021-06-17 09:46:12',
                'deleted_at' => NULL,
            ),
            355 => 
            array (
                'id' => 356,
                'sigla' => 'F.S.U.T.C.B.',
                'nombre' => 'SINDICATO  "27  DE MAYO " -TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-17 10:26:53',
                'updated_at' => '2021-06-17 10:26:53',
                'deleted_at' => NULL,
            ),
            356 => 
            array (
                'id' => 357,
                'sigla' => 'O.D.A',
                'nombre' => 'LOTERIA    NACIONAL  DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-17 10:33:08',
                'updated_at' => '2021-06-17 10:33:08',
                'deleted_at' => NULL,
            ),
            357 => 
            array (
                'id' => 358,
                'sigla' => 'A.I',
            'nombre' => '"FUNDACION  AYUDA  INTEGRAL AL NECESITADOS (A.I.N.) "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-17 12:09:39',
                'updated_at' => '2021-06-17 12:09:39',
                'deleted_at' => NULL,
            ),
            358 => 
            array (
                'id' => 359,
                'sigla' => 'CAMARA DE SENADORES',
                'nombre' => 'ASAMBLEA LEGISLATIVA PLURINACIONAL DE BOLIVIA CAMARA DE SENADORES ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-18 04:44:34',
                'updated_at' => '2021-06-18 04:44:34',
                'deleted_at' => NULL,
            ),
            359 => 
            array (
                'id' => 360,
                'sigla' => 'SAP . GP',
                'nombre' => 'ASESORAMIENTO Y CONSULTORIA "SAP . GP"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-18 04:50:22',
                'updated_at' => '2021-06-18 04:52:49',
                'deleted_at' => NULL,
            ),
            360 => 
            array (
                'id' => 361,
                'sigla' => 'SEDES-BENI',
                'nombre' => 'SERVICIO DEPARTAMENTAL DE SALUD BENI "SEDES-BENI"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-18 06:13:38',
                'updated_at' => '2021-06-18 06:13:38',
                'deleted_at' => NULL,
            ),
            361 => 
            array (
                'id' => 362,
                'sigla' => 'AMS',
                'nombre' => 'ALL MEDICAL SOLUTIONS.LLC',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-18 06:22:45',
                'updated_at' => '2021-06-18 06:22:45',
                'deleted_at' => NULL,
            ),
            362 => 
            array (
                'id' => 363,
                'sigla' => 'JOSE BALLIVIAN ',
                'nombre' => 'CORREGIMIENTO TERRITORIAL DE REYES CAPITAL PROV.JOSE BALLIVIAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-18 06:57:27',
                'updated_at' => '2021-06-18 06:57:27',
                'deleted_at' => NULL,
            ),
            363 => 
            array (
                'id' => 364,
                'sigla' => 'SINDICAL',
                'nombre' => 'CENTRAL SINDICAL UNICA DE TRABAJADORES CAMPESINOS DE LA PROVINCIA DE LA PROVINCIA MARBAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-18 08:28:34',
                'updated_at' => '2021-06-18 08:29:27',
                'deleted_at' => NULL,
            ),
            364 => 
            array (
                'id' => 365,
                'sigla' => 'CHINANE',
                'nombre' => 'SUB CENTRAL  DE PUEBLOS INDIGENAS  MOJEÑO  YURACARE-CHIMANE -TIPNIS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-18 13:31:31',
                'updated_at' => '2021-06-18 13:31:31',
                'deleted_at' => NULL,
            ),
            365 => 
            array (
                'id' => 366,
                'sigla' => 'EXI',
                'nombre' => 'ASOCIACION AGROPECUARIA  INDUSTRIAL  "EL EXITO "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-18 13:39:11',
                'updated_at' => '2021-06-18 13:39:11',
                'deleted_at' => NULL,
            ),
            366 => 
            array (
                'id' => 367,
                'sigla' => 'FEDIMA',
                'nombre' => 'FEDIMA S.R.L',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-22 04:47:40',
                'updated_at' => '2021-06-22 04:47:40',
                'deleted_at' => NULL,
            ),
            367 => 
            array (
                'id' => 368,
                'sigla' => 'AREAS PROTEGIDAS',
                'nombre' => 'BIODIVERSIDAD Y AREAS PROTEGIDAS ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-22 05:04:44',
                'updated_at' => '2021-06-22 05:08:00',
                'deleted_at' => NULL,
            ),
            368 => 
            array (
                'id' => 369,
                'sigla' => 'IMPUESTOS',
                'nombre' => 'IMPUESTOS NACIONALES/LA PAZ ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-22 05:21:39',
                'updated_at' => '2021-06-22 05:21:39',
                'deleted_at' => NULL,
            ),
            369 => 
            array (
                'id' => 370,
                'sigla' => 'SINDICATO',
                'nombre' => 'SINDICATO DE TRANSPORTE RAPIDO MOVIMA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-22 05:55:03',
                'updated_at' => '2021-06-22 05:55:03',
                'deleted_at' => NULL,
            ),
            370 => 
            array (
                'id' => 371,
                'sigla' => 'V-I.S',
                'nombre' => 'JUNTA  SANTA INES ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-22 09:47:40',
                'updated_at' => '2021-06-22 09:47:40',
                'deleted_at' => NULL,
            ),
            371 => 
            array (
                'id' => 372,
                'sigla' => 'SDD',
                'nombre' => 'SEDEGES -BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-22 09:54:19',
                'updated_at' => '2021-06-22 09:54:19',
                'deleted_at' => NULL,
            ),
            372 => 
            array (
                'id' => 373,
                'sigla' => 'SNMH',
                'nombre' => 'SERVICIO NACIONAL  DE METEOROLOGIA -E HIDROLOGIA .-LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-22 10:03:18',
                'updated_at' => '2021-06-22 10:03:18',
                'deleted_at' => NULL,
            ),
            373 => 
            array (
                'id' => 374,
                'sigla' => 'AMET',
                'nombre' => 'ASOCIACION  DE MEDICO NATURISTA  TRADICIONALES- PROV  ,CERCADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-22 12:43:38',
                'updated_at' => '2021-06-22 12:43:38',
                'deleted_at' => NULL,
            ),
            374 => 
            array (
                'id' => 375,
                'sigla' => 'AR',
                'nombre' => 'IMPORTACIONES  AR- TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-22 13:30:45',
                'updated_at' => '2021-06-22 13:30:45',
                'deleted_at' => NULL,
            ),
            375 => 
            array (
                'id' => 376,
                'sigla' => 'FIS',
                'nombre' => 'FISCALIA GENERAL DEL ESTADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-23 05:25:43',
                'updated_at' => '2021-06-23 05:25:43',
                'deleted_at' => NULL,
            ),
            376 => 
            array (
                'id' => 377,
                'sigla' => 'HOGAR',
                'nombre' => 'HOGAR DE ANCIANOS SAGRADO CORAZON DE JESUS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-23 06:24:33',
                'updated_at' => '2021-06-23 06:24:33',
                'deleted_at' => NULL,
            ),
            377 => 
            array (
                'id' => 378,
                'sigla' => 'LBC',
                'nombre' => 'SEGUROS "LBC"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-23 06:32:34',
                'updated_at' => '2021-06-23 06:32:34',
                'deleted_at' => NULL,
            ),
            378 => 
            array (
                'id' => 379,
                'sigla' => 'JCEA',
                'nombre' => 'CONSTRUCCIONES Y SERVICIOS "JCEA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-23 07:21:33',
                'updated_at' => '2021-06-23 07:21:33',
                'deleted_at' => NULL,
            ),
            379 => 
            array (
                'id' => 380,
                'sigla' => 'UNI',
                'nombre' => 'UNIVERSIDAD PRIVADA DOMINGO SAVIO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-23 10:12:19',
                'updated_at' => '2021-06-23 10:12:19',
                'deleted_at' => NULL,
            ),
            380 => 
            array (
                'id' => 381,
                'sigla' => 'YUATRE',
                'nombre' => 'EMPRESA DE SERVICIO  "YUATRE"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-24 06:28:29',
                'updated_at' => '2021-06-24 06:28:29',
                'deleted_at' => NULL,
            ),
            381 => 
            array (
                'id' => 382,
                'sigla' => 'SU',
                'nombre' => 'MUNICIPIO  DE  BAURE  -SUB  ALCALDIA  - DE REMANZO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-24 10:26:28',
                'updated_at' => '2021-06-24 10:26:28',
                'deleted_at' => NULL,
            ),
            382 => 
            array (
                'id' => 383,
                'sigla' => 'IVA',
                'nombre' => 'BANCO  CENTRAL  DE BOLIVIA  - LA PAZ  -COURRIER',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-25 06:52:49',
                'updated_at' => '2021-06-25 06:52:49',
                'deleted_at' => NULL,
            ),
            383 => 
            array (
                'id' => 384,
                'sigla' => 'CENTRO ',
                'nombre' => 'CENTRO DE SALUD INTEGRAL "DR.HNNRRY  K.BEYE"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-25 08:23:09',
                'updated_at' => '2021-06-25 08:23:09',
                'deleted_at' => NULL,
            ),
            384 => 
            array (
                'id' => 385,
                'sigla' => 'RAD',
                'nombre' => 'RADIO PATUJU',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-25 09:05:57',
                'updated_at' => '2021-06-25 09:05:57',
                'deleted_at' => NULL,
            ),
            385 => 
            array (
                'id' => 386,
                'sigla' => 'LCH',
                'nombre' => 'ASOCIACION PRODUCTORES  DE LECHE -SAN IGNACIO  DE MOXOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-25 10:42:09',
                'updated_at' => '2021-06-25 10:42:09',
                'deleted_at' => NULL,
            ),
            386 => 
            array (
                'id' => 387,
                'sigla' => 'INSTITUTO ',
                'nombre' => 'INSTITUTO AMERICANO TRINIDAD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-25 10:47:21',
                'updated_at' => '2021-06-25 10:47:21',
                'deleted_at' => NULL,
            ),
            387 => 
            array (
                'id' => 388,
                'sigla' => 'TIP',
                'nombre' => 'SUB CENTRAL DE PUEBLOS INDIGENAS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-25 11:32:26',
                'updated_at' => '2021-06-25 11:32:26',
                'deleted_at' => NULL,
            ),
            388 => 
            array (
                'id' => 389,
                'sigla' => 'LLR. GG',
                'nombre' => 'FABOCE   -COCHABAMBA.',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-28 07:13:07',
                'updated_at' => '2021-06-28 07:13:07',
                'deleted_at' => NULL,
            ),
            389 => 
            array (
                'id' => 390,
                'sigla' => 'AMAZONICO',
                'nombre' => 'POLICIA BOLIVIANA COMANDO POLICIAL AMAZONICO/RIBERALTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-28 07:38:26',
                'updated_at' => '2021-06-28 07:38:26',
                'deleted_at' => NULL,
            ),
            390 => 
            array (
                'id' => 391,
                'sigla' => 'SBG',
                'nombre' => 'SUB GOBERNACION  PROV , BALLIVIAN -REYES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-28 08:33:52',
                'updated_at' => '2021-06-28 08:33:52',
                'deleted_at' => NULL,
            ),
            391 => 
            array (
                'id' => 392,
                'sigla' => 'ENLACE',
                'nombre' => 'ENLACE LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-29 05:21:33',
                'updated_at' => '2021-06-29 05:21:33',
                'deleted_at' => NULL,
            ),
            392 => 
            array (
                'id' => 393,
                'sigla' => 'SS',
                'nombre' => 'SUB CENTRAL  15  DE  DICIEMBRE - PROV  MARBAN   BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-29 08:02:25',
                'updated_at' => '2021-06-29 08:02:25',
                'deleted_at' => NULL,
            ),
            393 => 
            array (
                'id' => 394,
                'sigla' => 'AM',
                'nombre' => 'ARMADA  BOLIVIANA   -SEGUNDO  DISTRITO  NAVAL  - MAMORE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-29 10:38:57',
                'updated_at' => '2021-06-29 10:38:57',
                'deleted_at' => NULL,
            ),
            394 => 
            array (
                'id' => 395,
                'sigla' => 'MT',
                'nombre' => 'ASOCIACION DE MOTO TAXI - TERMINAL  DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-29 10:52:56',
                'updated_at' => '2021-06-29 11:14:01',
                'deleted_at' => NULL,
            ),
            395 => 
            array (
                'id' => 396,
                'sigla' => 'AGASAR',
                'nombre' => 'ASOCIACION DE GANADEROS DE SAN RAMON',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-30 06:46:02',
                'updated_at' => '2021-06-30 06:46:02',
                'deleted_at' => NULL,
            ),
            396 => 
            array (
                'id' => 397,
                'sigla' => 'PUE',
                'nombre' => 'ASOCIACION  DE PRODUCTORES  AGROPECUARIOS   "PUERTO  BALLIVIAN  "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-30 06:49:52',
                'updated_at' => '2021-06-30 06:52:54',
                'deleted_at' => NULL,
            ),
            397 => 
            array (
                'id' => 398,
                'sigla' => 'GK',
                'nombre' => 'AGENCIAS DE MODELOS "GK"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-30 07:14:10',
                'updated_at' => '2021-06-30 07:14:10',
                'deleted_at' => NULL,
            ),
            398 => 
            array (
                'id' => 399,
                'sigla' => 'ASAMBLEA',
                'nombre' => 'ASAMBLEA DE DIOS BOLIVIANA /CASARABE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-30 07:47:20',
                'updated_at' => '2021-06-30 07:47:20',
                'deleted_at' => NULL,
            ),
            399 => 
            array (
                'id' => 400,
                'sigla' => 'C.N MG B',
                'nombre' => 'CENTRO  NACIONAL   DE MEJORAMIENTO  DE GANADO  BOVINO  DEL BENI -UAB',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-30 09:33:26',
                'updated_at' => '2021-06-30 09:33:26',
                'deleted_at' => NULL,
            ),
            400 => 
            array (
                'id' => 401,
                'sigla' => 'JUD',
                'nombre' => 'COMUNIDAD  CAMPESINA  " CALIFORNIA "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-30 10:38:31',
                'updated_at' => '2021-06-30 10:38:31',
                'deleted_at' => NULL,
            ),
            401 => 
            array (
                'id' => 402,
                'sigla' => 'ANESAPA',
                'nombre' => 'ANESAPA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-06-30 11:20:36',
                'updated_at' => '2021-06-30 11:20:36',
                'deleted_at' => NULL,
            ),
            402 => 
            array (
                'id' => 403,
                'sigla' => 'GBN',
                'nombre' => 'ABC-BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-01 06:13:41',
                'updated_at' => '2021-07-01 06:13:41',
                'deleted_at' => NULL,
            ),
            403 => 
            array (
                'id' => 404,
                'sigla' => 'POL',
                'nombre' => 'POLICIA BOLIVIANA BAT. SEG. FIS. ESTATAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-01 06:45:49',
                'updated_at' => '2021-07-01 06:45:49',
                'deleted_at' => NULL,
            ),
            404 => 
            array (
                'id' => 405,
                'sigla' => 'SUB GOB',
                'nombre' => 'SUBGOBERNACION DE LA PROVINCIA VACA DIEZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-01 11:43:41',
                'updated_at' => '2021-07-01 11:43:41',
                'deleted_at' => NULL,
            ),
            405 => 
            array (
                'id' => 406,
                'sigla' => 'PT',
                'nombre' => 'PUENTE  SAN PABLO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-02 05:33:07',
                'updated_at' => '2021-07-02 05:33:07',
                'deleted_at' => NULL,
            ),
            406 => 
            array (
                'id' => 407,
                'sigla' => 'AGRUPACION',
                'nombre' => 'AGRUPACION CIUDADANA UNIDAD BENIANA INDEPENDIENTE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-02 06:46:57',
                'updated_at' => '2021-07-02 06:46:57',
                'deleted_at' => NULL,
            ),
            407 => 
            array (
                'id' => 408,
                'sigla' => 'CP',
                'nombre' => 'JUNTA   DE VECINOS  " CIPRINO BARACE "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-02 08:55:35',
                'updated_at' => '2021-07-02 08:55:35',
                'deleted_at' => NULL,
            ),
            408 => 
            array (
                'id' => 409,
                'sigla' => 'COMU',
                'nombre' => 'COMUNIDAD PURTO VARADOR',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-02 09:00:49',
                'updated_at' => '2021-07-02 09:00:49',
                'deleted_at' => NULL,
            ),
            409 => 
            array (
                'id' => 410,
                'sigla' => 'JUVENTUDES',
                'nombre' => 'JUVENTUDES BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-05 05:41:18',
                'updated_at' => '2021-07-05 05:41:18',
                'deleted_at' => NULL,
            ),
            410 => 
            array (
                'id' => 411,
                'sigla' => 'AZ',
                'nombre' => 'ASOCIACION  AGROPECUARIA  JIMENEZ  "ASOJIMENEZ "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-05 05:48:58',
                'updated_at' => '2021-07-05 05:48:58',
                'deleted_at' => NULL,
            ),
            411 => 
            array (
                'id' => 412,
                'sigla' => 'SAN PEDRO',
                'nombre' => 'EQUIPO TECNICO DE SAN PEDRO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-05 06:06:14',
                'updated_at' => '2021-07-05 06:06:14',
                'deleted_at' => NULL,
            ),
            412 => 
            array (
                'id' => 413,
                'sigla' => 'FUNDACION ',
                'nombre' => 'FUNDACION AYUDA INTEGRAL AL NECESITADO ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-05 06:44:33',
                'updated_at' => '2021-07-05 06:44:33',
                'deleted_at' => NULL,
            ),
            413 => 
            array (
                'id' => 414,
                'sigla' => 'CONSUL',
                'nombre' => 'CONSULADO GENERAL DEL PERU SANTA CRUZ - BOLIVIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-05 06:47:04',
                'updated_at' => '2021-07-05 06:47:04',
                'deleted_at' => NULL,
            ),
            414 => 
            array (
                'id' => 415,
                'sigla' => 'EXODO',
                'nombre' => 'FUNDACION DE DESARROLLO SOCIAL "EXODO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-05 08:09:39',
                'updated_at' => '2021-07-05 08:09:39',
                'deleted_at' => NULL,
            ),
            415 => 
            array (
                'id' => 416,
                'sigla' => 'GRANDE',
                'nombre' => 'COMUNIDAD EL CARMEN RIO GRANDE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-06 05:57:18',
                'updated_at' => '2021-07-06 05:57:18',
                'deleted_at' => NULL,
            ),
            416 => 
            array (
                'id' => 417,
                'sigla' => 'ASOCERCADO',
                'nombre' => 'ASOCIACION DE GANADEROS DE CERCADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-06 06:05:44',
                'updated_at' => '2021-07-06 06:05:44',
                'deleted_at' => NULL,
            ),
            417 => 
            array (
                'id' => 418,
                'sigla' => 'OKINAWA',
                'nombre' => 'OKINAWA CESPEDES CONSTRUCCIONES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-06 07:17:01',
                'updated_at' => '2021-07-06 07:17:01',
                'deleted_at' => NULL,
            ),
            418 => 
            array (
                'id' => 419,
                'sigla' => 'DPEP',
                'nombre' => 'DESARROLLO GANADERO  Y PECUARIO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-06 09:15:37',
                'updated_at' => '2021-07-06 09:15:37',
                'deleted_at' => NULL,
            ),
            419 => 
            array (
                'id' => 420,
                'sigla' => 'UN',
                'nombre' => 'UNIVERSIDAD DEL VALLE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-06 10:45:42',
                'updated_at' => '2021-07-06 10:45:42',
                'deleted_at' => NULL,
            ),
            420 => 
            array (
                'id' => 421,
                'sigla' => 'SSS',
                'nombre' => '"PUEBLO INDIGENA  SIRIONO "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-06 11:58:30',
                'updated_at' => '2021-07-06 11:58:30',
                'deleted_at' => NULL,
            ),
            421 => 
            array (
                'id' => 422,
                'sigla' => 'SG/E',
                'nombre' => 'COMUNIDAD ANDINA  -"LIMA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-06 12:29:08',
                'updated_at' => '2021-07-06 12:29:08',
                'deleted_at' => NULL,
            ),
            422 => 
            array (
                'id' => 423,
                'sigla' => 'AGETIC',
                'nombre' => 'AGENCIA DE GOBIERNO ELECTRONICO Y TECNOLOGIAS DE INFORMACION Y COMUNICACION -COURRIER',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-07 06:37:35',
                'updated_at' => '2021-07-07 06:40:55',
                'deleted_at' => NULL,
            ),
            423 => 
            array (
                'id' => 424,
                'sigla' => 'TERMINAL',
                'nombre' => 'TERMINAL DE BUSES "VACA MEDRANO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-07 06:46:02',
                'updated_at' => '2021-07-07 06:46:02',
                'deleted_at' => NULL,
            ),
            424 => 
            array (
                'id' => 425,
                'sigla' => 'RED O2',
                'nombre' => 'RED DE SALUD MOXOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-07 06:57:12',
                'updated_at' => '2021-07-07 06:57:12',
                'deleted_at' => NULL,
            ),
            425 => 
            array (
                'id' => 426,
                'sigla' => 'AZUL',
                'nombre' => 'CORREGIMIENTO MONTE AZUL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-07 07:08:49',
                'updated_at' => '2021-07-07 07:08:49',
                'deleted_at' => NULL,
            ),
            426 => 
            array (
                'id' => 427,
                'sigla' => 'CALIXTO',
                'nombre' => 'COMUNIDAD INDIGENA "SAN CALIXTO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-07 07:15:32',
                'updated_at' => '2021-07-07 07:15:32',
                'deleted_at' => NULL,
            ),
            427 => 
            array (
                'id' => 428,
                'sigla' => 'VC',
                'nombre' => 'LIGA MUNICIPAL    DE FUTSAL  -VILLA  VECINAL ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-07 07:36:21',
                'updated_at' => '2021-07-07 07:36:21',
                'deleted_at' => NULL,
            ),
            428 => 
            array (
                'id' => 429,
                'sigla' => 'FFUD',
                'nombre' => 'ASOCIACION   DE COMERCIANTE MINORISTA  "MERCADO MODELO TRINIDAD"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-07 08:16:07',
                'updated_at' => '2021-07-07 08:16:07',
                'deleted_at' => NULL,
            ),
            429 => 
            array (
                'id' => 430,
                'sigla' => 'C.OO',
                'nombre' => 'COOPERATIVA   DE SERVICIO  DE AGUA   POTABLE   - "  COATRI  LTDA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-07 10:25:13',
                'updated_at' => '2021-07-07 10:25:13',
                'deleted_at' => NULL,
            ),
            430 => 
            array (
                'id' => 431,
                'sigla' => 'CESAR',
                'nombre' => 'TALLER DE BATERIAS "CESAR"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-08 06:09:51',
                'updated_at' => '2021-07-08 06:09:51',
                'deleted_at' => NULL,
            ),
            431 => 
            array (
                'id' => 432,
                'sigla' => '1RO DE MAYO',
                'nombre' => 'COMUNIDAD CAMPESINA INTERCULTURAL "1RO DE MAYO" /PROV.MARBAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-08 07:26:19',
                'updated_at' => '2021-07-08 07:32:10',
                'deleted_at' => NULL,
            ),
            432 => 
            array (
                'id' => 433,
                'sigla' => 'IBC',
                'nombre' => 'INSTITUTO   BOLIVIANO  DE LA  SEGUERA   DEL  BENI  -IBC.',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-08 09:06:08',
                'updated_at' => '2021-07-08 09:08:01',
                'deleted_at' => NULL,
            ),
            433 => 
            array (
                'id' => 434,
                'sigla' => 'CCCMM',
                'nombre' => 'COMUNIDAD  CAMPESINA   "SAN LORENZO  DE MARBAN "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-08 09:18:09',
                'updated_at' => '2021-07-08 09:18:09',
                'deleted_at' => NULL,
            ),
            434 => 
            array (
                'id' => 435,
                'sigla' => 'VVST',
                'nombre' => 'ASOCIACION   DE PRODUCTORES   AGROP,  SAN SILVESTRE ,',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-08 09:43:20',
                'updated_at' => '2021-07-08 09:43:20',
                'deleted_at' => NULL,
            ),
            435 => 
            array (
                'id' => 436,
                'sigla' => 'VLL',
                'nombre' => 'JUNTA  VECINAL 27  DE MAYO ,',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-08 10:37:09',
                'updated_at' => '2021-07-08 10:37:09',
                'deleted_at' => NULL,
            ),
            436 => 
            array (
                'id' => 437,
                'sigla' => 'SDCT',
                'nombre' => 'SINDICATO  DE TRANSPORTE  MIXTO  2  DE JULIO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-08 10:40:25',
                'updated_at' => '2021-07-08 10:40:25',
                'deleted_at' => NULL,
            ),
            437 => 
            array (
                'id' => 438,
                'sigla' => 'FNM',
                'nombre' => 'FUNDACION   "NO  ME OLVIDES "  GUAYARAMERIN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-08 11:04:02',
                'updated_at' => '2021-07-08 11:04:02',
                'deleted_at' => NULL,
            ),
            438 => 
            array (
                'id' => 439,
                'sigla' => 'ASSCC',
            'nombre' => 'ASOCIACION   DE MOTOQUEROS   ITONAMA   (ASOMIT)',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-09 05:47:47',
                'updated_at' => '2021-07-09 05:47:47',
                'deleted_at' => NULL,
            ),
            439 => 
            array (
                'id' => 440,
                'sigla' => 'FFFDD',
                'nombre' => 'FEDERACION   REGIONAL   DE MOTOTAXIS DE TRINIDAD Y PROV ,CERCADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-09 06:15:01',
                'updated_at' => '2021-07-09 06:15:01',
                'deleted_at' => NULL,
            ),
            440 => 
            array (
                'id' => 441,
                'sigla' => 'SIT',
                'nombre' => 'SIT PARDO "SONIDO +ILIMINACION"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-09 06:16:24',
                'updated_at' => '2021-07-09 06:16:24',
                'deleted_at' => NULL,
            ),
            441 => 
            array (
                'id' => 442,
                'sigla' => 'FRANCISCO',
                'nombre' => 'CORREGIMIENTO DEL CABILDO INDIGENAL "SAN FRANCISCO DE MOXOS"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-09 07:10:13',
                'updated_at' => '2021-07-09 07:10:13',
                'deleted_at' => NULL,
            ),
            442 => 
            array (
                'id' => 443,
                'sigla' => 'PROGRESO',
                'nombre' => 'JUNTA DE VECINOS "EL PROGRESO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-09 07:19:06',
                'updated_at' => '2021-07-09 07:19:06',
                'deleted_at' => NULL,
            ),
            443 => 
            array (
                'id' => 444,
                'sigla' => 'GANADEROS',
                'nombre' => 'ASOCIACION DE GANADEROS "MAGDALENA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-09 07:52:20',
                'updated_at' => '2021-07-09 07:52:20',
                'deleted_at' => NULL,
            ),
            444 => 
            array (
                'id' => 445,
                'sigla' => 'TRANSPORTE',
                'nombre' => 'SINDICATO DE TRANSPORTE MIXTO "TRANS HUACARAJE -BAURES"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-09 08:09:04',
                'updated_at' => '2021-07-09 08:12:17',
                'deleted_at' => NULL,
            ),
            445 => 
            array (
                'id' => 446,
                'sigla' => 'JV-SV',
                'nombre' => 'JUNTA  DE VECINOS   SAN VICENTE -TDD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-09 10:29:43',
                'updated_at' => '2021-07-09 10:29:43',
                'deleted_at' => NULL,
            ),
            446 => 
            array (
                'id' => 447,
                'sigla' => 'REALITY',
                'nombre' => 'REALITY "IDOLO BENIANO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-12 06:54:04',
                'updated_at' => '2021-07-12 06:54:04',
                'deleted_at' => NULL,
            ),
            447 => 
            array (
                'id' => 448,
                'sigla' => 'INDIGENAL',
                'nombre' => 'COMUNIDAD "SAN FRANCISCO DE MOXOS"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-12 08:05:51',
                'updated_at' => '2021-07-12 08:05:51',
                'deleted_at' => NULL,
            ),
            448 => 
            array (
                'id' => 449,
                'sigla' => 'FJJJV',
                'nombre' => 'FEDERACION   DE JUNTA  VECINALES  .FEJUVE  CERCADO -BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-12 08:11:38',
                'updated_at' => '2021-07-12 08:11:38',
                'deleted_at' => NULL,
            ),
            449 => 
            array (
                'id' => 450,
                'sigla' => 'ASCCC',
                'nombre' => 'ASOCIACION  DE TERAPEUTAS TECNICOS  DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-12 10:31:54',
                'updated_at' => '2021-07-12 10:31:54',
                'deleted_at' => NULL,
            ),
            450 => 
            array (
                'id' => 451,
                'sigla' => 'CMND',
                'nombre' => 'COMUNIDAD  INDIGENA   SAN  LUIS  CHICO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-12 10:34:54',
                'updated_at' => '2021-07-12 10:34:54',
                'deleted_at' => NULL,
            ),
            451 => 
            array (
                'id' => 452,
                'sigla' => 'ASSSCION ',
                'nombre' => 'ASOCIACION  DE PRODUCTORES AGROP,  DE NUEVA  ESPERANZA  "APRO  AEL PROGRESO".',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-12 10:41:27',
                'updated_at' => '2021-07-12 10:41:27',
                'deleted_at' => NULL,
            ),
            452 => 
            array (
                'id' => 453,
                'sigla' => 'ASOCIACION ',
                'nombre' => 'ASOC.DE PEQUEÑOS PRODUCTORES AGROPECUARIOS LECHEROS "NUEVO AMANECER"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-13 05:24:52',
                'updated_at' => '2021-07-13 05:24:52',
                'deleted_at' => NULL,
            ),
            453 => 
            array (
                'id' => 454,
                'sigla' => 'BARRR',
                'nombre' => 'BARRIO  NUEVA   JERUSALEN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-13 06:57:20',
                'updated_at' => '2021-07-13 06:57:20',
                'deleted_at' => NULL,
            ),
            454 => 
            array (
                'id' => 455,
                'sigla' => 'CODEPEDIS',
                'nombre' => 'COMITE DEPARTAMENTAL DE LAS PERSONAS CON DISCAPACIDAD "CODEPEDIS"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-13 07:20:32',
                'updated_at' => '2021-07-13 07:20:32',
                'deleted_at' => NULL,
            ),
            455 => 
            array (
                'id' => 456,
                'sigla' => 'GOBNO',
                'nombre' => 'GOBIERNO  AUTONOMO  MUNICIPAL  DE SAN BORJA  ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-13 09:17:25',
                'updated_at' => '2021-07-13 09:17:25',
                'deleted_at' => NULL,
            ),
            456 => 
            array (
                'id' => 457,
                'sigla' => 'ALCLD',
                'nombre' => 'SUB ALCALDIA  MUNICIPAL  DISTRITO  10  -EL PALMAR',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-13 09:18:50',
                'updated_at' => '2021-07-13 09:18:50',
                'deleted_at' => NULL,
            ),
            457 => 
            array (
                'id' => 458,
                'sigla' => 'ISIBORO',
            'nombre' => 'COMUNIDAD  SANTA  CLARA   (TIPNIS )',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-13 10:20:20',
                'updated_at' => '2021-07-13 10:20:20',
                'deleted_at' => NULL,
            ),
            458 => 
            array (
                'id' => 459,
                'sigla' => 'PERIODISTAS',
                'nombre' => 'ASOCIACION DE PERIODISTAS "BENI"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-14 05:33:34',
                'updated_at' => '2021-07-14 05:33:34',
                'deleted_at' => NULL,
            ),
            459 => 
            array (
                'id' => 460,
                'sigla' => 'INSTITUTO MILI GEOGR',
                'nombre' => 'INSTITUTO GEOGRAFICO MILITAR DISTRITO GEOGRAFICO/TDD-BOLIVIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-14 05:57:05',
                'updated_at' => '2021-07-14 06:04:03',
                'deleted_at' => NULL,
            ),
            460 => 
            array (
                'id' => 461,
                'sigla' => 'C.I.I.B',
                'nombre' => 'LA CENTRAL DE PUEBLOS INDIGENAS DEL BENI "C.P.I.B"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-14 06:23:37',
                'updated_at' => '2021-07-14 06:23:37',
                'deleted_at' => NULL,
            ),
            461 => 
            array (
                'id' => 462,
                'sigla' => 'PROFESIONALES',
                'nombre' => 'FEDERACION DE PROFESIONALES DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-14 06:33:39',
                'updated_at' => '2021-07-14 06:33:39',
                'deleted_at' => NULL,
            ),
            462 => 
            array (
                'id' => 463,
                'sigla' => 'LAGUNITA',
                'nombre' => 'ASOCIACION AGROPECUARIA LAGUNITA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-14 06:43:19',
                'updated_at' => '2021-07-14 06:43:19',
                'deleted_at' => NULL,
            ),
            463 => 
            array (
                'id' => 464,
                'sigla' => 'VISAR',
                'nombre' => 'SINDICATO DE TRANSPORTE MIXTO DE LA AMAZONIA "VISAR"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-14 06:54:26',
                'updated_at' => '2021-07-14 06:54:26',
                'deleted_at' => NULL,
            ),
            464 => 
            array (
                'id' => 465,
                'sigla' => 'ASOJIMENEZ',
                'nombre' => 'ASOCIACION AGROPECUARIA JIMENEZ "ASOJIMENEZ"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-14 07:08:25',
                'updated_at' => '2021-07-14 07:08:25',
                'deleted_at' => NULL,
            ),
            465 => 
            array (
                'id' => 466,
                'sigla' => 'EL ROSARIO ',
                'nombre' => 'JUNTA VECINAL "EL ROSARIO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-14 07:22:07',
                'updated_at' => '2021-07-14 07:22:07',
                'deleted_at' => NULL,
            ),
            466 => 
            array (
                'id' => 467,
                'sigla' => 'SAN FRANCISCO',
                'nombre' => 'CENTRO DE SALUD "SAN FRANCISCO DE MOXOS"  /COMUNIDAD SAN FRANCISCO DE MOXOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-14 08:18:19',
                'updated_at' => '2021-07-14 08:20:25',
                'deleted_at' => NULL,
            ),
            467 => 
            array (
                'id' => 468,
                'sigla' => 'SIDDDCT',
                'nombre' => 'SINDICATO  DE MOTOTAXI  -18  DE AGSTO ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-14 10:42:52',
                'updated_at' => '2021-07-14 10:42:52',
                'deleted_at' => NULL,
            ),
            468 => 
            array (
                'id' => 469,
                'sigla' => 'FD',
                'nombre' => 'JUNTA   VECINAL   " BUEN  JESUS "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-14 11:21:54',
                'updated_at' => '2021-07-14 11:21:54',
                'deleted_at' => NULL,
            ),
            469 => 
            array (
                'id' => 470,
                'sigla' => 'CAM.LA',
                'nombre' => 'COMUNIDAD CAMPESINA "LAGUNITA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 05:00:57',
                'updated_at' => '2021-07-15 05:00:57',
                'deleted_at' => NULL,
            ),
            470 => 
            array (
                'id' => 471,
                'sigla' => 'S.TM. 2 DE JUNIO.',
                'nombre' => 'SINDICATO FR TRANSPORTE MIXTO 2 DE JUNIO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 05:47:04',
                'updated_at' => '2021-07-15 05:47:04',
                'deleted_at' => NULL,
            ),
            471 => 
            array (
                'id' => 472,
                'sigla' => 'SUB GOB VACADIEZ',
                'nombre' => 'SUB GOBERNACION PROV VACA DIEZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 06:18:58',
                'updated_at' => '2021-07-15 06:18:58',
                'deleted_at' => NULL,
            ),
            472 => 
            array (
                'id' => 473,
                'sigla' => 'ASORBENI',
                'nombre' => 'ASOCIACION DE SORDOS DEL BENI "ASORBENI"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 06:27:00',
                'updated_at' => '2021-07-15 06:27:00',
                'deleted_at' => NULL,
            ),
            473 => 
            array (
                'id' => 474,
                'sigla' => 'CONISUR',
                'nombre' => 'TERRITORIO INDIGENA Y PARQUE NACIONAL ISIBORO SECURE  "CONISUR"/TIPNIS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 06:33:07',
                'updated_at' => '2021-07-15 06:33:07',
                'deleted_at' => NULL,
            ),
            474 => 
            array (
                'id' => 475,
                'sigla' => 'TRINITURS',
                'nombre' => 'AGENCIA DE VIAJES Y TURISMO "TRINITURS"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 06:53:00',
                'updated_at' => '2021-07-15 06:53:00',
                'deleted_at' => NULL,
            ),
            475 => 
            array (
                'id' => 476,
                'sigla' => 'ONG',
                'nombre' => 'ONG "GRAN PAITITI"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 07:08:43',
                'updated_at' => '2021-07-15 07:08:43',
                'deleted_at' => NULL,
            ),
            476 => 
            array (
                'id' => 477,
                'sigla' => 'SUB ALC.COM INDIGENA',
                'nombre' => 'SUB ALCALDIA MUNICIPAL COMUNIDAD INDIGENA "NUEVA CALAMA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 07:32:26',
                'updated_at' => '2021-07-15 07:32:26',
                'deleted_at' => NULL,
            ),
            477 => 
            array (
                'id' => 478,
                'sigla' => 'FIS GRAL DEL ESTADO',
                'nombre' => 'FISCALIA GENERAL DEL ESTADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 08:22:16',
                'updated_at' => '2021-07-15 08:22:16',
                'deleted_at' => NULL,
            ),
            478 => 
            array (
                'id' => 479,
                'sigla' => 'DDCM',
                'nombre' => 'DIRECCION  DESCONCENTRADA  DE COORDINACION   MUNICIPAL ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 08:40:13',
                'updated_at' => '2021-07-15 08:40:13',
                'deleted_at' => NULL,
            ),
            479 => 
            array (
                'id' => 480,
                'sigla' => 'OOCP',
                'nombre' => 'RESPUESTO  - OCAMPO  -SANTA  CRUZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 10:04:02',
                'updated_at' => '2021-07-15 10:04:02',
                'deleted_at' => NULL,
            ),
            480 => 
            array (
                'id' => 481,
                'sigla' => 'CTR',
                'nombre' => 'CORREGIMIENTO  TERRITORIAL  DE REYES - JOSE BALLIVIAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-15 10:22:42',
                'updated_at' => '2021-07-15 10:22:42',
                'deleted_at' => NULL,
            ),
            481 => 
            array (
                'id' => 482,
                'sigla' => 'C.UNICA CAMPESINA',
                'nombre' => 'CENTRAL UNICA CAMPESINA PROV MARBAN-BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-16 06:12:14',
                'updated_at' => '2021-07-16 06:12:14',
                'deleted_at' => NULL,
            ),
            482 => 
            array (
                'id' => 483,
                'sigla' => 'COMUNIDAD.',
                'nombre' => 'COMUNIDAD CAMPESINA "POZA HONDA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-16 06:18:12',
                'updated_at' => '2021-07-16 06:18:12',
                'deleted_at' => NULL,
            ),
            483 => 
            array (
                'id' => 484,
                'sigla' => 'J.VECI SAN VICENTE',
                'nombre' => 'JUNTA DE VECINOS SAN VICENTE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-16 06:56:48',
                'updated_at' => '2021-07-16 06:56:48',
                'deleted_at' => NULL,
            ),
            484 => 
            array (
                'id' => 485,
                'sigla' => 'GOBER DEL BENI',
                'nombre' => 'GOBERNACION DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-16 07:34:30',
                'updated_at' => '2021-07-16 07:34:30',
                'deleted_at' => NULL,
            ),
            485 => 
            array (
                'id' => 486,
                'sigla' => 'BYS',
                'nombre' => 'SEDES -BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-16 07:41:29',
                'updated_at' => '2021-07-16 07:41:29',
                'deleted_at' => NULL,
            ),
            486 => 
            array (
                'id' => 487,
                'sigla' => 'S. AGRA.CAMP. DESENG',
                'nombre' => 'SINDICATO AGRARIO CAMPESINO DESENGAÑO ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-16 07:44:39',
                'updated_at' => '2021-07-16 07:44:39',
                'deleted_at' => NULL,
            ),
            487 => 
            array (
                'id' => 488,
                'sigla' => 'CCDDCTO',
                'nombre' => 'SINDICATO  AGRARIO  CAMPESINO  -DESENGAÑO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-16 07:50:21',
                'updated_at' => '2021-07-16 07:50:21',
                'deleted_at' => NULL,
            ),
            488 => 
            array (
                'id' => 489,
                'sigla' => 'JUNIN',
                'nombre' => 'COMUNIDAD  CAMPESINA""  PUERTO JUNIN "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-16 08:44:09',
                'updated_at' => '2021-07-16 08:44:09',
                'deleted_at' => NULL,
            ),
            489 => 
            array (
                'id' => 490,
                'sigla' => 'JUSGGD',
                'nombre' => 'JUZGADO  PUBLICO  CIVIL  Y COMERCIAL  1°  DE SAN BORJA ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-16 10:10:07',
                'updated_at' => '2021-07-16 10:10:07',
                'deleted_at' => NULL,
            ),
            490 => 
            array (
                'id' => 491,
                'sigla' => 'FEPAY',
                'nombre' => 'FEDERACION   DE PRODUCTORES  AGROPECUARIOS  DE YUCUMO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-16 10:19:59',
                'updated_at' => '2021-07-16 10:19:59',
                'deleted_at' => NULL,
            ),
            491 => 
            array (
                'id' => 492,
                'sigla' => 'FNDD',
                'nombre' => 'FUNDACION  PABLO  ALPIRE -REGIONAL  BENI ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-16 11:58:43',
                'updated_at' => '2021-07-16 11:58:43',
                'deleted_at' => NULL,
            ),
            492 => 
            array (
                'id' => 493,
                'sigla' => 'A.A.P',
                'nombre' => 'ASOCIACION AGROPECUARIA "PAITITI"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-19 05:19:00',
                'updated_at' => '2021-07-19 05:22:56',
                'deleted_at' => NULL,
            ),
            493 => 
            array (
                'id' => 494,
                'sigla' => 'GOOOBBB',
                'nombre' => 'GOBERNACION  DE  SAN  BORJA   -BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-19 10:18:23',
                'updated_at' => '2021-07-19 10:18:23',
                'deleted_at' => NULL,
            ),
            494 => 
            array (
                'id' => 495,
                'sigla' => 'DISTRI  3',
                'nombre' => 'ZONA  GERMAN  BUSCH  " DISTRITO   3"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-19 11:51:08',
                'updated_at' => '2021-07-19 11:51:08',
                'deleted_at' => NULL,
            ),
            495 => 
            array (
                'id' => 496,
                'sigla' => 'ACERRADORES',
                'nombre' => 'SINDICATO DE PEQUEÑOS ACERRADORES DE MADERA "YACUMA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-20 06:04:47',
                'updated_at' => '2021-07-20 06:04:47',
                'deleted_at' => NULL,
            ),
            496 => 
            array (
                'id' => 497,
                'sigla' => 'CHAPIE',
                'nombre' => 'CONSTRUCTORA & CONSULTORA "CHAPIE"  S.R.L',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-20 06:50:08',
                'updated_at' => '2021-07-20 07:07:02',
                'deleted_at' => NULL,
            ),
            497 => 
            array (
                'id' => 498,
                'sigla' => 'ADESORBENI',
                'nombre' => 'ASOCIACION DEPARTAMENTAL DE DORDOS DEL BENI "ADESORBENI"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-20 08:17:44',
                'updated_at' => '2021-07-20 08:22:38',
                'deleted_at' => NULL,
            ),
            498 => 
            array (
                'id' => 499,
                'sigla' => 'ARENEROS',
                'nombre' => 'SINDICATO DE ARENEROS "25 DE MAYO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-21 04:45:11',
                'updated_at' => '2021-07-21 04:45:11',
                'deleted_at' => NULL,
            ),
            499 => 
            array (
                'id' => 500,
                'sigla' => 'FI.M.P',
                'nombre' => 'FUNDACION INTERNACIONAL MARTIN DE PORRES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-21 05:40:53',
                'updated_at' => '2021-07-21 05:40:53',
                'deleted_at' => NULL,
            ),
        ));
        \DB::table('entities')->insert(array (
            0 => 
            array (
                'id' => 501,
                'sigla' => 'C.S.U.T.C.P.M.S.A.',
                'nombre' => 'CENTRAL SINDICAL UNICA DE TRABAJADORES DE SAN ANDRES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-21 06:17:32',
                'updated_at' => '2021-07-21 06:17:32',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 502,
                'sigla' => 'TECNOLOGIA',
                'nombre' => 'COMPUTACION Y TECNOLOGIA "ZABALA SISTEM"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-21 06:31:21',
                'updated_at' => '2021-07-21 06:31:21',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 503,
                'sigla' => 'CENTRAL SINDICAL',
                'nombre' => 'CENTRAL SINDICAL UNICA DE TRABAJADORES CAMPESINOS /PROVINCIA YACUMA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-21 07:00:01',
                'updated_at' => '2021-07-21 07:00:01',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 504,
                'sigla' => '16 DE JULIO ',
                'nombre' => 'CENTRAL CAMPESINA 16 DE JULIO -DISTRITO 3 /MUNICIPIO DE SAN JAVIER ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-21 07:28:45',
                'updated_at' => '2021-07-21 07:28:45',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 505,
                'sigla' => '26 DE ENERO ',
                'nombre' => 'JUNTA DE VECINOS "26 DE ENERO" ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-21 08:11:41',
                'updated_at' => '2021-07-21 08:11:41',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 506,
                'sigla' => 'CICOBE',
                'nombre' => 'COLEGIO DE INGENIEROS COMERCIALES DEL BENI "CICOBE"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-21 08:41:00',
                'updated_at' => '2021-07-21 08:41:00',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 507,
                'sigla' => 'A.T.P.D-AEPAMA',
                'nombre' => 'ASOCIACION DE COMUNITARIA TURISMO Y PESCA DEPORTIVA EL PARAISO DE MATEGUA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-21 10:08:18',
                'updated_at' => '2021-07-21 10:08:18',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 508,
                'sigla' => 'TO"CHINI ',
                'nombre' => 'SUB CENTRAL TO"CHINI/PROVINCIA MARBAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-21 11:07:31',
                'updated_at' => '2021-07-21 11:07:31',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 509,
                'sigla' => 'MMM',
                'nombre' => 'IGLESIA  CRISTIANA PENTECOSTES EN BOLIVIA DEL MOVIMIENTO MISIONERO MUNDIAL ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-21 11:45:31',
                'updated_at' => '2021-07-21 11:45:31',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 510,
                'sigla' => 'COLG',
                'nombre' => 'COLEGIO  DE ODONTOLOGOS  DE  BOLIVIA  .LA  PAZ ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-22 05:17:53',
                'updated_at' => '2021-07-22 05:17:53',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 511,
                'sigla' => 'BBRRR',
                'nombre' => 'JUNTA  VECINAL  "VILLA  LOLITA "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-22 05:22:43',
                'updated_at' => '2021-07-22 05:22:43',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 512,
                'sigla' => 'CODESA',
                'nombre' => 'COMISION DEPARTAMENTAL DE SALUD "CODESA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-22 06:06:16',
                'updated_at' => '2021-07-22 06:06:16',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 513,
                'sigla' => 'CONALJUVE',
                'nombre' => 'CONFEDERACION NACIONAL DE JUNTAS VECINALES DE BOLIVIA "CONALJUVE-BOLIVIA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-22 06:36:07',
                'updated_at' => '2021-07-22 06:36:07',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 514,
                'sigla' => 'PANTANAL',
                'nombre' => 'URBANIZACION "PANTANAL"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-22 06:40:02',
                'updated_at' => '2021-07-22 06:40:02',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 515,
                'sigla' => 'F.D.M',
                'nombre' => 'CONFEDERACION NACIONAL DE MUJERES "JUANA AZURDUY DE PADILLA " DEL ESTADO PLURINACIONAL DE BOLIVIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-22 07:52:38',
                'updated_at' => '2021-07-22 07:52:38',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 516,
                'sigla' => 'CCTRL',
                'nombre' => 'CENTRAL  CAMPESINA  INTEGRACION   DISTRITO  3  MUNIC , SAN  JAVIER -PROV  CERCADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-22 11:20:11',
                'updated_at' => '2021-07-22 11:20:11',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 517,
                'sigla' => 'JEHOVA',
                'nombre' => 'COMUNIDAD  AGROPECUARIA   JEHOVA  ES  MI PASTOR  "DOS"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-22 11:39:44',
                'updated_at' => '2021-07-22 11:39:44',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 518,
                'sigla' => 'U.E.',
                'nombre' => 'U.E..GUILLERMINA MELHO MICHELIN /GUAYARAMERIN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-23 04:46:12',
                'updated_at' => '2021-07-23 04:46:12',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 519,
                'sigla' => 'U.E',
                'nombre' => 'UNIDAD EDUCATIVA "MEJILLONES I" / GUAYARAMERIN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-23 04:57:59',
                'updated_at' => '2021-07-23 04:59:42',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 520,
                'sigla' => 'UPPPR',
                'nombre' => 'MINISTERIO  DE LA PRESIDENCIA   DE LA  PAZ  -UPRE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-23 05:24:52',
                'updated_at' => '2021-07-23 05:24:52',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 521,
                'sigla' => 'C.S.T.S.B',
                'nombre' => 'CONFEDERACION SINDICAL DE TRABAJADORES EN SALUD PUBLICA DE BOLIVIA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-23 05:33:24',
                'updated_at' => '2021-07-23 05:33:24',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 522,
                'sigla' => 'M.E',
                'nombre' => 'MINISTERIO EMANUEL ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-23 05:57:39',
                'updated_at' => '2021-07-23 05:57:39',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 523,
                'sigla' => 'COLGDELB',
                'nombre' => 'COLEGIO  DE  ARQUITECTOS  DEL  BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-23 07:09:09',
                'updated_at' => '2021-07-23 07:09:09',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 524,
                'sigla' => 'CCCSSSMIL',
                'nombre' => 'COSSMIL -" TRINIDAD"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-23 08:35:24',
                'updated_at' => '2021-07-23 08:35:24',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 525,
                'sigla' => '27  DE MAYO',
                'nombre' => 'SINDICATO  27  DE MAYO   -"MERCADO  CAMPESINO" ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-23 08:59:08',
                'updated_at' => '2021-07-23 08:59:08',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 526,
                'sigla' => 'M-EL PALMAR',
                'nombre' => 'COMUNIDAD   ECOLOGICA  AGROPECUARIA   YACUMA  - EL  PALMAR',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-23 11:26:21',
                'updated_at' => '2021-07-23 11:26:21',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 527,
                'sigla' => 'AASSSO',
                'nombre' => 'ASOCIACION   DE PRODUCTORES  - ALTO  SAN  PEDRO  -PROV, BALLIVIAN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-23 11:28:52',
                'updated_at' => '2021-07-23 11:28:52',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 528,
                'sigla' => 'ADEPCOCA',
                'nombre' => 'ASOCIACION   DEPARTAMENTAL   DE PRODUCTORES  DE COCA   -ADEPCOCA  -LA  PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-23 11:37:23',
                'updated_at' => '2021-07-23 11:37:23',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 529,
                'sigla' => 'ROTARY',
                'nombre' => 'ROTARY CLUB TRINIDAD ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-26 05:00:00',
                'updated_at' => '2021-07-26 05:00:00',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 530,
                'sigla' => 'SUDAMERICANO ',
                'nombre' => 'CORREGIMIENTO COMUNIDAD "SUDAMERICANO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-26 05:40:35',
                'updated_at' => '2021-07-26 05:40:35',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 531,
                'sigla' => 'BLL VTA',
                'nombre' => 'ASOCIACION    BELLAVISTEÑA   DE PERSONAS  CON  DISCAPACIDAD  - BELLA  VISTA ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-26 07:03:54',
                'updated_at' => '2021-07-26 07:03:54',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 532,
                'sigla' => 'EEPPROC',
                'nombre' => 'EPIROC    BOLIVIA   S.A.  EQUIPO  DE ERVICIOS  -LA  PAZ ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-26 07:14:48',
                'updated_at' => '2021-07-26 07:14:48',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 533,
                'sigla' => 'F.S.T.S.B',
                'nombre' => 'FEDEREACION SINDICAL DE TRABAJADORES EN SALUD DEL BENI ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-26 07:36:35',
                'updated_at' => '2021-07-26 07:36:35',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 534,
                'sigla' => 'COTOCA',
                'nombre' => 'SUB CENTRAL  SINDICAL  CAMPESINA   COTOCA  -MUNIC  SAN ANDRES  -DISTRITO " 3"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-26 07:44:16',
                'updated_at' => '2021-07-26 07:44:16',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 535,
                'sigla' => 'AR IMP',
                'nombre' => 'IMPORTACIONES  "AR"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-26 07:57:45',
                'updated_at' => '2021-07-26 07:57:45',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 536,
                'sigla' => 'CENTRAL SINDICAL C',
                'nombre' => 'CENTRAL SINDICAL UNICA DE TRABAJADORES CAMPESINOS/GUAYARAMERIN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 06:37:38',
                'updated_at' => '2021-07-27 07:23:38',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 537,
                'sigla' => 'PUERTO ROMAN',
                'nombre' => 'COMUNIDAD CAMPESINA "PUERTO ROMAN"/PROVINCIA VACA DIEZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 06:42:31',
                'updated_at' => '2021-07-27 07:20:41',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 538,
                'sigla' => 'VILLA UNION ',
                'nombre' => 'COMUNIDAD   INDIGENA   JUAQUINIANA  VILLA   UNION ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 06:59:47',
                'updated_at' => '2021-07-27 06:59:47',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 539,
                'sigla' => 'DISTRITO 3',
                'nombre' => 'ZONA GERMAN BUSH "DISTRITO 3"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 07:00:04',
                'updated_at' => '2021-07-27 07:00:04',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 540,
                'sigla' => 'CANDELARIA ',
                'nombre' => 'COMUNIDAD INDIGENA "CANDELARIA DEL IVON"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 07:03:44',
                'updated_at' => '2021-07-27 07:31:27',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 541,
                'sigla' => 'CORRDMDSJ',
                'nombre' => 'CORREGIMIENTO  DEL MUNICIPIO  DE SAN  JAVIER  PROV. CERCADO  -BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 07:24:00',
                'updated_at' => '2021-07-27 07:24:00',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 542,
                'sigla' => 'VAL LLANTAS',
                'nombre' => 'VAL LLANTAS/SANTA CRUZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 07:48:16',
                'updated_at' => '2021-07-27 07:48:16',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 543,
                'sigla' => 'SANTA  TERESITA ',
                'nombre' => 'COMUNIDAD  INDIGENA  TACANA "SANTA  TERESITA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 07:56:11',
                'updated_at' => '2021-07-27 07:56:11',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 544,
                'sigla' => 'DIPUTADOS',
                'nombre' => 'ASAMBLEA PLURINACIONAL DE BOLIVIA CAMARA DE DIPUTADOS            ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 07:59:35',
                'updated_at' => '2021-07-27 07:59:35',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 545,
                'sigla' => 'FUNDESI',
                'nombre' => 'FUNDACION  DE DESARROLLO  INTEGRAL  DE PRESERVACION Y DEFENSA  DEL MEDIO AMBIENTE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 09:11:32',
                'updated_at' => '2021-07-27 09:11:32',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 546,
                'sigla' => 'S.S.O.T.UR-18NOV.',
                'nombre' => 'ASOCIACION DE  TURISMO 18 DE NOVIEMBRE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 09:49:29',
                'updated_at' => '2021-07-27 09:49:29',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 547,
                'sigla' => 'A.R.A.P.I.B.V',
                'nombre' => 'ASOCIACION DE RECOLECTORES DE ASAI PERLA ITENEZ BELLA VISTA ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 10:12:48',
                'updated_at' => '2021-07-27 10:12:48',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 548,
                'sigla' => 'SUB CENTRALTIPNIS',
                'nombre' => 'TERRITORIO INDIGENA Y PARQUE NACIONAL "ISIBORO SECURE"SUB CENTRAL DE PUEBLOS INDIGENAS DEL "TIPNIS"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-27 10:26:49',
                'updated_at' => '2021-07-27 10:26:49',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 549,
                'sigla' => 'AIPRAMCA',
                'nombre' => 'ASOCIACION INDIGENA DE PRODUCTORES Y RECOLECTORES DE ASAI Y MAJO CARMEN ALTO "AIPRAMCA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-28 04:33:21',
                'updated_at' => '2021-07-28 04:33:21',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 550,
                'sigla' => 'PUENTE  SAN PABLO',
                'nombre' => 'JUNTA VECINAL  COSTANERA  /PUENTE  SAN PABLO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-28 05:49:31',
                'updated_at' => '2021-07-28 05:49:31',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 551,
                'sigla' => 'SACHOJERE',
                'nombre' => 'CORREGIMIENTO -COMUNIDAD " SACHOJERE "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-28 05:50:48',
                'updated_at' => '2021-07-28 05:50:48',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 552,
                'sigla' => '4 DE FEBRERO',
                'nombre' => 'JUNTA DE VECINOS "4 DE FEBRERO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-28 06:16:00',
                'updated_at' => '2021-07-28 06:16:00',
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 553,
                'sigla' => '"MUIJE"',
                'nombre' => 'ASOCIACION INDIGENA DE RECOLECTORES "MUIJE"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-28 06:47:48',
                'updated_at' => '2021-07-28 06:50:34',
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 554,
                'sigla' => 'TRIATLON ASOBETRI ',
                'nombre' => 'ASOCIACION BENIANA TRIATLON ASOBETRI ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-28 08:41:37',
                'updated_at' => '2021-07-28 08:41:37',
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 555,
                'sigla' => 'LOS TAITAS',
                'nombre' => 'CLUB DEPORTIVO LOS TAITAS DEL TRIATLON DE TRINIDAD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-28 08:46:32',
                'updated_at' => '2021-07-28 08:46:32',
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 556,
                'sigla' => 'F.E.I.M.A.R',
            'nombre' => 'FEDERACION DE MUJERES AGROPECUARIAS DE RURRENABAQUE (F.E.I.M.A.R)',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-28 10:57:33',
                'updated_at' => '2021-07-28 10:57:33',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 557,
                'sigla' => 'JUVENTUD',
                'nombre' => 'JUVENTUD SIN FRONTERAS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-28 11:19:17',
                'updated_at' => '2021-07-28 11:19:17',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 558,
                'sigla' => 'MUIJE AIR',
            'nombre' => 'ASOCIACION INDIGENA DE RECOLECTORES "MUIJE"(AIR MUIJE)',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 04:55:19',
                'updated_at' => '2021-07-29 04:55:19',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 559,
                'sigla' => 'TVA CANAL ',
                'nombre' => 'TELEVISON AMAZONICA "TVA CANAL 9"/RIBERALTA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 06:05:35',
                'updated_at' => '2021-07-29 06:16:29',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 560,
                'sigla' => 'SWISS',
                'nombre' => 'HELVETAS SWISS INTERCCOPERATION ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 06:24:26',
                'updated_at' => '2021-07-29 06:24:26',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 561,
                'sigla' => 'CAMARA SE',
                'nombre' => 'ASAMBLEA LEGISLATIVA PLURINACIONAL DE BOLIVIA CAMARA DE SENADORES PRESIDENCIA/LA PAZ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 06:50:23',
                'updated_at' => '2021-07-29 06:50:23',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 562,
                'sigla' => 'SAN MIGUEL ',
                'nombre' => 'SAN MIGUEL DE LOS CHORRITOS / SAN IGNACIO ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 08:45:31',
                'updated_at' => '2021-07-29 08:45:31',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 563,
                'sigla' => 'CABILDO SAN IGNACIO',
                'nombre' => 'GRAN CABILDO  INDIGENAL  DE  SAN  IGNACIO  DE MOJOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 08:47:30',
                'updated_at' => '2021-07-29 08:47:30',
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 564,
                'sigla' => 'U.E. 31 DE JULIO ',
                'nombre' => 'UNIDAD EDUCATIVA 31 DE JULIO /SAN IGNACIO DE MOXOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 08:53:35',
                'updated_at' => '2021-07-29 08:53:35',
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 565,
                'sigla' => 'ECOLOGICAS  AROMA',
                'nombre' => 'CENTRAL  DE COMUNIDADES  Y COLONIAS  AGROPECUARIA  ECOLOGICA S "AROMA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 09:19:01',
                'updated_at' => '2021-07-29 09:19:01',
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 566,
                'sigla' => 'AGRARIA',
                'nombre' => 'CENTRAL AGRARIA "QUIQUIBEY"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 09:33:09',
                'updated_at' => '2021-07-29 09:33:09',
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 567,
                'sigla' => 'RED MEDIA',
                'nombre' => 'RED MEDIA ARTE &  COMUNICACION MARKETING DIGITAL  /GUAYARAMERIN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 09:44:10',
                'updated_at' => '2021-07-29 09:44:50',
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 568,
                'sigla' => 'SAN ANDRES',
                'nombre' => 'CENTRO DE SALUD DE SAN ANDRES /SAN ANDRES ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 10:03:21',
                'updated_at' => '2021-07-29 10:03:21',
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 569,
                'sigla' => '10 DE OCTUBRE ',
                'nombre' => 'COMUNIDAD INDIGENA TSIMANE "10 DE OCTUBRE"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 10:08:44',
                'updated_at' => '2021-07-29 10:08:44',
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 570,
                'sigla' => 'SCTSY',
                'nombre' => 'SUB  CONCEJO TSIMANE  SECTOR YACUMA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 10:11:49',
                'updated_at' => '2021-07-29 10:11:49',
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 571,
                'sigla' => 'B/10 DE SEPTIEMBRE',
                'nombre' => 'BARRIO "10 DE SEPTIEMBRE" /RURRENABAQUE ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 10:12:53',
                'updated_at' => '2021-07-29 10:12:53',
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 572,
                'sigla' => 'SAN GABRIEL',
                'nombre' => ' COMUNIDAD INDIGENA TSIMANE "SAN GABRIEL "/SAN BORJA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 10:15:24',
                'updated_at' => '2021-07-29 10:15:24',
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 573,
                'sigla' => 'PALMIRA ',
                'nombre' => 'COMUNIDAD INDIGENA TSIMANE " PALMIRA" /PROV.GRAL J.BALLIVIAN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 10:19:30',
                'updated_at' => '2021-07-29 10:19:30',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 574,
                'sigla' => 'JATATAL',
                'nombre' => 'COMUNIDAD INDIGENA TSIMANE " JATATAL RURRENABAQUE "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 10:22:06',
                'updated_at' => '2021-07-29 10:22:06',
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 575,
                'sigla' => 'ASAPCOIPLAR',
                'nombre' => 'ASOCIACION AGROFORESTAL DE  PRODUCTORES  DE CACAO ORIGINARIO E INDIGENAS DE  PILON LAJAS RURENABAQUE "ASAPCOIPLAR',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-29 10:28:40',
                'updated_at' => '2021-07-29 10:28:40',
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 576,
                'sigla' => 'CMDTDAD',
                'nombre' => 'CONCEJO   MUNICIPAL   DE  TRINIDAD  ORGANO  DELIBERATIVO,FISCALIZADOR  Y LEGISLATIVO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-30 04:17:49',
                'updated_at' => '2021-07-30 04:17:49',
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 577,
                'sigla' => 'PUERTO',
                'nombre' => 'GOBIERNO AUTONOMO MUNICIPAL "PUERTO RURRENABAQUE"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-30 04:59:24',
                'updated_at' => '2021-07-30 04:59:24',
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 578,
                'sigla' => 'PUERTO SILES',
                'nombre' => 'GOBIERNO AUTONOMO MUNICIPAL DE PUERTO SILES ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-30 05:40:06',
                'updated_at' => '2021-07-30 05:40:06',
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 579,
                'sigla' => 'S.T.M..A. ',
                'nombre' => 'SINDICATO DE TRANSPORTE MIXTO DE LA AMAZONIA - VISAR 18 DE MARZO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-30 06:19:40',
                'updated_at' => '2021-07-30 06:19:40',
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 580,
                'sigla' => 'S.A.C.P.A.',
                'nombre' => 'SINDICATO  AGRAGRARIO  CAMPESINO "PUERTO ALMACEN"DEL MUNICIPIO DE TDAD.-PROV.CERCADO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-30 06:20:37',
                'updated_at' => '2021-07-30 06:20:37',
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 581,
                'sigla' => 'ING.BOL.  S. A.',
                'nombre' => 'INGEFIBRA   BOLIVIA    S.A.',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-30 06:30:57',
                'updated_at' => '2021-07-30 06:30:57',
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 582,
                'sigla' => 'IBIATO ',
                'nombre' => 'CORREGIMIENTO DE IBIATO ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-30 09:21:08',
                'updated_at' => '2021-07-30 09:21:08',
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 583,
                'sigla' => 'FEPAY BENI',
                'nombre' => 'FEDERACION DE PRODUCTORES AGROPECUARIOS DE YUCUMO "FEPAY"/BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-30 10:21:40',
                'updated_at' => '2021-07-30 10:21:40',
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 584,
                'sigla' => 'FECAR',
                'nombre' => 'FEDERACION DE COMUNIDADES AGROPECUARIAS DE RURRENABAQUE "FECAR"/RURRENABAQUE ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-07-30 11:16:49',
                'updated_at' => '2021-07-30 11:16:49',
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 585,
                'sigla' => 'AREDCASCAO',
            'nombre' => 'ASOCIACION DE RECOLECTORES DE CASTAÑA Y CACAO (AREDCASCAO)/BAURES',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 07:10:05',
                'updated_at' => '2021-08-02 07:10:05',
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 586,
                'sigla' => 'S.C.C.B',
            'nombre' => 'SUB CENTRAL CAMPESINA DE BAURES (S.C.C.B) COMUNIDADES Y ASOCIACIONES ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 07:11:09',
                'updated_at' => '2021-08-02 07:11:09',
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 587,
                'sigla' => 'DIRECCIION CULTURA',
                'nombre' => 'DIRECCION DE CULTURA DE SANTA ROSA ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 07:15:59',
                'updated_at' => '2021-08-02 07:15:59',
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 588,
                'sigla' => 'TRABAJADORES',
                'nombre' => 'SINDICATO DE TRABAJADORES DE SALUD/SAN BORJA ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 07:25:11',
                'updated_at' => '2021-08-02 07:25:11',
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 589,
                'sigla' => 'PARROQUIA',
                'nombre' => 'PARROQUIA "SANTISIMA TRINIDAD"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 08:19:41',
                'updated_at' => '2021-08-02 08:19:41',
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 590,
                'sigla' => 'TELESALUD',
                'nombre' => 'COORDINACION DEPARTAMENTAL TELESALUD',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 08:30:04',
                'updated_at' => '2021-08-02 08:30:04',
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 591,
                'sigla' => 'CUCHI CUCHI ',
                'nombre' => 'COMUNIDAD CAMPESINA AGROPECUARIA MANANTIAL "CUCHI CUCHI"/PROV.MARBAN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 10:33:21',
                'updated_at' => '2021-08-02 10:35:36',
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 592,
                'sigla' => 'U.A.B JOSE BALLIVIAN',
                'nombre' => 'U.A.B "JOSE BALLIVIAN" CARRERA DE ADMINISTRACION DE EMPRESAS ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 10:49:12',
                'updated_at' => '2021-08-02 10:49:12',
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 593,
                'sigla' => 'M.T.S ',
                'nombre' => 'MOVIMIENTO TERCER SISTEMA "M.T.S" /RURRENABAQUE ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 11:00:42',
                'updated_at' => '2021-08-02 11:01:26',
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 594,
                'sigla' => 'EDUCACION ',
                'nombre' => 'MINISTERIO DE EDUCACION DIRECCION DEPARTAMENTAL DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 11:13:33',
                'updated_at' => '2021-08-02 11:13:33',
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 595,
                'sigla' => 'DIRE.TIPNIS',
                'nombre' => 'SECRETARIA DEPARTAMENTAL DE DESARROLLO INDIGENA/TIPNIS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 11:30:44',
                'updated_at' => '2021-08-02 11:30:44',
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 596,
                'sigla' => 'AREDCACAO ',
                'nombre' => 'ASOCIACION DE RECOLECTORES DE CASTAÑA Y CACAO DE BAURES ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-02 11:46:08',
                'updated_at' => '2021-08-02 11:46:08',
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 597,
                'sigla' => 'O E P',
                'nombre' => 'ORGANO   ELECTORAL  PLURINACIONAL   BOLIVIA ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-03 04:51:26',
                'updated_at' => '2021-08-03 04:51:26',
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 598,
                'sigla' => 'COMERCIANTES',
                'nombre' => 'MERCADO GRAN PAITITI ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-03 06:28:44',
                'updated_at' => '2021-08-03 06:28:44',
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 599,
                'sigla' => 'ABC P',
                'nombre' => 'ABC - PANDO ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-03 06:40:32',
                'updated_at' => '2021-08-03 06:40:32',
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 600,
                'sigla' => 'ALTURA',
                'nombre' => 'COMUNIDAD INDIGENA "ALTURA EL CARMEN"/PROV.MAMORE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-03 14:52:01',
                'updated_at' => '2021-08-03 14:52:01',
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'id' => 601,
                'sigla' => 'OTTO AGUILERA',
                'nombre' => 'UNIDAD EDUCATIVA "OTTO AGUILERA OJEDA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-03 15:43:20',
                'updated_at' => '2021-08-03 15:43:20',
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'id' => 602,
                'sigla' => 'UJP PRAHA',
                'nombre' => 'UJP PRAHA / REPUBLICA CHECA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-04 09:05:14',
                'updated_at' => '2021-08-04 09:05:14',
                'deleted_at' => NULL,
            ),
            102 => 
            array (
                'id' => 603,
                'sigla' => 'MEZJAR',
                'nombre' => 'EMPRESA MEZJAR',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-04 09:43:17',
                'updated_at' => '2021-08-04 09:43:17',
                'deleted_at' => NULL,
            ),
            103 => 
            array (
                'id' => 604,
                'sigla' => 'ASOC.PROD. AGRO',
                'nombre' => 'ASOCIACION  DE PRODUCTORES  AGROPECUARIO  "8 DE  SEPTIEMBRE',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-04 10:15:54',
                'updated_at' => '2021-08-04 10:15:54',
                'deleted_at' => NULL,
            ),
            104 => 
            array (
                'id' => 605,
                'sigla' => 'CACAO URKUPIÑA',
                'nombre' => 'ASOCIACION DE PRODUCTORES DE CACAO URKUPIÑA/COLONIA URKUPIÑA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-04 10:17:23',
                'updated_at' => '2021-08-04 10:17:23',
                'deleted_at' => NULL,
            ),
            105 => 
            array (
                'id' => 606,
                'sigla' => 'MTS',
                'nombre' => 'JUVENTUDES MTS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-04 11:49:13',
                'updated_at' => '2021-08-04 11:49:13',
                'deleted_at' => NULL,
            ),
            106 => 
            array (
                'id' => 607,
                'sigla' => 'ASOC. INTE.MUJ.FUT.',
                'nombre' => 'ASOCIACION INTEGRAL   DE  MUJERS   CREANDO   FUTURO ',
                'estado' => 'ELIMINADO',
                'created_at' => '2021-08-04 11:54:13',
                'updated_at' => '2021-08-04 11:54:27',
                'deleted_at' => NULL,
            ),
            107 => 
            array (
                'id' => 608,
                'sigla' => 'ASOC. INTE. ',
                'nombre' => 'ASOCIACION   INTEGRAL  DE  MUJERES   CREANDO   FUTURO ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-04 11:56:46',
                'updated_at' => '2021-08-04 11:56:46',
                'deleted_at' => NULL,
            ),
            108 => 
            array (
                'id' => 609,
                'sigla' => 'NUEVA SELVA ',
                'nombre' => 'COMUNIDAD INDIGENA NUEVA SELVA /PROV. MARBAN',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-04 12:25:04',
                'updated_at' => '2021-08-04 12:26:25',
                'deleted_at' => NULL,
            ),
            109 => 
            array (
                'id' => 610,
                'sigla' => 'MONTE VERDE ',
                'nombre' => 'COMUNIDAD  GANADERO  "MONTE VERDE "DEL MUNICIPIO  DE BAURES  DE LA  PROV.ITENEZ  DEL DPTO .DEL BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-04 12:38:39',
                'updated_at' => '2021-08-04 12:38:39',
                'deleted_at' => NULL,
            ),
            110 => 
            array (
                'id' => 611,
                'sigla' => 'SAN SIMON  ',
                'nombre' => 'COMUNIDAD AGROGANADERA "SAN SIMON"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-04 12:48:25',
                'updated_at' => '2021-08-04 12:48:25',
                'deleted_at' => NULL,
            ),
            111 => 
            array (
                'id' => 612,
                'sigla' => 'EL CEDRO ',
                'nombre' => 'COMUNIDAD CAMPESINA AGROPECUARIA " EL CEDRO "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-04 12:50:46',
                'updated_at' => '2021-08-04 12:50:46',
                'deleted_at' => NULL,
            ),
            112 => 
            array (
                'id' => 613,
                'sigla' => 'JUNT. VEC.',
                'nombre' => 'JUNTA     VECINAL    "BUEN   JESUS"  DISTRITO #4',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-05 09:02:40',
                'updated_at' => '2021-08-05 09:02:40',
                'deleted_at' => NULL,
            ),
            113 => 
            array (
                'id' => 614,
                'sigla' => 'COM.CAM.PALO',
                'nombre' => 'COMUNIDAD  CAMPESINA  PALO  HUECO',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-05 10:51:43',
                'updated_at' => '2021-08-05 10:51:43',
                'deleted_at' => NULL,
            ),
            114 => 
            array (
                'id' => 615,
                'sigla' => 'SOLIDARIO ',
                'nombre' => 'FONDO DE APOYO SOLIDARIO DEL ITENEZ/MAGDALENA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-05 10:55:24',
                'updated_at' => '2021-08-05 10:55:24',
                'deleted_at' => NULL,
            ),
            115 => 
            array (
                'id' => 616,
                'sigla' => 'JARANERAZOS',
                'nombre' => 'FABRICIO JARANERAZOS',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-05 11:31:53',
                'updated_at' => '2021-08-05 11:31:53',
                'deleted_at' => NULL,
            ),
            116 => 
            array (
                'id' => 617,
                'sigla' => 'C LUB ATLANTIS',
                'nombre' => 'CLUB ATLANTIS CENTRO ACUATICO DE ALTO RENDIMIENTO ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-05 12:14:49',
                'updated_at' => '2021-08-05 12:14:49',
                'deleted_at' => NULL,
            ),
            117 => 
            array (
                'id' => 618,
                'sigla' => 'NUEVA ISRRAEL',
                'nombre' => 'COMUNIDAD CAMPESINA NUEVA ISRRAEL/SECRETRIO GENERAL',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-05 12:41:43',
                'updated_at' => '2021-08-05 12:41:43',
                'deleted_at' => NULL,
            ),
            118 => 
            array (
                'id' => 619,
                'sigla' => 'S.E.A.E Y D.D.E',
                'nombre' => 'DIRECCION DEPARTAMENTAL DE EDUCACION "S.E.A..E"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-05 15:21:45',
                'updated_at' => '2021-08-05 15:21:45',
                'deleted_at' => NULL,
            ),
            119 => 
            array (
                'id' => 620,
                'sigla' => 'SUCRE',
                'nombre' => 'HONORABLE CONSEJO MUNICIPAL/SUCRE ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-09 10:04:23',
                'updated_at' => '2021-08-09 10:04:23',
                'deleted_at' => NULL,
            ),
            120 => 
            array (
                'id' => 621,
                'sigla' => 'EMANUEL',
                'nombre' => 'IGLESIA A.D.B. "EMANUEL" /MINISTERIO SION',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-09 13:59:18',
                'updated_at' => '2021-08-09 13:59:18',
                'deleted_at' => NULL,
            ),
            121 => 
            array (
                'id' => 622,
                'sigla' => '18 DE AGOSTO',
                'nombre' => 'JUNTA DE VECINOS 18 DE AGOSTO/DISTRITO 3 ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-09 14:11:16',
                'updated_at' => '2021-08-09 14:14:00',
                'deleted_at' => NULL,
            ),
            122 => 
            array (
                'id' => 623,
                'sigla' => 'A.D.M.T.',
                'nombre' => 'ALIANZA   DE   MOTOTAXISTA   REGIONAL  TDAD.',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-10 10:29:44',
                'updated_at' => '2021-08-10 10:29:44',
                'deleted_at' => NULL,
            ),
            123 => 
            array (
                'id' => 624,
                'sigla' => 'CRISTO ES LA V IDA ',
                'nombre' => 'MINISTERIO BAUTISTA "CRISTO ES LA VIDA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-10 10:56:09',
                'updated_at' => '2021-08-10 10:56:09',
                'deleted_at' => NULL,
            ),
            124 => 
            array (
                'id' => 625,
                'sigla' => 'SITRAHO ',
                'nombre' => 'SINDICATO DE TRABAJADORAS ASALARIADAS DEL HOGAR /GERMAN BUSH',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-10 10:58:45',
                'updated_at' => '2021-08-10 11:03:05',
                'deleted_at' => NULL,
            ),
            125 => 
            array (
                'id' => 626,
                'sigla' => 'PO',
                'nombre' => 'SHOPPING REPRODUCTORES PO Y JORNADA AGROPECUARIA 2021 ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-10 11:05:52',
                'updated_at' => '2021-08-10 11:13:53',
                'deleted_at' => NULL,
            ),
            126 => 
            array (
                'id' => 627,
                'sigla' => 'C.SAN RAMON ',
                'nombre' => 'CORREGIMIENTO SAN RAMON/PROV.MAMORE ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-10 11:26:03',
                'updated_at' => '2021-08-10 11:26:03',
                'deleted_at' => NULL,
            ),
            127 => 
            array (
                'id' => 628,
                'sigla' => '29 DE MAYO ',
                'nombre' => 'SINDICATO MIXTO DE MOTOTAXIS Y ALQUILERES DE 2,3 Y 4 RUEDAS "29 DE MAYO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-10 11:55:22',
                'updated_at' => '2021-08-10 11:55:22',
                'deleted_at' => NULL,
            ),
            128 => 
            array (
                'id' => 629,
                'sigla' => '27 DE MAYO ',
                'nombre' => 'JUNTA VECINAL "VILLA 27 DE MAYO"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-10 12:07:39',
                'updated_at' => '2021-08-10 12:23:01',
                'deleted_at' => NULL,
            ),
            129 => 
            array (
                'id' => 630,
                'sigla' => 'CASARABE ',
                'nombre' => 'SUB ALCALDIA DE CASARABE ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-10 14:25:57',
                'updated_at' => '2021-08-10 14:25:57',
                'deleted_at' => NULL,
            ),
            130 => 
            array (
                'id' => 631,
                'sigla' => 'YACUMA',
                'nombre' => 'SINDICATO DE TRANSPORTE INTERPROVINCIAL Y URBANO RAPIDO "YACUMA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-10 14:34:29',
                'updated_at' => '2021-08-10 14:34:29',
                'deleted_at' => NULL,
            ),
            131 => 
            array (
                'id' => 632,
                'sigla' => 'NUEVA MARIA',
                'nombre' => 'JUNTA VECINAL "NUEVA MARIA"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-10 14:37:18',
                'updated_at' => '2021-08-10 14:37:18',
                'deleted_at' => NULL,
            ),
            132 => 
            array (
                'id' => 633,
                'sigla' => 'FDJVDT',
                'nombre' => 'FEDERACION  DE JUNTAS  VECINALES DE  TRINIDAD  Y  PROVINCIA  CERCADO "FEJUVE"',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-11 08:57:47',
                'updated_at' => '2021-08-11 08:58:55',
                'deleted_at' => NULL,
            ),
            133 => 
            array (
                'id' => 634,
                'sigla' => 'FORESTAL',
                'nombre' => 'CAMARA FORESTAL DE BOLIVIA ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-11 10:05:25',
                'updated_at' => '2021-08-11 10:05:25',
                'deleted_at' => NULL,
            ),
            134 => 
            array (
                'id' => 635,
                'sigla' => 'C.C.C.P.B',
                'nombre' => 'COLEGIO DE CONTADORES Y CONTADORES PUBLICOS DEL BENI ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-11 10:08:41',
                'updated_at' => '2021-08-11 10:08:41',
                'deleted_at' => NULL,
            ),
            135 => 
            array (
                'id' => 636,
                'sigla' => 'SAN MARTIN ',
                'nombre' => 'COMUNIDAD CAMPESINA SAN MARTIN DE PORREZ/PROV.MARBAN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-11 10:12:04',
                'updated_at' => '2021-08-11 10:12:04',
                'deleted_at' => NULL,
            ),
            136 => 
            array (
                'id' => 637,
                'sigla' => 'MERCEDES',
                'nombre' => 'COMUNIDAD  "MERCEDES  DEL  ICHOA "',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-11 10:47:40',
                'updated_at' => '2021-08-11 10:47:40',
                'deleted_at' => NULL,
            ),
            137 => 
            array (
                'id' => 638,
                'sigla' => 'MERALYZA',
                'nombre' => 'O.T.B. URBANIZACION  MERALYSA',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-11 11:00:55',
                'updated_at' => '2021-08-11 11:00:55',
                'deleted_at' => NULL,
            ),
            138 => 
            array (
                'id' => 639,
                'sigla' => 'ARTESANOS',
                'nombre' => 'FEDERACION REGIONAL SINDICAL DE GREMIALES ARTESANOS/GUAYARAMERIN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-11 11:22:39',
                'updated_at' => '2021-08-11 11:22:39',
                'deleted_at' => NULL,
            ),
            139 => 
            array (
                'id' => 640,
                'sigla' => 'ATLETICA',
                'nombre' => 'ASOCIACION  ATLETICA  DEL  BENI',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-11 11:28:45',
                'updated_at' => '2021-08-11 11:28:45',
                'deleted_at' => NULL,
            ),
            140 => 
            array (
                'id' => 641,
                'sigla' => 'PUERTO A',
                'nombre' => 'COMITE PRO-FESTEJOS /COMUNIDAD PUERTO ALMACEN ',
                'estado' => 'ACTIVO',
                'created_at' => '2021-08-11 12:44:06',
                'updated_at' => '2021-08-11 12:44:06',
                'deleted_at' => NULL,
            ),
            141 => 
            array (
                'id' => 642,
                'sigla' => 'VACA DIEZ',
                'nombre' => 'VILLA MAYOR PEDRO VACA DIEZ (PUERTO ALMACEN"',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-11 12:53:33',
                    'updated_at' => '2021-08-11 12:53:33',
                    'deleted_at' => NULL,
                ),
                142 => 
                array (
                    'id' => 643,
                    'sigla' => 'TIPNIS ISIBORO',
                    'nombre' => 'CORREGIMIENTO SANTA CLARA RIO ISIBORO/TIPNIS',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-11 14:33:07',
                    'updated_at' => '2021-08-11 14:33:07',
                    'deleted_at' => NULL,
                ),
                143 => 
                array (
                    'id' => 644,
                    'sigla' => 'F.C.V',
                    'nombre' => 'FUNDACION SOLIDARIA CAMBIANDO VIDAS F.C.V.',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-11 14:47:48',
                    'updated_at' => '2021-08-11 14:47:48',
                    'deleted_at' => NULL,
                ),
                144 => 
                array (
                    'id' => 645,
                    'sigla' => 'LA  CASTAÑA ',
                    'nombre' => 'ASOCIACION  ACCIDENTAL "LA  CASTAÑA"',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-11 14:51:11',
                    'updated_at' => '2021-08-11 14:51:11',
                    'deleted_at' => NULL,
                ),
                145 => 
                array (
                    'id' => 646,
                    'sigla' => 'CBBA',
                    'nombre' => 'ALCALDIA DE COCHABAMBA',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-11 15:18:00',
                    'updated_at' => '2021-08-11 15:18:00',
                    'deleted_at' => NULL,
                ),
                146 => 
                array (
                    'id' => 647,
                    'sigla' => 'SALITRAL',
                    'nombre' => 'SINDICATO  DE TEJEROS  CAMPESINOS  "EL  SALITRAL "',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-11 15:39:05',
                    'updated_at' => '2021-08-11 15:39:05',
                    'deleted_at' => NULL,
                ),
                147 => 
                array (
                    'id' => 648,
                    'sigla' => 'PAITITI',
                    'nombre' => 'CENTRAL  AGROPECUARIA   DE COMUNIDADES  INTERCULTURALES  "PAITTITI-LAJA"',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-11 15:46:12',
                    'updated_at' => '2021-08-11 15:46:12',
                    'deleted_at' => NULL,
                ),
                148 => 
                array (
                    'id' => 649,
                    'sigla' => 'COORDINADORA',
                    'nombre' => 'COORDINADORA  DEPARTAMENTAL EN  DEFENZA  DE  LOS  RECURSO  NATURALES  Y  OTROS DEL  BENI',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-11 15:59:20',
                    'updated_at' => '2021-08-11 15:59:20',
                    'deleted_at' => NULL,
                ),
                149 => 
                array (
                    'id' => 650,
                    'sigla' => 'PIM',
                    'nombre' => 'GRAN CABILDO  INDIGENAL  "PEDRO  IGNACIO  MUIBA "',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-12 08:37:44',
                    'updated_at' => '2021-08-12 08:37:44',
                    'deleted_at' => NULL,
                ),
                150 => 
                array (
                    'id' => 651,
                    'sigla' => 'SEPRE',
                    'nombre' => 'SEPRET -BENI',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-12 09:15:37',
                    'updated_at' => '2021-08-12 09:15:37',
                    'deleted_at' => NULL,
                ),
                151 => 
                array (
                    'id' => 652,
                    'sigla' => 'ENTEL',
                    'nombre' => 'ENTEL S . A',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-12 10:30:32',
                    'updated_at' => '2021-08-12 10:30:32',
                    'deleted_at' => NULL,
                ),
                152 => 
                array (
                    'id' => 653,
                    'sigla' => 'FARMACIA',
                    'nombre' => 'ASOCIACION DE FARMACIA DE SAN BORJA',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-12 11:16:44',
                    'updated_at' => '2021-08-12 11:16:44',
                    'deleted_at' => NULL,
                ),
                153 => 
                array (
                    'id' => 654,
                    'sigla' => 'A.MF.S.S.AY',
                    'nombre' => 'ASOCIACION  MUNICIPAL  DE  FUTBOL    DE   SALON  DE  SANTA  ANA DEL  YACUMA',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-12 13:35:44',
                    'updated_at' => '2021-08-12 13:35:44',
                    'deleted_at' => NULL,
                ),
                154 => 
                array (
                    'id' => 655,
                    'sigla' => 'D.A',
                    'nombre' => 'MINISTERIO  DE  EDUCACION  -INCOS  BENI ',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-12 14:24:19',
                    'updated_at' => '2021-08-12 14:24:19',
                    'deleted_at' => NULL,
                ),
                155 => 
                array (
                    'id' => 656,
                    'sigla' => 'MMR',
                    'nombre' => 'URBANIZACION NERALYSA',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-12 15:44:54',
                    'updated_at' => '2021-08-12 15:46:13',
                    'deleted_at' => NULL,
                ),
                156 => 
                array (
                    'id' => 657,
                    'sigla' => 'DIRECCION DISTRITAL ',
                    'nombre' => 'DIRECCION    DE   NUCLEO   "LOMA   SUAREZ    "  UNIDAD  EDUCATIVA   CENTRAL  " ROMULO SUAREZ"   ',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-12 15:51:27',
                    'updated_at' => '2021-08-12 15:51:27',
                    'deleted_at' => NULL,
                ),
                157 => 
                array (
                    'id' => 658,
                    'sigla' => 'ELLLAB',
                    'nombre' => 'LABORATORIO IMLAB - BENI ',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-12 15:58:30',
                    'updated_at' => '2021-08-12 15:58:30',
                    'deleted_at' => NULL,
                ),
                158 => 
                array (
                    'id' => 659,
                    'sigla' => 'SSSD',
                    'nombre' => 'SINDICATO  MIXTO   DE SERVICIO  PUBLICO  " EL  TRANSPORTADOR "',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-13 09:43:24',
                    'updated_at' => '2021-08-13 09:43:24',
                    'deleted_at' => NULL,
                ),
                159 => 
                array (
                    'id' => 660,
                    'sigla' => 'COOORD',
                    'nombre' => 'COORDINADORA  " DE MUJER "',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-13 10:05:47',
                    'updated_at' => '2021-08-13 10:05:47',
                    'deleted_at' => NULL,
                ),
                160 => 
                array (
                    'id' => 661,
                    'sigla' => 'GOBBBB',
                    'nombre' => 'GOBIERNO   AUTONOMO  MUNICIPAL  DE  "SAN  RAMON " -BENI',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-13 10:18:08',
                    'updated_at' => '2021-08-13 10:18:08',
                    'deleted_at' => NULL,
                ),
                161 => 
                array (
                    'id' => 662,
                    'sigla' => 'ANSTTT',
                    'nombre' => 'INSTITUTO   DE FORMACION  ARTISTICA  "EDELMIRA   LIMPIAS"',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-13 11:05:32',
                    'updated_at' => '2021-08-13 11:05:32',
                    'deleted_at' => NULL,
                ),
                162 => 
                array (
                    'id' => 663,
                    'sigla' => 'CDNDD',
                    'nombre' => 'COMUNIDAD  INDIGENA  "NUEVA  CALAMA-PROV  ITENEZ',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-13 11:36:57',
                    'updated_at' => '2021-08-13 11:36:57',
                    'deleted_at' => NULL,
                ),
                163 => 
                array (
                    'id' => 664,
                    'sigla' => 'EMPRENDEDOR ',
                    'nombre' => 'MERCADITO   EMPRENDEDOR',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-13 11:37:22',
                    'updated_at' => '2021-08-13 11:37:22',
                    'deleted_at' => NULL,
                ),
                164 => 
                array (
                    'id' => 665,
                    'sigla' => 'MOVIMINNN',
                    'nombre' => 'MOVIMIENTO   DE MUJERES  "ACCION  Y REACCION "',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-13 11:52:18',
                    'updated_at' => '2021-08-13 11:52:18',
                    'deleted_at' => NULL,
                ),
                165 => 
                array (
                    'id' => 666,
                    'sigla' => 'UNDD',
                    'nombre' => 'UNIDAD EDUCATIVA    PRIVADA  "EL  CEDRO"',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-13 12:02:38',
                    'updated_at' => '2021-08-13 12:02:38',
                    'deleted_at' => NULL,
                ),
                166 => 
                array (
                    'id' => 667,
                    'sigla' => 'ING. CIVILES',
                    'nombre' => 'COLEGIO  DE INGENIEROS  CIVILES   DEL  BENI  -BOLIVIA ',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-13 14:46:59',
                    'updated_at' => '2021-08-13 14:46:59',
                    'deleted_at' => NULL,
                ),
                167 => 
                array (
                    'id' => 668,
                    'sigla' => 'TRIII',
                    'nombre' => '"EMPRESA TRINI  HOME "',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-13 14:49:40',
                    'updated_at' => '2021-08-13 14:49:40',
                    'deleted_at' => NULL,
                ),
                168 => 
                array (
                    'id' => 669,
                    'sigla' => 'FUNNNDCO',
                    'nombre' => 'FUNDACION   DEL  SOL  "FUNDELSOL" -SANTA  CUZ',
                    'estado' => 'ACTIVO',
                    'created_at' => '2021-08-13 15:44:27',
                    'updated_at' => '2021-08-13 15:48:34',
                    'deleted_at' => NULL,
                ),
            ));
    }
}