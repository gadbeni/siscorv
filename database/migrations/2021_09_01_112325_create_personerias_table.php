<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersoneriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personerias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_ingreso');
            $table->string('hojaruta')->nullable();
            $table->string('representante')->nullable();
            $table->string('ci')->nullable();
            $table->decimal('costo_personeria', 9, 2);
            $table->decimal('costo_valoragregado', 9, 2);
            $table->string('caratula_notarial')->nullable();
            $table->string('caratula_expediente')->nullable();
            $table->string('folder_expediente')->nullable();
            $table->string('numero_testimonio')->nullable();
            $table->string('numero_resolucion')->nullable();
            $table->date('fecha_resolucion')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->date('fecha_conclusion')->nullable(); //fecha de conclusion del tramite
            $table->string('archivo')->nullable();
            
            //campos para coordinacion municipal
            $table->string('numero_certificado')->nullable();
            $table->string('documento_municipal')->nullable();
            $table->string('numero_documento')->nullable();
            $table->string('fecha_numerodocumento', 10)->nullable();

            $table->foreignId('reserva_id')->constrained();
            $table->foreignId('departamento_id')->constrained(); //donde fue expedido
            $table->foreignId('objeto_id')->constrained('organizations');
            $table->foreignId('ambitoaplicacion_id')->constrained('organizations');
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('personerias');
    }
}
