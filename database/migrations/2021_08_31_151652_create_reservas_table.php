<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_solicitante')->nullable();
            $table->string('nombre')->nullable();
            $table->string('localidad')->nullable();
            $table->string('numero_recibo')->nullable();
            $table->decimal('costo_reserva', 9, 2);
            $table->date('fecha_inicio');
            $table->date('fecha_conclusion')->nullable();
            $table->foreignId('municipio_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('estado_id')->constrained();
            $table->foreignId('warehouse_id')->constrained();
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
        Schema::dropIfExists('reservas');
    }
}
