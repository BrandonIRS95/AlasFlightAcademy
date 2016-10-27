<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightTest extends Model
{
    protected $with = ['flightRoute', 'airplane', 'student'];

    public function flightRoute(){
        return $this->belongsTo('App\FlightRoute');
    }

    public function airplane(){
        return $this->belongsTo('App\Airplane');
    }

    public function student() {
        return $this->belongsTo('App\Student');
    }

    public function event()
    {
        return $this->morphOne('App\Event', 'eventable');
    }
}
