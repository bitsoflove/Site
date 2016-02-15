<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSiteLocalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('site_locales', function(Blueprint $table)
		{
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
		Schema::table('site_locales', function(Blueprint $table)
		{
			$table->dropForeign('site_locales_site_id_foreign');
		});
	}

}
