<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $casts = [
        'shared' => 'array',
        'settings' => 'array',
        'countdown' => 'array',
        'button' => 'array',
        'branding' => 'array',
    ];
}
