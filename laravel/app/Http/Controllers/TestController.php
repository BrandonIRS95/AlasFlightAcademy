<?php

namespace App\Http\Controllers;

use App\Event;
use App\Test;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function postAddTest(Request $request){

        $res = null;

        if($request['option'] == 'add') $res = $this->addTest($request);
        if($request['option'] == 'edit') $res = $this->editTest($request);

        return $res;
    }

    public function addTest($request) {
        $event = new Event();
        $event->date = $request['date'];
        $event->start = $request['start'];
        $event->end = $request['end'];
        $event->status = 'available';
        $event->instructor_id = $request['instructor_id'];

        $test = new Test();
        $test->subject = $request['subject'];
        $test->description = $request['description'];

        $test->save();

        $event->eventable_id = $test->id;
        $event->eventable_type = 'App\Test';

        $event->save();

        return response()->json(['message' => 'Test added successfully', 'status' => 0], 200);
    }

    public function editTest($request) {
        $event = Event::find($request['id']);
        $event->date = $request['date'];
        $event->start = $request['start'];
        $event->end = $request['end'];
        $event->status = $request['status'];
        $event->cancellation_description = $request['cancellation'];
        $event->instructor_id = $request['instructor_id'];

        $test = $event->eventable;
        $test->subject = $request['subject'];
        $test->description = $request['description'];

        $test->update();
        $event->update();

        return response()->json(['message' => 'Test added successfully', 'status' => 0], 200);
    }
}
