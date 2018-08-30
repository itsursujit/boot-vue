<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('region_id')->unsigned()->index('fk_r_region_id');
			$table->smallInteger('country_id')->unsigned();
			$table->decimal('latitude', 10, 8);
			$table->decimal('longitude', 11, 8);
			$table->string('name');
			$table->index(['country_id','region_id','name'], 'country_region_name');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cities');
	}

}
