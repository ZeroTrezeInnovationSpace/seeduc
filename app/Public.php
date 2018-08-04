<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Public extends Model
{
	public function users(){
		return $this->hasMany('App\User');
	}

	public function tickets(){
		return $this->hasMany('App\Ticket');
	}

	public function activities(){
		return $this->hasMany('App\Activity');
	}

}
