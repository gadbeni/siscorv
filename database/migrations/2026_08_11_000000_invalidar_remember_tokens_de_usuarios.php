<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Invalida todos los "remember tokens" ya emitidos.
 *
 * Hasta ahora el login mostraba el checkbox "Recordarme", que hacia que Laravel
 * guardara en el navegador una cookie remember_web_* valida por 576000 minutos
 * (unos 400 dias). Con esa cookie el sistema reautenticaba en silencio: el
 * funcionario apagaba su equipo y al dia siguiente entraba sin credenciales.
 *
 * Quitar el checkbox evita emitir cookies nuevas, pero las ya guardadas en los
 * navegadores seguirian funcionando. Esta migracion vacia la columna
 * remember_token, con lo que esas cookies dejan de validar y todos los equipos
 * que hoy entran solos vuelven a pedir usuario y contrasena.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'remember_token')) {
            return;
        }

        DB::table('users')->whereNotNull('remember_token')->update(['remember_token' => null]);
    }

    /**
     * No hay rollback posible ni deseable: los tokens anteriores se descartaron
     * a proposito. Revertir significaria volver a dejar sesiones permanentes.
     */
    public function down(): void
    {
        //
    }
};
