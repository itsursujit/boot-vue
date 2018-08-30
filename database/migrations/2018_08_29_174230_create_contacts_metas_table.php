<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsMetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts_metas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('contact_id')->unsigned()->index('fk_cm_contact_id');
			$table->string('key');
			$table->string('value')->nullable();
			$table->integer('status')->default(1);
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
		Schema::drop('contacts_metas');
	}

}
