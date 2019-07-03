<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class EmailList extends Model
{
    protected $table = 'email_lists';
    
    protected $fillable = [
        'user_id', 'list_name', 'description'
    ];
    
    protected $casts = [
        'user_id' => 'user',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function subscribers()
    {
        return $this->hasMany('App\Models\Subscriber', 'list_id', 'id');
    }
}
