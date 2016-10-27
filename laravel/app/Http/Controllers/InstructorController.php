<?php

namespace App\Http\Controllers;

use App\Admission;
use App\Instructor;
use App\Person;
use App\User;
use App\TypeOfUser;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class InstructorController extends Controller
{
    public function postAddInstructor(Request $request){
        $person = new Person();
        $person->gender = $request['gender'];
        // $person->date_of_birth = $request['date_of_birth'];
        $person->first_name = $request['first_name'];
        $person->last_name = $request['last_name'];
        $person->city_country_of_birth = $request['city_country_of_birth'];
        $person->save();

        $instructor = new Instructor();
        $instructor->person()->associate($person);
        $instructor->save();


        $user = new User();
        $user->password = $request['password'];
        $user->status = 0;
        $user->typeOfUser()->associate(TypeOfUser::find(3));
        $user->email = $request['email'];
        $user->person()->associate($person);
        $user->save();

        return response()->json(['status' => 0,
            'message' => 'Instructor successfully added.'], 200);
    }

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

            $posts =Instructor::paginate(10);

            return view('admin.instructors',['posts'=>$posts]);
        }
        else
            return redirect()->route('index');

    }



}
