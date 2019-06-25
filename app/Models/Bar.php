<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    protected $fillable = [
        'user_id', 'type', 'link_click', 'email_options', 'total_views', 'unique_views', 'status', 'group_id', 'opt_appearance', 'headline', 'subheadline',
        'headlinecolor', 'subheadlinecolor', 'bggradient', 'backgroundcolorstart', 'backgroundcolorend', 'bggradientangle', 'dropshadow', 'opacity',
        'videocode', 'videoautoplay', 'description', 'opt_settings', 'position', 'issticky', 'pushcontentdown', 'showonexit', 'trigger', 'xseconds', 'percentscroll',
        'frequency', 'showclosebutton', 'requiredreferer', 'html',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
