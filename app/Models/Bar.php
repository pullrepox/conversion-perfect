<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    protected $fillable = [
        'user_id', 'type', 'friendly_name', 'position', 'group_id', 'headline', 'headline_color', 'background_color', 'opt_preview',
        'opt_display', 'show_bar_type', 'frequency', 'delay_in_seconds', 'scroll_point_percent',
        'opt_content', 'sub_headline', 'sub_headline_color', 'sub_background_color', 'video_type', 'content_youtube_url', 'content_vimeo_url', 'video_code', 'video_auto_play',
        'opt_appearance', 'opacity', 'drop_shadow', 'close_button', 'background_gradient', 'gradient_end_color', 'gradient_angle', 'powered_by_position',
        'opt_button', 'button_type', 'button_location', 'button_label', 'button_background_color', 'button_text_color', 'button_animation', 'button_action', 'button_click_url',
        'button_open_new',
        'opt_countdown', 'countdown', 'countdown_location', 'countdown_format', 'countdown_end_date', 'countdown_end_time', 'countdown_timezone', 'countdown_days', 'countdown_hours',
        'countdown_minutes', 'countdown_background_color', 'countdown_text_color', 'countdown_on_expiry', 'countdown_expiration_text', 'countdown_expiration_url',
        'opt_overlay', 'third_party_url', 'custom_link', 'custom_link_text', 'meta_title', 'meta_description', 'meta_keywords',
        'opt_autoresponder', 'integration_type', 'list', 'after_submit', 'message', 'autohide_delay_seconds', 'redirect_url',
        'opt_opt_in', 'opt_custom_text'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
