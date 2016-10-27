<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Person extends Model
{
    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'gender', 'city_country_of_birth'];

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

    public function student()
    {
        return $this->hasOne('App\Student');
    }

    public function user(){
        return $this->hasOne('App\User');
    }

    public function instructor(){
        return $this->hasOne('App\Instructor');
    }

}
