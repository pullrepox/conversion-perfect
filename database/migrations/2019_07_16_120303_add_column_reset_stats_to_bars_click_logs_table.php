<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnResetStatsToBarsClickLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars_click_logs', function (Blueprint $table) {
            $table->boolean('reset_stats')->after('split_bar_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bars_click_logs', function (Blueprint $table) {
            $table->dropColumn('bars_click_logs');
        });
    }
}
