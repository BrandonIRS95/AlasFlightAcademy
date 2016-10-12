<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

use App\Http\Requests;

class EventController extends Controller
{
    public function getEventsByDate($date){
        $events = Event::where('date','=', $date)->with('eventable')->get();

        return response()->json(['status' => 0,
            'events' => $events], 200);
    }

    public function getEventsByMonth($month, $year){
        $start = $year.'-'.$month.'-'.'1';
        if($month == 12) { $month = 1; $year += 1; } else $month += 1;
        $end = $year.'-'.$month.'-'.'1';
        $events = Event::where('date','>=', $start)->where('date','<', $end)->with('eventable')->get();

        return response()->json(['status' => 0,
            'events' => $events], 200);
    }
}
