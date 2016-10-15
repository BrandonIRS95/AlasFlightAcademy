<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteMarker extends Model
{
    public $timestamps = false;

    public function route(){
        return $this->belongsTo('App\FlightRoute');
    }
}
