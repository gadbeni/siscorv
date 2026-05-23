<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entradas', function (Blueprint $table) {
            $table->index('hr');
            $table->index('cite');
            $table->index('people_id_para');
            $table->index('people_id_de');
            $table->index('deleted_at');
            $table->index('created_at');
            $table->index('remitente');
        });

        Schema::table('derivations', function (Blueprint $table) {
            $table->index('people_id_para');
            $table->index('people_id_de');
            $table->index('ok');
            $table->index('transferred');
            $table->index('deleted_at');
            $table->index('visto');
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
            $table->dropIndex(['hr']);
            $table->dropIndex(['cite']);
            $table->dropIndex(['people_id_para']);
            $table->dropIndex(['people_id_de']);
            $table->dropIndex(['deleted_at']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['remitente']);
        });

        Schema::table('derivations', function (Blueprint $table) {
            $table->dropIndex(['people_id_para']);
            $table->dropIndex(['people_id_de']);
            $table->dropIndex(['ok']);
            $table->dropIndex(['transferred']);
            $table->dropIndex(['deleted_at']);
            $table->dropIndex(['visto']);
        });
    }
}
