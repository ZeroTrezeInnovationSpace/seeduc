<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function enventType(){
    	return $this->belongsTo('App\User');
    }

    public function schedules(){
    	return $this->hasMany('App\Schedule');
    }

     public function Activities()
    {
        return $this->hasMany('App\Activity');
    }

}
