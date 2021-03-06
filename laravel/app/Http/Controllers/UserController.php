<?php

namespace App\Http\Controllers;

use App\Student;
use App\Person;
use App\TypeOfUser;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function postSignUp(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'first_name' => 'required|max:120',
            'password' => 'required|min:4'
        ]);

        $email = $request['email'];
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->password = $password;


        $user->save();

        Auth::login($user);

        return redirect()->route('index');
    }

    public function postSignIn(Request $request)
    {
      $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password'] ]))
        {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function getDashboardView()
    {
        $type = Auth::user()->typeOfUser->type;

        if($type == 'Admin')
            return view('admin.dashboard');
        if($type == 'Student')
            return view('student.dashboard');
        if($type == 'Instructor')
            return view('instructor.dashboard');
        else
            return redirect()->route('index');

    }

    public function getCalendarView()
    {
        $type = Auth::user()->typeOfUser->type;

        if($type == 'Admin')
            return view('admin.calendar');
        if($type == 'Student')
            return view('student.calendar');
        if($type == 'Instructor')
            return view('instructor.calendar');
        else
            return redirect()->route('index');

    }

    public function getAspirantsView(){
        $type = Auth::user()->typeOfUser->type;
        if($type =='Admin') {
            $posts = Student::where('status','=','onhold')->paginate(10);
            return view('admin.aspirants',['posts'=>$posts]);
        }
        else
            return redirect()->route('index');

    }

    public function getStudentsView(){
        $type = Auth::user()->typeOfUser->type;
        if($type =='Admin') {
            $posts = Student::where('status','=','admited')->paginate(10);
            return view('admin.students',['posts'=>$posts]);
        }
        else
            return redirect()->route('index');

    }
    public function getIndex()
    {
        $users = User::orderBy('id','DESC')->get();
        return View::make('users.index')->with('users',$users);
    }

    public function getCrudView()
    {
        $type = Auth::user()->typeOfUser->type;
        if ($type == 'Admin') {
            return view('admin.userCrud');
        } else
            return redirect()->route('index');

    }
    public function postCrearNuevaPersona(Request $request){

        $person = new Person();

        $person->first_name = $request->input("first_name");
        $person->last_name = $request->input("last_name");
        $person->date_of_birth = $request->input("dob");
        $person->gender = $request["gender"];
        $person->city_country_of_birth = "";

        if($person->save()) {
           //crearNuevoUsuario($request->input("password"),$request->input("email"),6);
            return redirect()->back();
        }
    }
    public function crearNuevoUsuario($password,$typeUserId,$email,$personId)
    {
        $user = new User();

        $user->password = $password;
        $user->status=0;
        $user->type_of_user_id = $typeUserId;
        $user->email = $email;
        $user->person_id = $personId;
    }
    public function getIndexCrud()
    {
            $posts = User::paginate(10);
            return view('admin.indexCrud',['posts'=>$posts]);
    }
}
