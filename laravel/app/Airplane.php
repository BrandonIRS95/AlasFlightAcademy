<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    protected $fillable = ['plate', 'name', 'photo', 'status'];
}
