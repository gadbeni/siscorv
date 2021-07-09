<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivados', function (Blueprint $table) {
            $table->id();
            $table->string('lugar')->nullable();
            $table->string('observacion')->nullable();
            $table->string('estado', 20)->nullable();
            $table->string('registrado_por', 30)->nullable();

            $table->foreignId('estado_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('entrada_id')
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
        Schema::dropIfExists('archivados');
    }
}
