<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectorioTelefonicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directorio_telefonicos', function (Blueprint $table) {
            $table->id();
            $table->string('cargo_responsable');
            $table->string('nombre');
            $table->string('numero_interno');
            $table->unsignedBigInteger('direccion_id')->nullable();
            $table->unsignedBigInteger('unidad_id')->nullable();
            $table->unsignedBigInteger('directorio_grupo_id')->nullable();
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
        Schema::dropIfExists('directorio_telefonicos');
    }
}
