<?php

namespace App\Http\Controllers;

use App\FlightRoute;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FlightRouteController extends Controller
{
    public function getRoutesByName($name){

        $type = Auth::user()->typeOfUser->type;

        if($type =='Admin' || $type == 'Instructor') {

            $routes = FlightRoute::where('name','LIKE', '%'.$name.'%')->with('markers', 'points')->get();

            return response()->json(['routes' => $routes, 'status' => '0'], 200);
        }

        return response()->json(['message' => 'error', 'status' => '1'], 200);
    }
}
