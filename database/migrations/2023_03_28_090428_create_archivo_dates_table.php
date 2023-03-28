<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivoDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivo_dates', function (Blueprint $table) {

            //Para cambio de fecha del tramite con notas de respaldo por interfaz
            $table->id();
            $table->foreignId('entrada_id')->nullable()->constrained('entradas');
            $table->datetime('dateActual')->nullable();
            $table->datetime('dateHistoria')->nullable();
            $table->text('file')->nullable();
            $table->text('observation')->nullable();

            $table->timestamps();
            $table->foreignId('registerUser_id')->nullable()->constrained('users');
            $table->softDeletes();
            $table->foreignId('deletedUser_id')->nullable()->constrained('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivo_dates');
    }
}
