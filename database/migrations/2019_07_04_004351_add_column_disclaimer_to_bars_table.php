<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDisclaimerToBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->string('disclaimer')->after('subscribe_text_color')->default('We respect your privacy and will never share your information.');
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
            $table->dropColumn('disclaimer');
        });
    }
}
