<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class StudentController extends Controller
{
    public function getMyFlightsView() {
    	$type = Auth::user()->typeOfUser->type;

        if($type == 'Student')
            return view('student.myflights');
    }
}
