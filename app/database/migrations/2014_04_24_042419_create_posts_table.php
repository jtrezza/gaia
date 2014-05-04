<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->integer('user_id');
			$table->string('text',140)->nullable();
			$table->bigInteger('rt_id')->nullable();
			$table->bigInteger('reply_to')->nullable();
			$table->longText('reposted')->nullable();
			$table->longText('favorited')->nullable();
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
		Schema::drop('posts');
	}

}
