<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Person;

class PersonController extends Controller
{

    public function getAddPerson()
    {
        $person = new Person();
        $person->first_name = "Brandon";
        $person->last_name = "Reyes";
        $person->date_of_birth = "2016-05-06";
        $person->gender = "male";
        $person->email = "b@gmail.com";
        $person->city_country_of_birth = "United States, Texas";

        $person->save();

        return redirect()->route('index');
    }
}
