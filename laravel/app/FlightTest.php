<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightTest extends Model
{
    protected $with = ['flightRoute', 'airplane'];

    public function flightRoute(){
        return $this->belongsTo('App\FlightRoute');
    }

    public function airplane(){
        return $this->belongsTo('App\Airplane');
    }

    public function event()
    {
        return $this->morphOne('App\Event', 'eventable');
    }
}
