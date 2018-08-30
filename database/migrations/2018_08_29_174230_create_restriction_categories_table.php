<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestrictionCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('restriction_categories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('category', 100)->nullable();
			$table->string('description', 100)->nullable();
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
		Schema::drop('restriction_categories');
	}

}
