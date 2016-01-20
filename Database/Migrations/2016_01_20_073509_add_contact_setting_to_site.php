<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContactSettingToSite extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_locales', function(Blueprint $table)
        {
            $table->string('contact_email');
            $table->string('contact_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function(Blueprint $table)
        {
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_name');
        });
    }

}
