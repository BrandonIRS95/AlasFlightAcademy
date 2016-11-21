<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    public function person(){
        return $this->belongsTo('App\User');
    }
}
