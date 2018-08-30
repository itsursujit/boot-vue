<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('title')->nullable()->index('idx_1');
			$table->string('slogan')->nullable()->index('idx_2');
			$table->text('description', 65535)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->dateTime('cancelled_at')->nullable();
			$table->boolean('is_cancelled')->nullable()->default(0);
			$table->boolean('is_deleted')->nullable()->default(0);
			$table->boolean('is_active')->nullable()->default(0);
			$table->boolean('is_published')->nullable()->default(0);
			$table->string('status', 45)->nullable();
			$table->dateTime('start_ts')->nullable()->index('idx_3');
			$table->dateTime('end_ts')->nullable()->index('idx_4');
			$table->integer('location_id')->nullable();
			$table->dateTime('marketing_start_ts')->nullable();
			$table->dateTime('marketing_end_ts')->nullable();
			$table->dateTime('audience_start_ts')->nullable();
			$table->dateTime('audience_end_ts')->nullable();
			$table->boolean('is_public')->nullable()->default(1);
			$table->boolean('is_closed_group')->nullable()->default(0);
			$table->integer('audience_type')->nullable()->index('fk_02_idx');
			$table->string('uuid', 45)->nullable();
			$table->boolean('is_recurring')->nullable()->default(0);
			$table->string('recurring_type', 45)->nullable();
			$table->boolean('allow_prebook')->nullable();
			$table->float('price', 15);
			$table->float('discount_rate', 15);
			$table->float('discount_amount', 15);
			$table->string('currency');
			$table->integer('user_id')->nullable();
			$table->integer('site_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}
