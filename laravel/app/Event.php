<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function eventable(){
        return $this->morphTo();
    }

    public function instructor(){
        return $this->belongsTo('App\Instructor');
    }
}
