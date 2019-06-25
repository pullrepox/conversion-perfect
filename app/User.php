<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public static function findOrCreate($email, $attribs)
    {
        $obj = static::where('email', $email)->first();
        if (null != $obj) {
            return $obj;
        } else {
            $obj = new static;
            $obj->amember_id = $attribs->user_id;
            $obj->name = $attribs->name;
            $obj->email = $attribs->email;
            $obj->name_f = $attribs->name_f;
            $obj->name_l = $attribs->name_l;
            $obj->login = $attribs->login;
            $obj->save();
        }
        return $obj;
    }
    
    public function bars()
    {
        return $this->hasMany('App\Models\Bar');
    }
}
