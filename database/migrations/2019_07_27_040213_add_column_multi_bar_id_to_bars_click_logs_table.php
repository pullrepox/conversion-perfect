<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMultiBarIdToBarsClickLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars_click_logs', function (Blueprint $table) {
            $table->bigInteger('multi_bar_id')->after('split_bar_id')->default(0);
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
            $table->dropColumn('multi_bar_id');
        });
    }
}
