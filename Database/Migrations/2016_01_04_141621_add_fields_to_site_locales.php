<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToSiteLocales extends Migration {

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
            $table->string('logo');
            $table->string('theme');
            $table->string('google_analytics_code');
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
            $table->dropColumn('logo');
            $table->dropColumn('theme');
            $table->dropColumn('google_analytics_code');
        });
    }

}
