<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_addresses', function(Blueprint $table)
		{
			$table->foreign('address_id', 'fk_ea_address_id')->references('id')->on('addresses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('event_id', 'fk_ea_event_id')->references('id')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('event_addresses', function(Blueprint $table)
		{
			$table->dropForeign('fk_ea_address_id');
			$table->dropForeign('fk_ea_event_id');
		});
	}

}
