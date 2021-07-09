<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->nullable();
            $table->string('ap_paterno', 100)->nullable();
            $table->string('ap_materno', 100)->nullable();
            $table->string('ci', 50)->nullable();
            $table->string('tipo', 50)->nullable();
            $table->string('oficina', 3)->nullable();
            $table->string('estado', 10)->nullable();
            $table->string('registrado_por', 50)->nullable();
            $table->date('fecha_baja')->nullable();
            $table->string('baja_por', 50)->nullable();
            $table->char('alfanum',2)
                  ->nullable()
                  ->comment('para los certificados');
            $table->string('full_name')
                  ->comment('para los certificados');
            $table->foreignId('departamento_id')
                   ->nullable()
                   ->constrained();
            $table->integer('funcionario_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained();
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
        Schema::dropIfExists('personas');
    }
}
