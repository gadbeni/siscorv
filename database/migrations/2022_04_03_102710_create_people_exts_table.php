<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleExtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_exts', function (Blueprint $table) {
            $table->id();
            $table->integer('person_id')->nullable();
            $table->integer('direccion_id')->nullable();
            $table->integer('unidad_id')->nullable();
            $table->string('cargo')->nullable();
            $table->string('observacion')->nullable();
            $table->smallInteger('status')->default(1);
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
        Schema::dropIfExists('people_exts');
    }
}
