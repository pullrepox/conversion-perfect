<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnButtonClickToBarsClickLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars_click_logs', function (Blueprint $table) {
            $table->boolean('button_click')->after('unique_click_per_day');
            $table->boolean('lead_capture')->after('button_click');
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
            $table->dropColumn('button_click');
            $table->dropColumn('lead_capture');
        });
    }
}
