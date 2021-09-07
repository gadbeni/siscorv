<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entradas', function (Blueprint $table) {
            $table->foreignId('category_id')
                  ->nullable()
                  ->after('tipo_id')
                  ->constrained();
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
            $table->dropColumn('category_id');
        });
    }
}
