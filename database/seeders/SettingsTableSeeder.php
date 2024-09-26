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
                'details' => '',
                'display_name' => 'Site Title',
                'group' => 'Site',
                'id' => 1,
                'key' => 'site.title',
                'order' => 1,
                'type' => 'text',
                'value' => 'SISCOR',
            ),
            1 => 
            array (
                'details' => '',
                'display_name' => 'Site Description',
                'group' => 'Site',
                'id' => 2,
                'key' => 'site.description',
                'order' => 2,
                'type' => 'text',
                'value' => 'Sistema para la administración de correspondencias del Gobierno Autónomo Departamental del Beni',
            ),
            2 => 
            array (
                'details' => '',
                'display_name' => 'Site Logo',
                'group' => 'Site',
                'id' => 3,
                'key' => 'site.logo',
                'order' => 3,
                'type' => 'image',
                'value' => '',
            ),
            3 => 
            array (
                'details' => '',
                'display_name' => 'Google Analytics Tracking ID',
                'group' => 'Site',
                'id' => 4,
                'key' => 'site.google_analytics_tracking_id',
                'order' => 4,
                'type' => 'text',
                'value' => NULL,
            ),
            4 => 
            array (
                'details' => '',
                'display_name' => 'Admin Background Image',
                'group' => 'Admin',
                'id' => 5,
                'key' => 'admin.bg_image',
                'order' => 4,
                'type' => 'image',
                'value' => '',
            ),
            5 => 
            array (
                'details' => '',
                'display_name' => 'Admin Title',
                'group' => 'Admin',
                'id' => 6,
                'key' => 'admin.title',
                'order' => 1,
                'type' => 'text',
                'value' => 'SISCOR',
            ),
            6 => 
            array (
                'details' => '',
                'display_name' => 'Admin Description',
                'group' => 'Admin',
                'id' => 7,
                'key' => 'admin.description',
                'order' => 1,
                'type' => 'text',
                'value' => 'Sistema para la administración de correspondencia',
            ),
            7 => 
            array (
                'details' => '',
                'display_name' => 'Admin Loader',
                'group' => 'Admin',
                'id' => 8,
                'key' => 'admin.loader',
                'order' => 2,
                'type' => 'image',
                'value' => '',
            ),
            8 => 
            array (
                'details' => '',
                'display_name' => 'Admin Icon Image',
                'group' => 'Admin',
                'id' => 9,
                'key' => 'admin.icon_image',
                'order' => 3,
                'type' => 'image',
                'value' => '',
            ),
            9 => 
            array (
                'details' => '',
            'display_name' => 'Google Analytics Client ID (used for admin dashboard)',
                'group' => 'Admin',
                'id' => 10,
                'key' => 'admin.google_analytics_client_id',
                'order' => 5,
                'type' => 'text',
                'value' => NULL,
            ),
            10 => 
            array (
                'details' => NULL,
                'display_name' => 'Dirección',
                'group' => 'Site',
                'id' => 11,
                'key' => 'site.direccion',
                'order' => 6,
                'type' => 'text',
                'value' => 'Plaza José Ballivian acera sur, Santísima Trinidad - Beni',
            ),
            11 => 
            array (
                'details' => NULL,
                'display_name' => 'Telefono',
                'group' => 'Site',
                'id' => 12,
                'key' => 'site.telefono',
                'order' => 7,
                'type' => 'text',
                'value' => '346-21651',
            ),
            12 => 
            array (
                'details' => NULL,
                'display_name' => 'Email',
                'group' => 'Site',
                'id' => 13,
                'key' => 'site.email',
                'order' => 8,
                'type' => 'text',
                'value' => 'despacho@beni.gob.bo',
            ),
            13 => 
            array (
                'details' => NULL,
                'display_name' => 'Twitter',
                'group' => 'Redes sociales',
                'id' => 14,
                'key' => 'redes-sociales.twitter',
                'order' => 9,
                'type' => 'text',
                'value' => 'https://twitter.com',
            ),
            14 => 
            array (
                'details' => NULL,
                'display_name' => 'Facebook',
                'group' => 'Redes sociales',
                'id' => 15,
                'key' => 'redes-sociales.facebook',
                'order' => 10,
                'type' => 'text',
                'value' => 'https://facebook.com',
            ),
            15 => 
            array (
                'details' => NULL,
                'display_name' => 'Instagram',
                'group' => 'Redes sociales',
                'id' => 16,
                'key' => 'redes-sociales.instagram',
                'order' => 11,
                'type' => 'text',
                'value' => 'https://instagram.com',
            ),
            16 => 
            array (
                'details' => NULL,
                'display_name' => 'Linkedin',
                'group' => 'Redes sociales',
                'id' => 17,
                'key' => 'redes-sociales.linkedin',
                'order' => 12,
                'type' => 'text',
                'value' => 'https://linkedin.com',
            ),
            17 => 
            array (
                'details' => NULL,
                'display_name' => 'Sistema en Mantenimiento',
                'group' => 'Configuración',
                'id' => 18,
                'key' => 'configuracion.maintenance',
                'order' => 1,
                'type' => 'checkbox',
                'value' => '1',
            ),
            18 => 
            array (
                'details' => '',
                'display_name' => 'Navidad',
                'group' => 'Configuración',
                'id' => 19,
                'key' => 'configuracion.navidad',
                'order' => 1,
                'type' => 'checkbox',
                'value' => '0',
            ),
            19 => 
            array (
                'details' => NULL,
                'display_name' => 'Whatsapp',
                'group' => 'Servidores',
                'id' => 20,
                'key' => 'servidores.whatsapp',
                'order' => 13,
                'type' => 'text',
                'value' => NULL,
            ),
            20 => 
            array (
                'details' => NULL,
                'display_name' => 'Sesión Whatsapp',
                'group' => 'Servidores',
                'id' => 21,
                'key' => 'servidores.whatsapp-session',
                'order' => 14,
                'type' => 'text',
                'value' => NULL,
            ),
            21 => 
            array (
                'details' => NULL,
                'display_name' => 'Activar logo adicional',
                'group' => 'NCI',
                'id' => 27,
                'key' => 'nci.activate_logo',
                'order' => 15,
                'type' => 'checkbox',
                'value' => '1',
            ),
            22 => 
            array (
                'details' => NULL,
                'display_name' => 'Logo adicional en NCI',
                'group' => 'NCI',
                'id' => 28,
                'key' => 'nci.imagen',
                'order' => 16,
                'type' => 'image',
                'value' => '',
            ),
        ));
        
        
    }
}