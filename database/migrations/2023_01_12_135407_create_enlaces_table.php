<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enlaces', function (Blueprint $table) {
            $table->id();
            $table->date('fechaNota')->nullable();
            $table->string('cite')->nullable();
            $table->string('entidad')->nullable();
            $table->string('institucion')->nullable();
            $table->string('destinatario')->nullable();
            $table->text('referencia')->nullable();
            $table->date('fechaEntidad')->nullable();
            
            $table->smallInteger('status')->default(1);
            $table->foreignId('registerUser_id')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('deleteUser_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enlaces');
    }
}
