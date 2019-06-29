<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnButtonAnimationInBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            DB::statement("ALTER TABLE `bars` CHANGE `button_animation` `button_animation` ENUM('none','on_load','on_hover','on_load_on_hover','repeat_6_seconds','repeat_6_seconds_on_hover') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;");
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
