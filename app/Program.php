<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	public function activity(){
		return $this->belongsTo('App\Activity');
	}

	public function schedule(){
		return $this->belongsTo('App\Schedule');
	}
}
