<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAddressablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('addressables', function(Blueprint $table)
		{
			$table->foreign('address_id', 'fk_a_address_id')->references('id')->on('addresses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('addressables', function(Blueprint $table)
		{
			$table->dropForeign('fk_a_address_id');
		});
	}

}
