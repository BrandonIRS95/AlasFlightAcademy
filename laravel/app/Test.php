<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function event()
    {
        return $this->morphOne('App\Event', 'eventable');
    }
}
