<?php

namespace App\Http\Controllers;

use App\FlightRoute;
use App\FlightTest;
use App\RouteMarker;
use App\RoutePoint;
use Illuminate\Http\Request;

use App\Http\Requests;

class FlightTestController extends Controller
{
    public function postAddFlightTest(Request $request){

        $flightTest = new FlightTest();
        $flightTest->date = $request['date'];
        $flightTest->start = $request['start'];
        $flightTest->end = $request['end'];
        $flightTest->cost = $request['cost'];
        $flightTest->instructor_id = $request['instructor'];
        $flightTest->airplane_id = $request['airplane'];

        if($request->has('route'))
        {
            $routeJson = $request['route'];
            $flightRoute = new FlightRoute();
            $flightRoute->name = $routeJson['name'];
            $flightRoute->description = $routeJson['description'];
            $flightRoute->save();
            $flightRoute->flights()->save($flightTest);

            $modelPoints = array();

            foreach ($routeJson['points'] as $point) {
                $routePoint = new RoutePoint();
                $routePoint->lat = $point['lat'];
                $routePoint->lng = $point['lng'];
                $modelPoints[] = $routePoint;
            }

            $modelMarkers = array();

            foreach ($routeJson['markers'] as $marker) {
                $routeMarker = new RouteMarker();
                $routeMarker->lat = $marker['lat'];
                $routeMarker->lng = $marker['lng'];
                $routeMarker->label = $marker['label'];
                $modelMarkers[] = $routeMarker;
            }

            $flightRoute->points()->saveMany($modelPoints);
            $flightRoute->markers()->saveMany($modelMarkers);
        }
        else{
            $flightTest->flight_route_id = $request['route_id'];
            $flightTest->save();
        }

        return response()->json(['status' => 0,
            'message' => 'Flight test successfully added.'], 200);
    }
}
