<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightTest extends Model
{
    public function route(){
        return $this->hasOne('App\FlightRoute');
    }
}
