<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajeEnviadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensaje_enviados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_persona');
            $table->string('phone');
            $table->text('message');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('entrada_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('fecha_envio');
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
        Schema::dropIfExists('mensaje_enviados');
    }
}
