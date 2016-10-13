<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = ['person_id'];

    public function person(){
        return $this->belongsTo('App\Person');
    }

    public function events(){
        return $this->hasMany('App\Event');
    }

    /*public function scopeLike($query, $field, $value){
        return $query->where($field, 'LIKE', '%'.$value.'%');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }*/
}
