<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsWithoutUnsignedPosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->dropColumn('user_id');
			$table->dropColumn('rt_id');
			$table->dropColumn('reply_to');
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
			$table->integer('user_id');
			$table->bigInteger('rt_id');
			$table->bigInteger('reply_to');
		});
	}

}
