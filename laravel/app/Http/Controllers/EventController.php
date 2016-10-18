<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use URL;
use App\Http\Requests;

class EventController extends Controller
{
    public function getEventsByDate($date, $instructor, $status, $type){
        $events = Event::where('date','=', $date)->with(array('eventable', 'instructor' => function($query){
            $query->with(array('person' => function($query){
                $query->select('id','first_name', 'last_name');
            }));
        }))->get();
        if($instructor != 'null') $events = $events->where('instructor_id','=', $instructor);
        if($status != 'null') $events = $events->where('status','=', $status);
        if($type != 'null') $events = $events->where('eventable_type','=', 'App\\'.$type);

        return response()->json(['status' => 0,
            'events' => $events], 200);
    }

    public function getEventsByMonth($month, $year, $instructor){
        $data = '{';
        $start = $year.'-'.$month.'-'.'1';
        if($month == 12) { $month = 1; $year += 1; } else $month += 1;
        $end = $year.'-'.$month.'-'.'1';
        $events = Event::where('date','>=', $start)->where('date','<', $end)->get();
        if($instructor != 'null') $events = $events->where('instructor_id','=', $instructor);
        $dateGroup = $events->groupBy('date');

        $first = true;

        foreach ($dateGroup as $index => $group){

            //echo $group;
            if($first) $first = false; else $data .= ',';

            $data .= '"'.$index.'" : [{ "content" : "';

            if($group->contains('status', 'available')) $data .= "<div class='calendar-points available'>&#8226;</div>";
            if($group->contains('status', 'booked')) $data .= "<div class='calendar-points booked'>&#8226;</div>";
            if($group->contains('status', 'canceled')) $data .= "<div class='calendar-points canceled'>&#8226;</div>";
            if($group->contains('eventable_type', 'App\FlightTest')) $data .= "<img class='calendarIcons airplane' src='".URL::to('svg/calendar/ic_airplanemode_active_black_48px.svg')."' />";
            if($group->contains('eventable_type', 'App\Test')) $data .= "<img class='calendarIcons test' src='".URL::to('svg/calendar/ic_content_paste_black_48px.svg')."' />";

            $data .= '", "allDay" : "true"}]';

        }

        $data .= '}';

        echo $data;
    }
}
