<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->integer('gestion')->nullable();
            $table->char('tipo', 1)->nullable();
            $table->string('hr', 20)->nullable();
            $table->string('remitente', 150)->nullable();
            $table->string('cite', 50)->nullable();
            $table->string('referencia')->nullable();
            $table->string('nro_hojas', 30)->nullable();
            $table->string('funcionario_id_remitente', 10)->nullable();
            $table->string('funcionario_id_responsable', 10)->nullable();
            $table->string('estado', 20)->nullable();

            $table->string('registrado_por', 30)->nullable();
            $table->integer('registrado_por_id_direccion')->nullable();
            $table->integer('registrado_por_id_unidad')->nullable();
            $table->dateTime('fecha_registro')->nullable();
            $table->string('actualizado_por', 30)->nullable();
            $table->dateTime('fecha_actualizacion')->nullable();

            // FK Entity
            $table->foreignId('entity_id')
                  ->nullable()
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            // FK status
            $table->foreignId('estado_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('cascade');
            
                  // FK status
            $table->foreignId('tipo_id')
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
        Schema::dropIfExists('entradas');
    }
}
