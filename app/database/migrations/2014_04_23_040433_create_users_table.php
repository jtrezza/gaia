<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user', 50);
			$table->string('email', 120);
			$table->string('fullname', 255);
			$table->string('bio', 160);
			$table->string('location', 120);
			$table->string('website', 120);
			$table->longtext('following');
			$table->longtext('followed');
			$table->longtext('favorites');
			$table->string('password', 40);
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
		Schema::drop('users');
	}

}
