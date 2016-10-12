<?php

namespace App\Http\Controllers;

use App\Event;
use App\Test;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function postAddTest(Request $request){

        $event = new Event();
        $event->date = $request['date'];
        $event->start = $request['start'];
        $event->end = $request['end'];
        $event->status = 'available';

        $test = new Test();
        $test->subject = $request['subject'];
        $test->description = $request['description'];
        $test->instructor_id = $request['instructor_id'];

        $test->save();

        $event->eventable_id = $test->id;
        $event->eventable_type = 'App\Test';

        $event->save();

        return response()->json(['message' => 'Test added successfully', 'status' => 0], 200);
    }
}
