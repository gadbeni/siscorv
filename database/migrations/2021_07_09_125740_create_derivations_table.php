<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDerivationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('derivations', function (Blueprint $table) {
            $table->id();
            $table->string('funcionario_id_de', 10)->nullable();
            $table->string('funcionario_id_para', 10)->nullable();
            $table->string('funcionario_nombre_para', 100)->nullable();
            $table->string('funcionario_cargo_id_para', 10)->nullable();
            $table->string('funcionario_cargo_para', 150)->nullable();
            $table->string('funcionario_direccion_id_para', 10)->nullable();
            $table->string('funcionario_direccion_para', 150)->nullable();
            $table->string('funcionario_unidad_id_para', 10)->nullable();
            $table->string('funcionario_unidad_para', 150)->nullable();
            $table->char('responsable_actual', 1)->nullable();
            $table->char('logico', 1)->nullable()->default('1');
            $table->char('fisico', 1)->nullable()->default('0');
            $table->dateTime('fecha_fisico')->nullable();
            $table->string('observacion')->nullable();
            $table->string('estado', 10)->nullable();
            $table->string('registro_por', 30)->nullable();
            $table->dateTime('fecha_registro')->nullable();
            $table->string('actualizado_por', 30)->nullable();
            $table->dateTime('fecha_actualizacion')->nullable();
            $table->dateTime('visto')->nullable();
            $table->integer('rechazo')->nullable();
            $table->foreignId('entrada_id')
                  ->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('derivations');
    }
}
