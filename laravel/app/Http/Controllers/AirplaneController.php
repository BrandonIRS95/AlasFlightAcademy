<?php

namespace App\Http\Controllers;

use App\Airplane;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AirplaneController extends Controller
{
    public function postAddAirplane(Request $request){
        $airplane = new Airplane();
        $airplane->name = $request['name'];
        $airplane->plate = $request['plate'];
        $airplane->status = $request['status'];
        $airplane->photo = $request['photo'];
        if($airplane->save()) {
            return response()->json(['status' => 0,
                'message' => 'Airplane successfully added.'], 200);
        }
        else
            return response()->json(['status' => 1,
                'message' => 'Airplane not added.'], 200);
    }

    public function getAirplanesByPlateAndName($text)
    {
        $type = Auth::user()->typeOfUser->type;

        if($type =='Admin' || $type == 'Instructor') {

            $airplanes = Airplane::where('plate','LIKE','%'.$text.'%')->orWhere('name','LIKE','%'.$text.'%')->get();

            return response()->json(['airplanes' => $airplanes,
                'status' => '0'], 200);
        }
        else
            return redirect()->route('index');
    }

    public function getAirplanesView(){
        $type = Auth::user()->typeOfUser->type;
        if($type =='Admin') {
            $posts = Airplane::paginate(10);
            return view('admin.airplanes',['posts'=>$posts]);
        }
        else
            return redirect()->route('index');

    }


}
