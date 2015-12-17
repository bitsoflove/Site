<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSiteIdToPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('page__pages', function(Blueprint $table)
		{
				$table->integer('site_id')->unsigned()->nullable()->index('page__pages_site_id_foreign');
				$table->foreign('site_id')->references('id')->on('sites')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('page__pages', function(Blueprint $table)
		{
				$table->dropForeign('page__pages_site_id_foreign');
				$table->dropColumn('site_id');

		});
	}

}
