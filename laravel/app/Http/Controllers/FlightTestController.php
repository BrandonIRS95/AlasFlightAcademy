<?php

namespace App\Http\Controllers;

use App\Event;
use App\FlightRoute;
use App\FlightTest;
use App\RouteMarker;
use App\RoutePoint;
use Illuminate\Http\Request;

use App\Http\Requests;

class FlightTestController extends Controller
{
    public function postAddFlightTest(Request $request){

        $event = new Event();
        $event->date = $request['date'];
        $event->start = $request['start'];
        $event->end = $request['end'];
        $event->status = 'available';

        $flightTest = new FlightTest();
        $flightTest->cost = $request['cost'];
        $flightTest->description = $request['description'];
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

        $event->eventable_id = $flightTest->id;
        $event->eventable_type = 'App\FlightTest';
        $event->save();

        return response()->json(['status' => 0,
            'message' => 'Flight test successfully added.'], 200);
    }
}
