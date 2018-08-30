<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventsSponsorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events_sponsors', function(Blueprint $table)
		{
			$table->foreign('event_id', 'fk_es_event_id')->references('id')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('events_sponsors', function(Blueprint $table)
		{
			$table->dropForeign('fk_es_event_id');
		});
	}

}
