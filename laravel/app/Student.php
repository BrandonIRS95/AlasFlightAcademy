<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function pilotProgram()
    {
        return $this->belongsTo('App\PilotProgram');
    }

    public function flightTests() {
    	return $this->hasMany('App\FlightTests');
    }
}
