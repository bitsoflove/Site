<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSiteIdToMediaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media__files', function(Blueprint $table)
        {
            $table->integer('site_id')->unsigned()->nullable()->index();
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
        Schema::table('media__files', function(Blueprint $table)
        {
            $table->dropColumn('site_id');
        });
    }

}
