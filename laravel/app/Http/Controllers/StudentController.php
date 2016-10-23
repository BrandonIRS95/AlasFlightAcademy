<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Event;
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

      $events = Event::where([['eventable_type', '=', 'App\FlightTest'], ['date', '=', $now->toDateString()], ['start', '>=', $now->toTimeString()]])
      ->orWhere('date', '>', $now->toDateString())->with('eventable')->orderBy('date', 'asc')->get();
      $events2 = $events->where('eventable.student_id', '=', $student->id)->load('instructor', 'instructor.person', 'eventable.airplane');


      return response()->json(['status' => 0,
          'tests' => $events2, 'now' => $now->toDateString()], 200);
    }

    public function getPreviousFlights() {
      $now = Carbon::now();
      $student = Auth::user()->person->student;

      $events = Event::where([['eventable_type', '=', 'App\FlightTest'], ['date', '<=', $now->toDateString()], ['start', '<=', $now->toTimeString()]])
      ->orWhere('date', '<', $now->toDateString())->with('eventable')->orderBy('date', 'desc')->get();
      $events2 = $events->where('eventable.student_id', '=', $student->id)->load('instructor', 'instructor.person', 'eventable.airplane');

      /*$events = Event::where([['eventable_type', '=', 'App\FlightTest'], ['date', '<', $now->toDateString()]])->with('eventable')->orderBy('date', 'desc')->get();
      $events2 = $events->where('eventable.student_id', '=', $student->id)->load('instructor', 'instructor.person', 'eventable.airplane');*/

      return response()->json(['status' => 0,
          'tests' => $events2, 'now' => $now->toDateString()], 200);
    }
}
