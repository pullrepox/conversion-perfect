<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultiBar extends Model
{
    protected $table = 'multi_bars';
    
    protected $fillable = ['user_id', 'bar_ids', 'multi_bar_name'];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function getBarIdsAttribute()
    {
        return explode(',', $this->attributes['bar_ids']);
    }
}
