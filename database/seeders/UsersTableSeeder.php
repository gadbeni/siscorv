<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'name' => 'Javier Condori',
                'email' => 'javier.condori',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$xkMuKNtQuO5eyJE1ZiwZL.nKhVODDspHmlHsKsBkPc.PIWs5PMHmm',
                'remember_token' => 'V74tyOpgiixSKFugB45WBjpeHFnvpHjUQJSmvdchBULsQq5a6bFPY9LfW7NQ',
                'settings' => NULL,
                'created_at' => '2020-12-21 10:01:44',
                'updated_at' => '2021-01-11 12:07:31',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 2,
                'name' => 'Jimena Jimenez',
                'email' => 'jimena.jimenez',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$HDeXwZurB/Up0k2kPrjD8.IXQp1Y6/Q2bHGH9GPuWulvEaioY2nT6',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-12-21 10:01:44',
                'updated_at' => '2020-12-21 10:01:44',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'role_id' => 1,
                'name' => 'GUIVER GARCIA LEON',
                'email' => 'guiver.garcia',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$1SXIwGmhMXm/tDsn.z2zNeKS13DLrcS65/JMk/hfH7fH6anLxgbgW',
                'remember_token' => 'dGp14G55J0xP2IU36H8m0fR0pmEYhPHU86LK8ZE5oGQGPe5RFs9yzrT1lDHI',
                'settings' => NULL,
                'created_at' => '2020-12-22 10:58:31',
                'updated_at' => '2020-12-28 16:04:44',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'role_id' => 2,
                'name' => 'CARLOS  COCARICO RAPU',
                'email' => 'carlos.cocarico',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$O3k7H2nxTQ6k65Ew3FVkCONDv6c6kd0VQl.c2cIpYWBULJWtHABua',
                'remember_token' => '0B4ZveUzv6gJf1WGoiDxjcSSZ9Q2VaH7aqXwJHNzsEe7JyupVVCeDlHS47Ni',
                'settings' => NULL,
                'created_at' => '2020-12-22 11:10:26',
                'updated_at' => '2021-03-15 08:32:34',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'role_id' => 3,
                'name' => 'FANOR  AMAPO YUBANERA',
                'email' => 'fanor.amapo',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$r1oWbxTuW7lPg/J0Udta2e3qfl4p7A9PqeOaU56KIl9MuFUvf5O6q',
                'remember_token' => 'hnKYB7Q7s4k6UIivqf1DaNlHUC3ksgWqwV0GsOuKR2oasCXicoNbJMtJrlzh',
                'settings' => NULL,
                'created_at' => '2020-12-22 11:11:10',
                'updated_at' => '2021-01-07 11:14:55',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'role_id' => 1,
                'name' => 'SERGIO  COCA MARTINEZ',
                'email' => 'sergio.coca',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$entities10$ixnJhCtOjXfIPXvSvfIZUuwGnHqvxJ7ZWENHRRB8DsfPpSvH4aQ6e',
                'remember_token' => 'HzYp5lJPuxd2vCk4RidPBMTn2QCYQku5FY0g9lULY63DQc0ZneW07JKUKBkM',
                'settings' => NULL,
                'created_at' => '2020-12-22 15:47:36',
                'updated_at' => '2020-12-28 08:55:31',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'role_id' => 2,
                'name' => 'YRMA LUZ BANEGAS NOE',
                'email' => 'yrma.luz',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$/Y/8BpP54Ptcf566zJYG9O.lq6NorMG7BKm/dIUQ.H41AuG6g7A6m',
                'remember_token' => 'FGjvpLOGTov4dGvOOonfMkwO2YZhvS80DZy4YRM6oTdu0cTlWtl0ujcnA554',
                'settings' => NULL,
                'created_at' => '2020-12-28 12:09:27',
                'updated_at' => '2021-01-11 19:09:33',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'role_id' => 3,
                'name' => 'MESIAS MESAC ZABALA PALMA',
                'email' => 'mesias.mesac',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$N49DyLDrlDOHfsV0fd.NZuZ2Gq5bRYIvaxwwPQwy7w23HtoLfzdEW',
                'remember_token' => 'ERqcMjC6iFbZuNJEAFKOx6JBqiTdvB4EXqxzK2gPRIId7n2m98iO8mGUEFOK',
                'settings' => NULL,
                'created_at' => '2020-12-28 12:43:30',
                'updated_at' => '2020-12-29 10:08:14',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'role_id' => 3,
                'name' => 'MARITA  NOE RODRIGUEZ',
                'email' => 'marita.noe',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$gH1TTeUVS5Dv9rD.on77mOHHthbuI/H1y1QTaEF59Sh/99kcUvEv.',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-12-29 09:44:40',
                'updated_at' => '2020-12-29 09:44:40',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'role_id' => 3,
                'name' => 'LAUREANO  PEDRIEL  EGUEZ',
                'email' => 'laureano.pedriel',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$/kfHtjuJW4gInBnR7uOR0OW1x8Uoi9R4Jcv9MPEnzW1EdmQgLTdMi',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-12-29 09:45:39',
                'updated_at' => '2020-12-29 09:45:39',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'role_id' => 3,
                'name' => 'SANTIAGO  ARRAZOLA  VACA',
                'email' => 'santiago.arrazola',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$LQRmaLAXHDQn52ed5vgMt.rQhOFUhLJRx/yJmIlZh/rbLUFsoICbu',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-12-29 09:46:43',
                'updated_at' => '2020-12-29 09:46:43',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'role_id' => NULL,
                'name' => 'CRISTIAN JEHÚ NOE ROSALES',
                'email' => 'cristian.jehu',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$rRppZTTY7wGvA3MfHZH1Uu8FI.BF1Yu9L3p16famfAtBxZxSWP6/.',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-12-29 09:52:07',
                'updated_at' => '2020-12-29 09:52:07',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'role_id' => 3,
                'name' => 'ALEXANDER  FRANCO DIEZ',
                'email' => 'alexander.franco',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$EvIuNcVM7qeoAa3.Hq4uuODfbfSJmktxwoAW5GAVCXCCk81nyVw/u',
                'remember_token' => '0lc625aEa3wPwgu0lQ4xgmi0iHsxNYy3SAxSRGVypn7lxt9G5QDHAZ81EOLs',
                'settings' => NULL,
                'created_at' => '2020-12-29 09:53:53',
                'updated_at' => '2020-12-29 11:14:41',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'role_id' => 3,
                'name' => 'MARLENY  TEREBA ESCALANTE',
                'email' => 'marleny.tereba',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$//F1GRIu5/4.riXijoh0L.xFe/8g2p5M6M4XVSd298aKQFs7ZvGUi',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-12-29 09:55:24',
                'updated_at' => '2020-12-29 09:55:24',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'role_id' => 3,
                'name' => 'INGRID JAZMÍN CHURIPUY SALOMÓN',
                'email' => 'ingrid.churipuy',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$1EfkMISR/2i3ikJFuIFAOudpZa7lv3Y3Y4bQQCsplfS1M/mz1fcai',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-12-29 09:56:57',
                'updated_at' => '2020-12-29 09:56:57',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'role_id' => 3,
                'name' => 'CHRISTIAN  NOTO SAAVEDRA',
                'email' => 'christian.noto',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$uzMYVlfALWxbWPc7YarWGu3peHIvSmDu6RfD55HDy2fmSNEXt.s8i',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-12-29 10:13:45',
                'updated_at' => '2020-12-29 10:13:45',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'role_id' => 1,
                'name' => 'AUGUSTO  CARVALHO CHÁVEZ',
                'email' => 'augustogany',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$lUX/Om2dT3E/JyE1yXIIWe5JD4Q8BXknxhGTe5/zfSjjMPabloV1K',
                'remember_token' => 'nBzxfPrDsDWUG0EE64WvuDtF0lQrlAaP419aljsEspKtbK92TxaQ7PSj9GqA',
                'settings' => NULL,
                'created_at' => '2021-01-06 10:07:44',
                'updated_at' => '2021-06-28 10:20:27',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 19,
                'role_id' => 2,
                'name' => 'CAROLINA  CARBALHO SUAREZ',
                'email' => 'carolina',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$mUf32YQa5cVNYbg4AEZdwuU2pRkeceobxjB4XZ0yWiStWP.V/E5la',
                'remember_token' => 'NhNlVN0JNvOo8dFON1FlM3iJLM0TlA6v7BFgegsUWIGqAkJZTLNcIbXK4IJW',
                'settings' => NULL,
                'created_at' => '2021-02-10 10:41:23',
                'updated_at' => '2021-07-14 09:06:44',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 20,
                'role_id' => 1,
                'name' => 'DARIENT GERARDO PEÑA GARCIA',
                'email' => 'darientg',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$hjhJfCLYKVaihaj7CLqXVOe78jx35WNhEHUbnNX8Ap7rIdhtJxoku',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2021-05-25 08:27:03',
                'updated_at' => '2021-05-25 08:27:03',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 21,
                'role_id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$piw47ZDCJq3ieZXMVap/2eo1j71yvn4g2LNCxJu7b/7JEgq/8Q4oG',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2021-06-01 21:05:11',
                'updated_at' => '2021-06-01 21:05:11',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}