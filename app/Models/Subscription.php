<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['amember_id', 'expiry', 'title', 'description'];
    
    public static function syncAmemberSubscriptions($subscriptions)
    {
        foreach ($subscriptions as $id => $expiry) {
            $subscription = new Subscription(['amember_id' => $id, 'expiry' => $expiry]);
            if (!$subscription->save()) {
                return false;
            }
        }
        return true;
    }
    
}
