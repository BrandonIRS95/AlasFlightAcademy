<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonLegalInformation extends Model
{
    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
