<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArList extends Model
{
	protected $table = 'ar_lists';
	protected $fillable = ['user_id', 'integration_id', 'list_id', 'list_name'];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
	
	public function integration()
	{
		return $this->belongsTo('App\Integration', 'integration_id');
	}
}
