<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Person extends Model
{
    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function legalInformation()
    {
        return $this->hasOne('App\PersonLegalInformation');
    }

    public function schoolRecords()
    {
        return $this->hasMany('App\SchoolRecord');
    }
}
