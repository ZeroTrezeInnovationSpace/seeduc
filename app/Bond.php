<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bond extends Model
{
	public function segments()
	{
		return $this->hasMany('App\Segment');
	}
}
