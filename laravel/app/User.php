<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    /*public function posts()
    {
        return $this->hasMany('App\Post');
    }*/

    public function typeOfUser()
    {
        return $this->belongsTo('App\TypeOfUser');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}

