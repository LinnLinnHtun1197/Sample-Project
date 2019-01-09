<?php

namespace App;

use App\Traits\HasModelTrait;
class Widget extends SuperModel
{
	use HasModelTrait;
	protected $fillable = ['name','user_id','slug']; 

	public function user()
	{
		return $this->belongsTo('App\User');
	}


}
