<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventAudienceInvolvementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_audience_involvements', function(Blueprint $table)
		{
			$table->foreign('event_id', 'fk_eai_event_id')->references('id')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('event_audience_involvements', function(Blueprint $table)
		{
			$table->dropForeign('fk_eai_event_id');
		});
	}

}
