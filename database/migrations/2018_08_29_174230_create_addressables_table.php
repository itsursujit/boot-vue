<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addressables', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('address_id')->unsigned()->index('fk_a_address_id');
			$table->integer('addressable_id');
			$table->string('addressable_type');
			$table->boolean('is_primary')->default(0);
			$table->boolean('is_billing')->default(0);
			$table->boolean('is_shipping')->default(0);
			$table->softDeletes();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('addressables');
	}

}
