<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\FlightTest;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function getMyFlightsView() {
    	$type = Auth::user()->typeOfUser->type;

        if($type == 'Student')
            return view('student.myflights');
    }

    public function getNextFlights() {
      $now = Carbon::now();
      $student = Auth::user()->person->student;
      $tests = FlightTest::where('student_id','=', $student->id)->whereHas('event', function($query) use ($now) {
        $query->where([['date', '=', $now->toDateString()], ['start', '>=', $now->toTimeString()]])->orWhere('date', '>', $now->toDateString());
      })->with('event', 'event.instructor.person')->get();

      return response()->json(['status' => 0,
          'tests' => $tests], 200);
    }

    public function getPreviousFlights() {
      $now = Carbon::now();
      $student = Auth::user()->person->student;
      $tests = FlightTest::where('student_id','=', $student->id)->whereHas('event', function($query) use ($now) {
        $query->where('date', '<', $now->toDateString());
      })->with('event', 'event.instructor.person')->get();

      return response()->json(['status' => 0,
          'tests' => $tests], 200);
    }
}
