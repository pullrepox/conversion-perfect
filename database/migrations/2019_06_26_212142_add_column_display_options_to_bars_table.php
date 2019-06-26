<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDisplayOptionsToBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->enum('show_bar_type', ['immediate', 'delay', 'scroll', 'exit'])->after('opt_display')->default('immediate');
            $table->enum('frequency', ['every', 'day', 'week', 'once'])->after('show_bar_type')->default('every');
            $table->double('delay_in_seconds')->after('frequency')->default(0);
            $table->double('scroll_point_percent')->after('delay_in_seconds')->default(0);
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
            $table->dropColumn('show_bar_type');
            $table->dropColumn('frequency');
            $table->dropColumn('delay_in_seconds');
            $table->dropColumn('scroll_point_percent');
        });
    }
}
