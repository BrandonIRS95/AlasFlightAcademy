<?php

namespace App\Http\Controllers;

use App\Admission;
use App\TypeOfUser;
use Illuminate\Http\Request;
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
            //$type = Auth::user()->typeOfUser->type;

            $type = Auth::user()->typeOfUser->type;

            if($type == 'Admin')
                return redirect()->route('admin');
            else
                return redirect()->route('index'); //cambiar cuando tengamos el dashboard de los estudiantes
        }
        return redirect()->back();
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function getAdminView()
    {
        $type = Auth::user()->typeOfUser->type;

        if($type == 'Admin')
            return view('admin.dashboard');
        else
            return redirect()->route('index');

    }

    public function getCalendarView()
    {
        $type = Auth::user()->typeOfUser->type;

        if($type == 'Admin')
            return view('admin.calendar');
        else
            return redirect()->route('index');

    }

    public function getAspirantsView(){
        $type = Auth::user()->typeOfUser->type;
        if($type =='Admin') {
            $posts = Admission::where('status','=','onhold')->paginate(10);
            return view('admin.aspirants',['posts'=>$posts]);
        }
        else
            return redirect()->route('index');

    }

    public function getStudentsView(){
        $type = Auth::user()->typeOfUser->type;
        if($type =='Admin') {
            $posts = Admission::where('status','=','admited')->paginate(10);
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
    public function postCrearNuevo(){

<<<<<<< HEAD
    }
=======
   
>>>>>>> origin/develop
}
