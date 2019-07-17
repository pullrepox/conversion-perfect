<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{
    protected $fillable = [
        'alias', 'description', 'jvzooid', 'showwasupgrade', 'unlessuserhas'
    ];
}
