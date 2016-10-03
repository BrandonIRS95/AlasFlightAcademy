<?php

namespace App\Http\Controllers;

use App\Admission;
use App\Instructor;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class InstructorController extends Controller
{
    public function getInstructorsByName($name){

        /*$instructors = Instructor::with('person')->get();*/

        //$instructors =  Instructor::with(['person' => function ($query) use ($name) { $query->where('first_name', 'like', '%'.$name.'%'); }])->get();

        $instructors = Instructor::whereHas('person', function ($query) use ($name){
            $query->where('first_name', 'like', '%'.$name.'%');
            $query->orWhere('last_name', 'like', '%'.$name.'%');
        })->with(array('person'=>function($query){
            $query->select('id','first_name','last_name');
        }))->get();

        return response()->json(['instructors' => $instructors,
            'status' => '0'], 200);
    }

    public function getInstructorsView(){
        $type = Auth::user()->typeOfUser->type;
        if($type =='Admin') {
            return view('admin.instructors');
        }
        else
            return redirect()->route('index');

    }
}
