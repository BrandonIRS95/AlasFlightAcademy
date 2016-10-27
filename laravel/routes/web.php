<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

Route::post('/signup', [
    'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);

Route::get('/logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'logout'
]);

Route::post('/addAdmission', [
    'uses' => 'AdmissionController@postAddAdmission',
    'as' => 'addAdmission'
]);

Route::get('/dashboard', [
    'uses' => 'UserController@getDashboardView',
    'as' => 'dashboard',
    'middleware' => 'auth'
]);

Route::get('/calendar', [
    'uses' => 'UserController@getCalendarView',
    'as' => 'calendar',
    'middleware' => 'auth'
]);

Route::get('/aspirants', [
    'uses' => 'UserController@getAspirantsView',
    'as' => 'aspirants',
    'middleware' => 'auth'
]);

Route::get('/students', [
    'uses' => 'UserController@getStudentsView',
    'as' => 'students',
    'middleware' => 'auth'
]);

Route::get('/contacts', [
    'uses' => 'ContactController@getContactsView',
    'as' => 'contacts',
    'middleware' => 'auth'
]);

Route::get('/getAdmissionById/{id?}', [
    'uses' => 'AdmissionController@getAdmissionById',
    'as' => 'getAdmissionById',
    'middleware' => 'auth'
]);

Route::get('/getStudentById/{id?}', [
    'uses' => 'AdmissionController@getStudentById',
    'as' => 'getStudentById',
    'middleware' => 'auth'
]);
Route::get('/getContactById/{id?}', [
    'uses' => 'ContactController@getContactById',
    'as' => 'getContactById',
    'middleware' => 'auth'
]);

Route::get('/getAirplaneById/{id?}', [
    'uses' => 'AirplaneController@getAirplaneById',
    'as' => 'getAirplaneById',
    'middleware' => 'auth'
]);

Route::get('/getInstructorsByName/{name?}', [
    'uses' => 'InstructorController@getInstructorsByName',
    'as' => 'getInstructorsByName',
    'middleware' => 'auth'
]);

Route::get('/getNextFlights', [
    'uses' => 'StudentController@getNextFlights',
    'as' => 'getNextFlights',
    'middleware' => 'auth'
]);

Route::get('/getPreviousFlights', [
    'uses' => 'StudentController@getPreviousFlights',
    'as' => 'getPreviousFlights',
    'middleware' => 'auth'
]);

Route::get('/contacts', [
    'uses' => 'ContactController@getContactsView',
    'as' => 'contacts',
    'middleware' => 'auth'
]);

Route::post('/bookFlight', [
    'uses' => 'FlightTestController@postBookFlight',
    'as' => 'bookFlight',
    'middleware' => 'auth'
]);

Route::post('/cancelBookFlight', [
    'uses' => 'FlightTestController@postCancelBookFlight',
    'as' => 'cancelBookFlight',
    'middleware' => 'auth'
]);

Route::get('/myflights', [
    'uses' => 'StudentController@getMyFlightsView',
    'as' => 'myflights',
    'middleware' => 'auth'
]);

/////////////////yisus
# User Management

Route::get('/userCrud', [
    'uses' => 'UserController@getCrudView',
    'as' => 'userCrud',
    'middleware' => 'auth'
]);
Route::get('/indexCrud', [
    'uses' => 'UserController@getIndexCrud',
    'as' => 'indexCrud',
    'middleware' => 'auth'
]);
Route::post('/userCrud', [
    'uses' => 'UserController@postCrearNuevaPersona',
    'as' => 'userCrud'
]);
///////////////////////
Route::get('/airplanes', [
    'uses' => 'AirplaneController@getAirplanesView',
    'as' => 'airplanes',
    'middleware' => 'auth'
]);

Route::get('/instructors', [
    'uses' => 'InstructorController@getInstructorsView',
    'as' => 'instructors',
    'middleware' => 'auth'
]);

Route::post('/sendmail', function (\Illuminate\Http\Request $request,
      \Illuminate\Mail\Mailer $mailer){
    $mailer
        ->to($request->input('mail'))
        ->send(new \App\Mail\MyMail($request->input('title')));
    return redirect()->back();
})->name('sendmail');

Route::get('/getAirplanesByPlateAndName/{text?}', [
    'uses' => 'AirplaneController@getAirplanesByPlateAndName',
    'as' => 'getAirplanesByPlateAndName',
    'middleware' => 'auth'
]);

Route::get('/getEventsByDate/{date?}/instructor/{instructor?}/status/{status?}/type/{type?}', [
    'uses' => 'EventController@getEventsByDate',
    'as' => 'getEventsByDate'
    //'middleware' => 'auth'
]);

Route::get('/getEventsByMonth/{month?}/year/{year?}/instructor/{instructor?}', [
    'uses' => 'EventController@getEventsByMonth',
    'as' => 'getEventsByMonth'
    //'middleware' => 'auth'
]);

Route::post('/addFlightTest', [
    'uses' => 'FlightTestController@postAddFlightTest',
    'as' => 'addFlightTest',
    'middleware' => 'auth'
]);

Route::post('/addTest', [
    'uses' => 'TestController@postAddTest',
    'as' => 'addTest',
    'middleware' => 'auth'
]);

Route::get('/getRoutesByName/{name?}', [
    'uses' => 'FlightRouteController@getRoutesByName',
    'as' => 'getRoutesByName',
    'middleware' => 'auth'
]);


Route::get('/', function (Request $request) {
  return view("index");
})->name('index');

Route::get('/login', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/pilot-programs', function () {
    return view('pilot-programs');
})->name('pilot-programs');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/enroll', function () {
    return view('enroll');
})->name('enroll');

Route::get('/signin', function () {
    return view('signin');
})->name('signin');

Route::post('/signin', [
    'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);


Route::get('/addperson', [
    'uses' => 'PersonController@getAddPerson',
    'as' => 'addperson'
]);

Route::get('/changeLanguage', function (Request $request) {
  LanguageSwitcher::setLanguage(Input::get("lang"));
  return redirect()->route('index');
})->name('changeLanguage');

Route::post('/addcontact', [
    'uses' => 'ContactController@postAddContact',
    'as' => 'addcontact'
]);

Route::post('/addairplane', [
    'uses' => 'AirplaneController@postAddAirplane',
    'as' => 'addairplane'
]);

Route::post('/addinstructor', [
    'uses' => 'InstructorController@postAddInstructor',
    'as' => 'addinstructor'
]);

Route::post('/edit',[
    'uses' => 'AirplaneController@postEditPost',
    'as' => 'edit'
]);
