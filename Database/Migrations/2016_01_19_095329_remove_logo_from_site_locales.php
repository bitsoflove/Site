<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveLogoFromSiteLocales extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('site_locales', function(Blueprint $table)
        {
            //facebook open graph tags
            $table->dropColumn('logo');
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
            $table->string('logo');
        });
	}

}
