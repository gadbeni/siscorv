<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnlaceFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enlace_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enlace_id')->nullable()->constrained('enlaces');
            $table->string('nombre_origen')->nullable();
            $table->string('ruta')->nullable();
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
        Schema::dropIfExists('enlace_files');
    }
}
