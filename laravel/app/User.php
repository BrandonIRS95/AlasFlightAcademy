<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    protected $fillable = ['password', 'status', 'type_of_user_id', 'email', 'person_id'];

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

