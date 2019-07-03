<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = 'bonuses';
    
    protected $fillable = [
        'plans', 'title', 'description', 'image_url', 'bonus_url', 'link_text', 'new_window'
    ];
}
