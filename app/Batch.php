<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
	public function activity(){
		return $this->belongsTo('App\Activity');
	}

	public function tickets(){
		return $this->hasMany('App\Ticket');
	}

}
