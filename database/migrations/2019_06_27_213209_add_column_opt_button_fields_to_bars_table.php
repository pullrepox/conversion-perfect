<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOptButtonFieldsToBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->enum('button_type', ['none', 'square', 'rounded'])->default('none')->after('opt_button');
            $table->enum('button_location', ['right', 'left', 'below_text'])->default('right')->after('button_type');
            $table->string('button_label', 100)->nullable()->after('button_location');
            $table->string('button_background_color', 10)->default('#515f7f')->after('button_label');
            $table->string('button_text_color', 10)->default('#FFFFFF')->after('button_background_color');
            $table->enum('button_animation', ['none', 'crazy_shake', 'money_make_shake', 'lazy_shake'])->default('none')->after('button_text_color');
            $table->enum('button_action', ['hide_bar', 'open_click_url'])->default('hide_bar')->after('button_animation');
            $table->string('button_click_url')->nullable()->after('button_action');
            $table->boolean('button_open_new')->default(0)->after('button_click_url');
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
            $table->dropColumn('button_type');
            $table->dropColumn('button_location');
            $table->dropColumn('button_label');
            $table->dropColumn('button_background_color');
            $table->dropColumn('button_text_color');
            $table->dropColumn('button_animation');
            $table->dropColumn('button_action');
            $table->dropColumn('button_click_url');
            $table->dropColumn('button_open_new');
        });
    }
}
