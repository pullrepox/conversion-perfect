<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
	protected $fillable = ['user_id', 'name', 'responder_id', 'api_key', 'hash', 'url'];
	
	protected $casts = [
		'responder_id' => 'integer',
	];
	
	public function responder()
	{
		return $this->belongsTo(Responder::class);
	}
	
	public function ar_lists()
	{
		return $this->hasMany('App\Models\ArList', 'integration_id', 'id');
	}
}
