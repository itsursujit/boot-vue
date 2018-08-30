<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_id')->unsigned()->nullable()->index('index2');
			$table->bigInteger('user_id')->unsigned()->nullable()->index('index3');
			$table->boolean('status')->nullable()->default(1);
			$table->timestamps();
			$table->softDeletes();
			$table->index(['account_id','user_id','status'], 'index4');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accounts_users');
	}

}
