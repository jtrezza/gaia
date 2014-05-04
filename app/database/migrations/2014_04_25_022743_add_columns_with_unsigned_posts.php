<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsWithUnsignedPosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->bigInteger('rt_id')->unsigned()->nullable();
			$table->bigInteger('reply_to')->unsigned()->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->dropColumn('user_id');
			$table->dropColumn('rt_id');
			$table->dropColumn('reply_to');
		});
	}

}
