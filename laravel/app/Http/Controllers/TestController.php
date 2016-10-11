<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function postAddTest(Request $request){
        $test = new Test();
        $test->subject = $request['subject'];
        $test->description = $request['description'];
        $test->date = $request['date'];
        $test->start = $request['start'];
        $test->end = $request['end'];
        $test->status = 'active';
        $test->instructor_id = $request['instructor_id'];

        $test->save();

        return response()->json(['message' => 'Test added successfully', 'status' => 0], 200);
    }
}
