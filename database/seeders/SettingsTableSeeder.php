<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'site.title',
                'display_name' => 'Site Title',
                'value' => 'SISCOR',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'site.description',
                'display_name' => 'Site Description',
                'value' => 'Sistema para la administración de correspondencias del Gobierno Autónomo Departamental del Beni',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Site',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'site.logo',
                'display_name' => 'Site Logo',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Site',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'site.google_analytics_tracking_id',
                'display_name' => 'Google Analytics Tracking ID',
                'value' => NULL,
                'details' => '',
                'type' => 'text',
                'order' => 4,
                'group' => 'Site',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'admin.bg_image',
                'display_name' => 'Admin Background Image',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 4,
                'group' => 'Admin',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'admin.title',
                'display_name' => 'Admin Title',
                'value' => 'SISCOR',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'admin.description',
                'display_name' => 'Admin Description',
                'value' => 'Sistema para la administración de correspondencia',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'admin.loader',
                'display_name' => 'Admin Loader',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 2,
                'group' => 'Admin',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'admin.icon_image',
                'display_name' => 'Admin Icon Image',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Admin',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'admin.google_analytics_client_id',
            'display_name' => 'Google Analytics Client ID (used for admin dashboard)',
                'value' => NULL,
                'details' => '',
                'type' => 'text',
                'order' => 5,
                'group' => 'Admin',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'site.direccion',
                'display_name' => 'Dirección',
                'value' => 'Plaza José Ballivian acera sur, Santísima Trinidad - Beni',
                'details' => NULL,
                'type' => 'text',
                'order' => 6,
                'group' => 'Site',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'site.telefono',
                'display_name' => 'Telefono',
                'value' => '346-21651',
                'details' => NULL,
                'type' => 'text',
                'order' => 7,
                'group' => 'Site',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'site.email',
                'display_name' => 'Email',
                'value' => 'despacho@beni.gob.bo',
                'details' => NULL,
                'type' => 'text',
                'order' => 8,
                'group' => 'Site',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'redes-sociales.twitter',
                'display_name' => 'Twitter',
                'value' => 'https://twitter.com',
                'details' => NULL,
                'type' => 'text',
                'order' => 9,
                'group' => 'Redes sociales',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'redes-sociales.facebook',
                'display_name' => 'Facebook',
                'value' => 'https://facebook.com',
                'details' => NULL,
                'type' => 'text',
                'order' => 10,
                'group' => 'Redes sociales',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'redes-sociales.instagram',
                'display_name' => 'Instagram',
                'value' => 'https://instagram.com',
                'details' => NULL,
                'type' => 'text',
                'order' => 11,
                'group' => 'Redes sociales',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'redes-sociales.linkedin',
                'display_name' => 'Linkedin',
                'value' => 'https://linkedin.com',
                'details' => NULL,
                'type' => 'text',
                'order' => 12,
                'group' => 'Redes sociales',
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'configuracion.maintenance',
                'display_name' => 'Sistema en Mantenimiento',
                'value' => '1',
                'details' => NULL,
                'type' => 'checkbox',
                'order' => 1,
                'group' => 'Configuración',
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'configuracion.navidad',
                'display_name' => 'Navidad',
                'value' => '0',
                'details' => '',
                'type' => 'checkbox',
                'order' => 1,
                'group' => 'Configuración',
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'servidores.whatsapp',
                'display_name' => 'Whatsapp',
                'value' => '',
                'details' => NULL,
                'type' => 'text',
                'order' => 13,
                'group' => 'Servidores',
            ),
        ));
        
        
    }
}