<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    protected $fillable = [
        'user_id', 'type', 'friendly_name', 'position', 'group_id', 'headline', 'headline_color', 'background_color', 'opt_preview',
        'opt_display', 'show_bar_type', 'frequency', 'delay_in_seconds', 'scroll_point_percent',
        'opt_content', 'sub_headline', 'sub_headline_color', 'sub_background_color', 'video', 'video_code', 'video_auto_play',
        'opt_appearance', 'opacity', 'drop_shadow', 'close_button', 'background_gradient', 'gradient_end_color', 'gradient_angle', 'powered_by_position',
        'opt_button', 'opt_countdown', 'opt_overlay', 'opt_opt_in', 'opt_custom_text', 'html',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
