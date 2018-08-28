<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestrictionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('restrictions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('restriction_rule_id')->nullable()->index('fk_rules_application_idx');
			$table->string('applies_to', 100)->nullable()->comment('Events, tickets, registration, rules, participants, sponsors');
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
		Schema::drop('restrictions');
	}

}
