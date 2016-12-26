<?php

namespace App\Http\Controllers;

use App\AlasPayment;
use App\Mail\Admission;
use App\Mail\PasswordAdded;
use App\Student;
use App\Person;
use App\TypeOfUser;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Thing;
use App\accountant;
use Illuminate\Support\Facades\Session;

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
          if(Auth::user()->status == 0)
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    public function postVerifyEmail(Request $request) {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request['email'])->first();

        if($user != null && $user->type_of_user_id == 2) {

            $verify_payment = AlasPayment::where([
                ['user_id', $user->id],
                ['type', 'admission'],
                ['success', 1]
            ])->first();

            if($verify_payment == null)
                return response()->json(['found' => true, 'status' => 0], 200);

            return response()->json(['found' => false, 'status' => 1], 200);
        }

        return response()->json(['found' => false,
            'status' => 2], 200);
    }

    public function getPay(Request $request, Mailer $mailer)
    {
        if(!$request->has(['success', 'email', 'serial', 'paymentId', 'token', 'PayerID'])) die();

        $success = $request['success'] == 'true' ? 1 : 0;

        $user = User::where('email', $request['email'])->first();

        if($user == NULL) die();

        $alas_payment = AlasPayment::where([
            ['user_id', $user->id],
            ['serial', $request['serial']],
            ['success', NULL]
        ])->first();

        if($alas_payment == null) die();

        $alas_payment->success = $success;
        $alas_payment->payment_id = $request['paymentId'];
        $alas_payment->token = $request['token'];
        $alas_payment->payer_id = $request['PayerID'];

        if($alas_payment->update()) $mailer->to($user->email)->send(new Admission(
            $user->email,
            $request['paymentId'],
            $request['PayerID'],
            $alas_payment->updated_at
        ));

        return view('pay',['success' => 1, 'email' => $request['email']]);
    }

    public function postAddPassword(Request $request, Mailer $mailer)
    {
        if(!$request->has(['email', 'password'])) die();

        $user = User::where('email', $request['email'])->first();

        if($user == null) die();

        $user->password = bcrypt($request['password']);

        if($user->update()) {
            $mailer->to($user->email)->send(new PasswordAdded());
            return redirect()->route('signin');
        }


        return redirect()->route('index');

    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function getDashboardView()
    {
        $type = Auth::user()->typeOfUser->type;

        if($type == 'Admin'){
            $fecha =date("Y/m/d");
            $newOrders = student::where('created_at','=',$fecha)->count();
            $counter = accountant::all()->max('number');
            $id = Auth::user()->id;
            $address =  person::all();
            $posts = Thing::where('id_user','=',$id)->paginate(6);
            return view('admin.dashboard',['posts'=>$posts,'address'=>$address,'counter'=>$counter,'newOrders'=>$newOrders]);
        }
        if($type == 'Student') {
            /*$id = Auth::user()->id;
            $posts = Thing::where('id_user', '=', $id)->paginate(6);
            return view('student.calendar', ['posts' => $posts]);*/
            return view('student.calendar');
        }
        if($type == 'Instructor'){
            $id = Auth::user()->id;
            $posts = Thing::where('id_user', '=', $id)->paginate(6);
            return view('instructor.calendar',['posts' => $posts]);
        }
        else
            return redirect()->route('index');

    }
    public function getAddressesStateOrCountry(){
        $address =  person::all();
        return response()->json(['address' => $address,
            'status' => '0'], 200);
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
    public function crearNuevoUsuario(Request $request){

        $user = new User();

        $user->password = bcrypt($request['password_confirm']);
        $user->status=0;
        $user->type_of_user_id = 1;
        $user->email = $request['email'];

        if($user->save()) {
            return response()->json(['message' => 'User added succesfully', 'status' => '0'], 200);
        }
    }
    public function getIndexCrud()
    {
            $posts = User::paginate(10);
            return view('admin.indexCrud',['posts'=>$posts]);
    }
    public function postNewThing(Request $request){
        $id = Auth::user()->id;
        $thing = new Thing();
        $fecha =date("Y/m/d");
        $thing->id_user = $id;
        $thing->description = $request['descripcion'];
        $thing->start_date = $fecha;

        $thing->save();
    }
        public function postdestroy( Request $request ) {
            $thing = Thing::findOrFail( $request['id'] );

            if ( $request->ajax() ) {
                $thing->delete( $request->all() );

                return response(['msg' => 'Product deleted', 'status' => 'success']);
            }
            return response(['msg' => 'Failed deleting the product', 'status' => 'failed']);
        }
}
