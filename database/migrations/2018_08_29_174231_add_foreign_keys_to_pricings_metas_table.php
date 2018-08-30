<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPricingsMetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pricings_metas', function(Blueprint $table)
		{
			$table->foreign('pricing_id', 'fk_pm_pricing_id')->references('id')->on('pricings')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pricings_metas', function(Blueprint $table)
		{
			$table->dropForeign('fk_pm_pricing_id');
		});
	}

}
