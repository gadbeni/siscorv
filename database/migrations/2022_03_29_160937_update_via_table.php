<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateViaTable extends Migration
{
    public function up()
    {
        Schema::table('vias', function (Blueprint $table) {
            $table->integer('people_id')->nullable();
        });
    }


    public function down()
    {
        Schema::table('vias', function (Blueprint $table) {
            $table->dropColumn('people_id');
        });
    }
}
