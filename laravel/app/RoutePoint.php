<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoutePoint extends Model
{
    public $timestamps = false;
    //protected $fillable = ['lat','lng'];

    public function route(){
        return $this->belongsTo('App\FlightRoute');
    }
}
