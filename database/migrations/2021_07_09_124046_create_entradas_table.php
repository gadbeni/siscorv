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
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->integer('gestion')->nullable();
            $table->smallInteger('personeria')->nullable();
            $table->char('tipo', 1)->nullable();
            $table->string('hr', 20)->nullable();
            $table->string('remitente', 150)->nullable();
            $table->string('cite', 50)->nullable();
            $table->text('referencia')->nullable();
            $table->string('nro_hojas')->nullable();
            
            $table->string('funcionario_id_remitente', 10)->nullable();
            $table->integer('unidad_id_remitente')->nullable();
            $table->integer('direccion_id_remitente')->nullable();
            $table->integer('funcionario_id_destino')->nullable();

            $table->integer('people_id_de')->nullable();
            $table->string('job_de')->nullable();
            $table->integer('people_id_para')->nullable();
            $table->string('job_para')->nullable();
            


            $table->string('funcionario_id_responsable', 10)->nullable();
            //$table->string('estado', 20)->nullable();

            $table->string('registrado_por', 30)->nullable();
            $table->integer('registrado_por_id_direccion')->nullable();
            $table->integer('registrado_por_id_unidad')->nullable();
            $table->dateTime('fecha_registro')->nullable();
            $table->string('actualizado_por', 30)->nullable();
            $table->dateTime('fecha_actualizacion')->nullable();
            $table->text('observacion_rechazo')->nullable();
            $table->text('detalles')->nullable();
            $table->json('details')->nullable();

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
        Schema::dropIfExists('entradas');
    }
}
