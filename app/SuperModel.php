<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SuperModel extends Model
{
	public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->format('m-d-Y');
	}
}
