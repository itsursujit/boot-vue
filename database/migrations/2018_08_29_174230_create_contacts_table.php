<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', array('individual','organization'))->default('individual');
			$table->string('first_name')->nullable();
			$table->string('middle_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('company_name')->nullable();
			$table->string('phone', 32)->nullable();
			$table->string('mobile', 32)->nullable();
			$table->string('fax', 32)->nullable();
			$table->string('email')->nullable();
			$table->string('website')->nullable();
			$table->integer('status')->default(1);
			$table->softDeletes();
			$table->timestamps();
			$table->integer('contactable_id')->nullable();
			$table->string('contactable_type')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contacts');
	}

}
