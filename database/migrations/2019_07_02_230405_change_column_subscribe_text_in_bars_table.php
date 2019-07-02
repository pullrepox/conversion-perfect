<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnSubscribeTextInBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            DB::statement("ALTER TABLE `bars` CHANGE `call_to_action` `call_to_action` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;");
            DB::statement("ALTER TABLE `bars` CHANGE `subscribe_text` `subscribe_text` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;");
            DB::statement("UPDATE `bars` SET `call_to_action` = ''");
            DB::statement("UPDATE `bars` SET `subscribe_text` = ''");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bars', function (Blueprint $table) {
            //
        });
    }
}
