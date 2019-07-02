<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOptOptInFieldsToBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {
            $table->enum('opt_in_type', ['none', 'standard', 'img-online', 'img-upload', 'vid-youtube', 'vid-vimeo', 'vid-other'])
                ->default('none')->after('opt_opt_in');
            $table->string('opt_in_youtube_url')->nullable()->after('opt_in_type');
            $table->string('opt_in_vimeo_url')->nullable()->after('opt_in_youtube_url');
            $table->text('opt_in_video_code')->nullable()->after('opt_in_vimeo_url');
            $table->boolean('opt_in_video_auto_play')->after('opt_in_video_code');
            $table->string('image_url')->nullable()->after('opt_in_video_auto_play');
            $table->string('image_upload')->nullable()->after('image_url');
            $table->string('call_to_action')->default('Call To Action Text Here')->after('image_upload');
            $table->string('subscribe_text')->default('Enter Your Name And Email Below...')->after('call_to_action');
            $table->string('subscribe_text_color', 30)->default('#ffffff')->after('subscribe_text');
            $table->enum('opt_in_button_type', ['match_main_button', 'square', 'rounded'])->default('match_main_button')->after('subscribe_text_color');
            $table->string('opt_in_button_label')->default('Click Here!')->after('opt_in_button_type');
            $table->string('opt_in_button_bg_color', 30)->default('#515f7f')->after('opt_in_button_label');
            $table->string('opt_in_button_label_color', 30)->default('#ffffff')->after('opt_in_button_bg_color');
            $table->enum('opt_in_button_animation', ['none', 'on_load', 'on_hover', 'on_load_on_hover', 'repeat_6_seconds', 'repeat_6_seconds_on_hover'])
                ->default('none')->after('opt_in_button_label_color');
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
            $table->dropColumn('opt_in_type');
            $table->dropColumn('opt_in_youtube_url');
            $table->dropColumn('opt_in_vimeo_url');
            $table->dropColumn('opt_in_video_code');
            $table->dropColumn('opt_in_video_auto_play');
            $table->dropColumn('image_url');
            $table->dropColumn('image_upload');
            $table->dropColumn('call_to_action');
            $table->dropColumn('subscribe_text');
            $table->dropColumn('subscribe_text_color');
            $table->dropColumn('opt_in_button_type');
            $table->dropColumn('opt_in_button_label');
            $table->dropColumn('opt_in_button_bg_color');
            $table->dropColumn('opt_in_button_label_color');
            $table->dropColumn('opt_in_button_animation');
        });
    }
}
