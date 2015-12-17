<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_user', function(Blueprint $table)
		{
				$table->integer('site_id')->unsigned();
				$table->integer('user_id')->unsigned();

				//$table->foreign('site_id')->references('id')->on('sites')->onUpdate('RESTRICT')->onDelete('RESTRICT');
				//$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_user');
	}

}
