<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnArchiveFlagToBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->boolean('archive_flag')->after('template_name');
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
            $table->dropColumn('archive_flag');
        });
    }
}
