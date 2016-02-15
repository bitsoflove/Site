<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteLocalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_locales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('site_id')->unsigned()->index('site_locales_site_id_foreign');
			$table->string('title', 100);
			$table->string('url');
			$table->text('description', 16777215);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_locales');
	}

}
