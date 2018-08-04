<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    public function publics()
    {
        return $this->hasMany('App\Public');
    }
}
