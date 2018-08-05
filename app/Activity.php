<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function speakers(){
		return $this->hasMany('App\Speaker');
	}

	public function batches(){
		return $this->hasMany('App\Batch');
	}

	public function event(){
		return $this->belongsTo('App\Event');
	}

	public function location(){
		return $this->belongsTo('App\Location');
	}

	public function bond(){
		return $this->belongsTo('App\Bond');
	}

	public function users(){
		return $this->belongsToMany('App\User', 'subscriptions', 'activity_id', 'user_id');
	}
	public function subscribers(){
		return $this->hasMany('App\Subscription');
	}
}
