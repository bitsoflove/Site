<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToFilterSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filter_site', function (Blueprint $table) {
            $table->foreign('site_id', 'filter_site_site_id')
                ->references('id')
                ->on('sites');
            
            $table->foreign('filter_id', 'filter_site_filter_id')
                ->references('id')
                ->on('filters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filter_site', function (Blueprint $table) {
            $table->dropForeign('filter_site_site_id');
            $table->dropForeign('filter_site_filter_id');
        });
    }
}
