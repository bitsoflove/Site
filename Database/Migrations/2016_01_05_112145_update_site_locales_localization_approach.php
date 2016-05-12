<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Site\Entities\SiteLocale;

class UpdateSiteLocalesLocalizationApproach extends Migration {

    private $map = [
        1 => 'be_NL',
        2 => 'be_FR',
        3 => 'be_EN',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_locales', function(Blueprint $table)
        {
            //first create a locale column
            $table->string('locale')->index();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       //whatever
    }

}
