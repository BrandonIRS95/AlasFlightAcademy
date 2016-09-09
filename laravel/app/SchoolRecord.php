<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolRecord extends Model
{
    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
