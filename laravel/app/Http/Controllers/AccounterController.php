<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DateTime;
use App\Http\Requests;
use App\accountant;

class AdmissionController extends Controller
{
    public function postCounter(Request $request)
    {
        $counter = new  accountant();
        $counter = $request['counter'];
        $counter->save();
    }

    public function getCounter()
    {
        $counter = Auth::accountant()->number;
        return view('index',['counter'=>$counter,]);
    }

}
