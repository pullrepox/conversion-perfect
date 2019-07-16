<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarsClickLog extends Model
{
    protected $table = 'bars_click_logs';
    
    protected $fillable = [
        'user_id', 'bar_id', 'split_bar_id', 'reset_stats', 'cookie', 'ip_address', 'agents', 'kind', 'model', 'platform', 'platform_version', 'browser', 'domain', 'latitude', 'longitude',
        'country_code', 'country_code3', 'country_name', 'region', 'postal_code', 'area_code', 'continent_code', 'language_pref', 'language_range'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function bar()
    {
        return $this->belongsTo('App\Models\Bar', 'bar_id');
    }
}
