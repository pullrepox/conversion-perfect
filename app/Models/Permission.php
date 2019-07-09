<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'description', 'am_plans', 'am_upgrade_required', 'am_maximum_bars'
    ];
}
