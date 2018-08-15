<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackQuiz extends Model
{
    public function users(){
		return $this->belongsToMany('App\User', 'users_feedbacks', 'feedback_id', 'user_id');
	}
	public function activities(){
		return $this->belongsToMany('App\Activity', 'users_feedbacks', 'feedback_id', 'activity_id');
	}
}
