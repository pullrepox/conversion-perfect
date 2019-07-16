<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    protected $fillable = [
        'user_id', 'group_id', 'friendly_name', 'position', 'headline', 'headline_color', 'background_color',
        'show_bar_type', 'frequency', 'delay_in_seconds', 'scroll_point_percent', 'opacity',
        'drop_shadow', 'close_button', 'background_gradient', 'gradient_end_color', 'gradient_angle', 'powered_by_position',
        'sub_headline', 'sub_headline_color', 'sub_background_color', 'video_type', 'content_youtube_url', 'content_vimeo_url', 'video_code', 'video_auto_play',
        'button_type', 'button_location', 'button_label', 'button_background_color', 'button_text_color', 'button_animation', 'button_action', 'button_click_url', 'button_open_new',
        'countdown', 'countdown_location', 'countdown_format', 'countdown_end_date', 'countdown_end_time', 'countdown_timezone', 'countdown_days', 'countdown_hours',
        'countdown_minutes', 'countdown_background_color', 'countdown_text_color', 'countdown_on_expiry', 'countdown_expiration_text', 'countdown_expiration_url',
        'third_party_url', 'custom_link', 'custom_link_text', 'meta_title', 'meta_description', 'meta_keywords',
        'integration_type', 'list', 'after_submit', 'message', 'autohide_delay_seconds', 'redirect_url',
        'opt_in_type', 'opt_in_youtube_url', 'opt_in_vimeo_url', 'opt_in_video_code', 'opt_in_video_auto_play', 'image_url', 'image_upload', 'call_to_action', 'panel_color',
        'subscribe_text', 'subscribe_text_color', 'opt_in_button_type', 'opt_in_button_label', 'opt_in_button_bg_color', 'opt_in_button_label_color', 'opt_in_button_animation',
        'days_label', 'hours_label', 'minutes_label', 'seconds_label', 'opt_in_name_placeholder', 'opt_in_email_placeholder', 'powered_by_label', 'disclaimer', 'template_name'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function logs()
    {
        return $this->hasMany('App\Models\BarsClickLogs');
    }
}
