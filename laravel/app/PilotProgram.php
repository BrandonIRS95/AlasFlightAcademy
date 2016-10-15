<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PilotProgram extends Model
{
    protected $fillable = ['name', 'price'];

    public function admissions()
    {
        return $this->hasMany('App\Admission');
    }
}
