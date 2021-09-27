<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_data', function (Blueprint $table) {
            $table->id();
            $table->string('numero_resolucion', 955)->nullable();
            $table->string('fecha_resolucion', 955)->nullable();
            $table->string('razon_social', 955)->nullable();
            $table->string('provincia', 955)->nullable();
            $table->string('municipio', 955)->nullable();
            $table->string('localidad', 955)->nullable();
            $table->string('objeto', 955)->nullable();
            $table->foreignId('warehouse_id')
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
        Schema::dropIfExists('old_data');
    }
}
