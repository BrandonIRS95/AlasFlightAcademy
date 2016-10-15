<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightRoute extends Model
{
    public $timestamps = false;
    public function flights(){
        return $this->hasMany('App\FlightTest');
    }

    public function points(){
        return $this->hasMany('App\RoutePoint');
    }

    public function markers(){
        return $this->hasMany('App\RouteMarker');
    }
}
