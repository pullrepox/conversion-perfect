<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOptCountdownFieldsToBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->enum('countdown', ['none', 'calendar', 'evergreen'])->default('none')->after('opt_countdown');
            $table->enum('countdown_location', ['left', 'right', 'below_text'])->default('left')->after('countdown');
            $table->enum('countdown_format', ['dd', 'hh', 'mm'])->default('dd')->after('countdown_location');
            $table->date('countdown_end_date')->after('countdown_format');
            $table->time('countdown_end_time')->after('countdown_end_date');
            $table->string('countdown_timezone', 50)->after('countdown_end_time');
            $table->tinyInteger('countdown_days')->after('countdown_timezone');
            $table->tinyInteger('countdown_hours')->after('countdown_days');
            $table->tinyInteger('countdown_minutes')->after('countdown_hours');
            $table->string('countdown_background_color', 100)->default('#3BAF85')->after('countdown_minutes');
            $table->string('countdown_text_color', 100)->default('#FFFFFF')->after('countdown_background_color');
            $table->enum('countdown_on_expiry', ['hide_bar', 'redirect', 'display_text'])->default('hide_bar')->after('countdown_text_color');
            $table->string('countdown_expiration_text')->nullable()->after('countdown_on_expiry');
            $table->string('countdown_expiration_url')->nullable()->after('countdown_expiration_text');
            
            $table->dropColumn('html');
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
            $table->dropColumn('countdown');
            $table->dropColumn('countdown_location');
            $table->dropColumn('countdown_format');
            $table->dropColumn('countdown_end_date');
            $table->dropColumn('countdown_end_time');
            $table->dropColumn('countdown_timezone');
            $table->dropColumn('countdown_days');
            $table->dropColumn('countdown_hours');
            $table->dropColumn('countdown_minutes');
            $table->dropColumn('countdown_background_color');
            $table->dropColumn('countdown_text_color');
            $table->dropColumn('countdown_on_expiry');
            $table->dropColumn('countdown_expiration_text');
            $table->dropColumn('countdown_expiration_url');
            $table->text('html')->nullable();
        });
    }
}
