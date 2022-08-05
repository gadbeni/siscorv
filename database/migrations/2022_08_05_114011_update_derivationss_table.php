<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDerivationssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('derivations', function (Blueprint $table) {
            $table->smallInteger('transferred')->default(0);
            $table->text('transferredDetails')->nullable();
            $table->integer('transferredPeople_id')->nullable();
            $table->dateTime('transferredDate')->nullable();
            $table->foreignId('transferredUser_id')->nullable()->constrained('users');

        });
    }


    public function down()
    {
        Schema::table('derivations', function (Blueprint $table) {
        
        });
    }
}
