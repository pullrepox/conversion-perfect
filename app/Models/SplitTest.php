<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SplitTest extends Model
{
    protected $table = 'split_tests';
    
    protected $fillable = ['user_id', 'bar_id', 'split_bar_name', 'split_bar_weight'];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function bar()
    {
        return $this->belongsTo('App\Models\Bar', 'bar_id');
    }
}
