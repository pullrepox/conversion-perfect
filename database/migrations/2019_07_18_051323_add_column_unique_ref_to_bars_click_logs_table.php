<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUniqueRefToBarsClickLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars_click_logs', function (Blueprint $table) {
            $table->string('unique_ref')->nullable()->after('cookie')->index();
            $table->dropColumn('unique_click_per_day');
            $table->dropColumn('country_code3');
            $table->dropColumn('region');
            $table->dropColumn('postal_code');
            $table->dropColumn('area_code');
            $table->dropColumn('continent_code');
            $table->dropColumn('language_pref');
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
            $table->dropColumn('unique_ref');
            $table->boolean('unique_click_per_day');
            $table->string('country_code3', 3)->nullable();
            $table->string('region', 2)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->bigInteger('area_code');
            $table->string('continent_code', 2)->nullable();
            $table->string('language_pref', 100)->nullable();
        });
    }
}
