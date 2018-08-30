<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_addresses', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('event_id')->nullable()->index('fk_ea_event_id');
			$table->bigInteger('address_id')->unsigned()->nullable()->index('fk_ea_address_id');
			$table->timestamps();
			$table->softDeletes();
			$table->dateTime('cancelled_at')->nullable();
			$table->boolean('is_cancelled')->nullable()->default(0);
			$table->boolean('is_deleted')->nullable()->default(0);
			$table->boolean('is_active')->nullable()->default(0);
			$table->boolean('is_published')->nullable()->default(0);
			$table->string('status', 45)->nullable();
			$table->dateTime('start_ts')->nullable();
			$table->dateTime('end_ts')->nullable();
			$table->dateTime('marketing_start_ts')->nullable();
			$table->dateTime('marketing_end_ts')->nullable();
			$table->dateTime('audience_start_ts')->nullable();
			$table->dateTime('audience_end_ts')->nullable();
			$table->boolean('is_public')->nullable()->default(1);
			$table->boolean('is_closed_group')->nullable()->default(0);
			$table->integer('audience_type')->nullable();
			$table->string('uuid', 45)->nullable();
			$table->boolean('is_recurring')->nullable()->default(0);
			$table->string('recurring_type', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_addresses');
	}

}
