<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restrictions', function (Blueprint $table) {
            $table->integer('restrictable_id')->nullable();
            $table->string('restrictable_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restrictions', function (Blueprint $table) {
            $table->dropColumn('restrictable_id');
            $table->dropColumn('restrictable_type');
        });
    }
}
