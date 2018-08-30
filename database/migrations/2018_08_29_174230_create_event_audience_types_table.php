<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventAudienceTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_audience_types', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('audience_type_id')->nullable()->index('fk_05_idx');
			$table->bigInteger('event_id')->nullable()->index('fk_06_idx');
			$table->timestamps();
			$table->softDeletes();
			$table->boolean('is_cancelled')->nullable()->default(0);
			$table->boolean('is_active')->nullable()->default(0);
			$table->boolean('is_public')->nullable()->default(1);
			$table->string('status', 45)->nullable()->default('1');
			$table->boolean('is_deleted')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_audience_types');
	}

}
