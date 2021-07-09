<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDerivacionAccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('derivacion_accion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('derivation_id')
                    ->nullable()
                    ->constrained()
                    ->onDelete('cascade');
            $table->foreignId('acction_id')
                    ->nullable()
                    ->constrained()
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('derivacion_accion');
    }
}
