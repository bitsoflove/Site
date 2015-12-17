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
				$table->integer('site_id')->unsigned()->nullable()->index('site_user_site_id_foreign');
				$table->integer('user_id')->unsigned()->nullable()->index('site_user_user_id_foreign');

				$table->foreign('site_id')->references('id')->on('sites')->onUpdate('RESTRICT')->onDelete('RESTRICT');
				$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$table->dropForeign('page__pages_site_id_foreign');
		Schema::drop('site_user');
	}

}
