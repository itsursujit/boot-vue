<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestrictionRulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('restriction_rules', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('restriction_category_id')->nullable()->index('fk_rs_category_idx');
			$table->string('restriction_label', 100)->nullable();
			$table->string('restriction_value', 100)->nullable();
			$table->boolean('is_allowed')->nullable()->default(0);
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
		Schema::drop('restriction_rules');
	}

}
