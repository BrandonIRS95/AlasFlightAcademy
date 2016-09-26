<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PilotProgram extends Model
{
    public function admissions()
    {
        return $this->hasMany('App\Admission');
    }
}
