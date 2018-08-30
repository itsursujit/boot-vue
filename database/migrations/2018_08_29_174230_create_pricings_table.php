<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePricingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pricings', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('product_id')->unsigned()->index('fk_p_product_id');
			$table->string('title')->nullable();
			$table->string('slogan')->nullable();
			$table->float('price', 15);
			$table->float('discount_rate', 15);
			$table->float('discount_amount', 15);
			$table->string('currency');
			$table->text('description', 65535)->nullable();
			$table->softDeletes();
			$table->dateTime('cancelled_at')->nullable();
			$table->boolean('is_cancelled')->nullable()->default(0);
			$table->boolean('is_deleted')->nullable()->default(0);
			$table->boolean('is_active')->nullable()->default(0);
			$table->boolean('is_published')->nullable()->default(0);
			$table->dateTime('booking_start_ts')->nullable();
			$table->dateTime('booking_end_ts')->nullable();
			$table->dateTime('marketing_start_ts')->nullable();
			$table->dateTime('marketing_end_ts')->nullable();
			$table->dateTime('audience_start_ts')->nullable();
			$table->dateTime('audience_end_ts')->nullable();
			$table->boolean('is_public')->nullable()->default(1);
			$table->boolean('is_closed_group')->nullable()->default(0);
			$table->integer('audience_type')->nullable();
			$table->boolean('allow_prebook')->nullable();
			$table->integer('status')->default(1);
			$table->timestamps();
			$table->boolean('is_recurring')->nullable()->default(0);
			$table->integer('recurring_period')->nullable();
			$table->string('recurring_unit', 20)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pricings');
	}

}
