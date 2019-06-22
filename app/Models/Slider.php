<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $casts = [
        'appearance'=>'array',
        'shared' => 'array',
        'settings' => 'array',
        'countdown' => 'array',
        'button' => 'array',
        'opt_in_appearance' => 'array',
        'opt_in_settings' => 'array',
        'pro_features' => 'array',
    ];

}
