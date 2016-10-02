<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfUser extends Model
{
    protected $fillable = ['type'];
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
