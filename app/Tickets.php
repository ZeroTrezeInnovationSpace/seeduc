<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}

	public function batch(){
		return $this->belongsTo('App\Batch');
	}

	public function crowd(){ // Mudamos de Public para crowd, pois é uma palavra reservada.
		return $this->belongsTo('App\Public');
	}   

	public function event(){
		return $this->belongsTo('App\Event');
	}
}
