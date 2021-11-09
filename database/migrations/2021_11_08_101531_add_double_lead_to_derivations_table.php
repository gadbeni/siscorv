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
            $table->char('type',5)
                  ->after('entrada_id')
                  ->default('new');
            $table->integer('parent_id')
                  ->after('type')
                  ->nullable()
                  ->unsigned()
                  ->comment('ref parent entrada o derivacion');
            $table->string('parent_type')->nullable();
            $table->boolean('copy')
                  ->after('parent_id')
                  ->default(false);
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
            $table->dropColumn('double_lead');
            $table->dropColumn('parent_id');
            $table->dropColumn('parent_type');
            $table->dropColumn('copy');
        });
    }
}
