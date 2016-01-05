<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\SiteLocale;

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

        //then iterate all the rows, use $this->map to set the right Locale from locale_id
        $rows = SiteLocale::all();
        foreach($rows as $row) {
            $row->locale = $this->map[$row->locale_id];
            $row->save();
        }

        Schema::table('site_locales', function(Blueprint $table)
        {
            //then remove the locale_id column
            $table->dropForeign('site_locales_locale_id_foreign');
            $table->dropColumn('locale_id');
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
            //first create a locale_id column
            $table->integer('locale_id')->references('id')->on('locales')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        //then iterate all the rows, use $this->map to set the right locale_id from locale
        $rows = SiteLocale::all();
        $map = array_flip($this->map);
        foreach($rows as $row) {
            $row->locale_id = $map[$row->locale];
            $row->save();
        }

        Schema::table('site_locales', function(Blueprint $table)
        {
            //then remove the locale column
            $table->dropColumn('locale');
        });
    }

}
