<?php

namespace App\Http\Controllers;

use App\Airplane;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AirplaneController extends Controller
{
    public function getAirplanesByPlate($plate)
    {
        $type = Auth::user()->typeOfUser->type;

        if($type =='Admin' || $type == 'Instructor') {

            $airplanes = Airplane::where('plate','LIKE','%'.$plate.'%')->get();

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
