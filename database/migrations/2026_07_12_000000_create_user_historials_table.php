<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_historials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Usuario modificado');
            $table->unsignedBigInteger('changed_by')->nullable()->comment('Usuario que hizo el cambio');
            $table->string('accion', 20)->comment('creado, actualizado, activado, desactivado, eliminado, restaurado');
            $table->text('antes')->nullable()->comment('Snapshot JSON antes del cambio');
            $table->text('despues')->nullable()->comment('Snapshot JSON despues del cambio');
            $table->timestamps();

            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('changed_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_historials');
    }
}
