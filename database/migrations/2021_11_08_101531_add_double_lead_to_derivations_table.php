<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoubleLeadToDerivationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('derivations', function (Blueprint $table) {
            $table->integer('parent_id')
                  ->after('entrada_id')
                  ->nullable()
                  ->unsigned()
                  ->comment('ref parent entrada o derivacion');
            $table->string('parent_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('derivations', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('parent_type');
        });
    }
}
