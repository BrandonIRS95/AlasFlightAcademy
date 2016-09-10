<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function pilotProgram()
    {
        return $this->belongsTo('App\PilotProgram');
    }
}
