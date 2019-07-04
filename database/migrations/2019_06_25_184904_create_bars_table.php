<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('group_id')->index();
            $table->string('friendly_name');
            $table->enum('position', ['top_sticky', 'top', 'bottom']);
            $table->text('headline')->nullable();
            $table->string('headline_color', 50)->nullable();
            $table->string('background_color', 50)->nullable();
            $table->boolean('opt_preview');
            
            $table->boolean('opt_display')->default(0);
            $table->enum('show_bar_type', ['immediate', 'delay', 'scroll', 'exit'])->default('immediate');
            $table->enum('frequency', ['every', 'day', 'week', 'once'])->default('every');
            $table->double('delay_in_seconds')->default(0);
            $table->double('scroll_point_percent')->default(0);
            
            $table->boolean('opt_content')->default(0);
            $table->text('sub_headline')->nullable();
            $table->string('sub_headline_color', 50)->default('#666666');
            $table->string('sub_background_color', 50)->nullable();
            $table->enum('video_type', ['none', 'youtube', 'vimeo', 'other'])->default('none');
            $table->string('content_youtube_url')->nullable();
            $table->string('content_vimeo_url')->nullable();
            $table->text('video_code')->nullable();
            $table->boolean('video_auto_play')->default(0);
            
            $table->boolean('opt_appearance')->default(0);
            $table->tinyInteger('opacity')->default(100);
            $table->boolean('drop_shadow');
            $table->boolean('close_button');
            $table->boolean('background_gradient');
            $table->string('gradient_end_color', 50)->nullable();
            $table->tinyInteger('gradient_angle');
            $table->enum('powered_by_position', ['bottom_right', 'bottom_left', 'top_left', 'hidden'])->default('bottom_right');
            
            $table->boolean('opt_button')->default(0);
            $table->enum('button_type', ['none', 'square', 'rounded'])->default('none');
            $table->enum('button_location', ['right', 'left', 'below_text'])->default('right');
            $table->string('button_label', 100)->nullable();
            $table->string('button_background_color', 10)->default('#515f7f');
            $table->string('button_text_color', 10)->default('#FFFFFF');
            $table->enum('button_animation', ['none', 'on_load', 'on_hover', 'on_load_on_hover', 'repeat_6_seconds', 'repeat_6_seconds_on_hover'])->default('none');
            $table->enum('button_action', ['hide_bar', 'open_click_url'])->default('hide_bar');
            $table->string('button_click_url')->nullable();
            $table->boolean('button_open_new')->default(0);
            
            $table->boolean('opt_countdown')->default(0);
            $table->enum('countdown', ['none', 'calendar', 'evergreen'])->default('none');
            $table->enum('countdown_location', ['left', 'right', 'left_edge', 'right_edge', 'below_text'])->default('left');
            $table->enum('countdown_format', ['dd', 'hh', 'mm'])->default('dd');
            $table->date('countdown_end_date');
            $table->time('countdown_end_time');
            $table->string('countdown_timezone', 50);
            $table->tinyInteger('countdown_days');
            $table->tinyInteger('countdown_hours');
            $table->tinyInteger('countdown_minutes');
            $table->string('countdown_background_color', 100)->default('#3BAF85');
            $table->string('countdown_text_color', 100)->default('#FFFFFF');
            $table->enum('countdown_on_expiry', ['hide_bar', 'redirect', 'display_text'])->default('hide_bar');
            $table->string('countdown_expiration_text')->nullable();
            $table->string('countdown_expiration_url')->nullable();
            
            $table->boolean('opt_overlay')->default(0);
            $table->string('third_party_url')->nullable();
            $table->tinyInteger('custom_link');
            $table->string('custom_link_text')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->boolean('opt_autoresponder');
            $table->string('integration_type')->default('none')->index();
            $table->string('list')->nullable()->index();
            $table->enum('after_submit', ['show_message', 'show_message_hide_bar', 'redirect'])->default('show_message');
            $table->text('message')->nullable();
            $table->double('autohide_delay_seconds')->nullable();
            $table->string('redirect_url')->nullable();
            
            $table->boolean('opt_opt_in')->default(0);
            $table->enum('opt_in_type', ['none', 'standard', 'img-online', 'img-upload', 'vid-youtube', 'vid-vimeo', 'vid-other'])->default('none');
            $table->string('opt_in_youtube_url')->nullable();
            $table->string('opt_in_vimeo_url')->nullable();
            $table->text('opt_in_video_code')->nullable();
            $table->boolean('opt_in_video_auto_play');
            $table->string('image_url')->nullable();
            $table->string('image_upload')->nullable();
            $table->text('call_to_action');
            $table->text('subscribe_text');
            $table->string('subscribe_text_color', 30)->default('#666666');
            $table->enum('opt_in_button_type', ['match_main_button', 'square', 'rounded'])->default('match_main_button');
            $table->string('opt_in_button_label')->default('Click Here!');
            $table->string('opt_in_button_bg_color', 30)->default('#515f7f');
            $table->string('opt_in_button_label_color', 30)->default('#ffffff');
            $table->enum('opt_in_button_animation', ['none', 'on_load', 'on_hover', 'on_load_on_hover', 'repeat_6_seconds', 'repeat_6_seconds_on_hover'])
                ->default('none');
            $table->string('panel_color', 30)->nullable();
            
            $table->boolean('opt_custom_text')->default(0);
            $table->string('days_label', 100)->default('Days');
            $table->string('hours_label', 100)->default('Hours');
            $table->string('minutes_label', 100)->default('Minutes');
            $table->string('seconds_label', 100)->default('Seconds');
            $table->string('opt_in_name_placeholder')->default('Your Name');
            $table->string('opt_in_email_placeholder')->default('you@yourdomain.com');
            $table->string('powered_by_label')->default('Powered by');
            $table->string('disclaimer')->default('We respect your privacy and will never share your information.');
            
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unique(['user_id', 'id']);
            $table->engine = 'InnoDB';
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bars');
    }
}
