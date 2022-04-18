<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDerivacionsTable extends Migration
{
    public function up()
    {
        Schema::table('derivations', function (Blueprint $table) {
            $table->integer('people_id_de')->nullable();
            $table->integer('people_id_para')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('derivations', function (Blueprint $table) {
            $table->dropColumn('people_id_de');
            $table->dropColumn('people_id_para');
        });
    }
}
