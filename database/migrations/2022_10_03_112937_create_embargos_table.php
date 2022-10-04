<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmbargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('embargos', function (Blueprint $table) {
            $table->id();
            $table->integer('nro')->nullable();
            $table->string('nroPiet', 500)->nullable();
            $table->string('fechaPiet')->nullable();
            $table->string('rutNit', 500)->nullable();
            $table->string('ci',50)->nullable();
            $table->string('nombre', 500)->nullable();
            $table->decimal('montoEmbargo', 10, 3)->nullable();
            $table->string('notaEmbargo', 500)->nullable();

            $table->decimal('montoLevantamiento', 10, 3)->nullable();
            $table->string('notaLevantamiento', 500)->nullable();


            $table->smallInteger('status')->default(1);
            $table->integer('nroImportacion')->nullable();
            $table->date('fechaImportacion')->nullable();
            $table->integer('people_id')->nullable();
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
        Schema::dropIfExists('embargos');
    }
}
