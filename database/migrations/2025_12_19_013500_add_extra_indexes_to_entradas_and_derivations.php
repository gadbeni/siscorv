<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraIndexesToEntradasAndDerivations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entradas', function (Blueprint $table) {
            // Check if indexes exist before adding (Laravel doesn't have a clean way, but we'll try)
            // Generally we assume they don't from previous logs
            $table->index('estado_id');
            $table->index('entity_id');
            $table->index('category_id');
            $table->index('tipo');
            $table->index('gestion');
            $table->index('urgent');
            $table->index('personeria');
        });

        Schema::table('derivations', function (Blueprint $table) {
            $table->index('entrada_id');
            $table->index('parent_id');
            $table->index('parent_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entradas', function (Blueprint $table) {
            $table->dropIndex(['estado_id']);
            $table->dropIndex(['entity_id']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['tipo']);
            $table->dropIndex(['gestion']);
            $table->dropIndex(['urgent']);
            $table->dropIndex(['personeria']);
        });

        Schema::table('derivations', function (Blueprint $table) {
            $table->dropIndex(['entrada_id']);
            $table->dropIndex(['parent_id']);
            $table->dropIndex(['parent_type']);
            $table->dropIndex(['created_at']);
        });
    }
}
