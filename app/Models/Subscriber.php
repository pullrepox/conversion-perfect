<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'list_id', 'email_address', 'user_name', 'ip_address'
    ];
    
    protected $casts = [
        'list_id' => 'email_list',
    ];
    
    public function email_list()
    {
        return $this->belongsTo(EmailList::class);
    }
}
