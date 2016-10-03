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

Route::get('/admin', [
    'uses' => 'UserController@getAdminView',
    'as' => 'admin',
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

Route::get('/getInstructorsByName/{name?}', [
    'uses' => 'InstructorController@getInstructorsByName',
    'as' => 'getInstructorsByName',
    'middleware' => 'auth'
]);

Route::get('/contacts', [
    'uses' => 'ContactController@getContactsView',
    'as' => 'contacts',
    'middleware' => 'auth'
]);

Route::get('/userCrud', [
    'uses' => 'UserController@getCrudView',
    'as' => 'userCrud',
    'middleware' => 'auth'
]);

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

Route::get('/getAirplanesByPlate/{plate?}', [
    'uses' => 'AirplaneController@getAirplanesByPlate',
    'as' => 'getAirplanesByPlate',
    'middleware' => 'auth'
]);


Route::get('/', function () {
    return view('index');
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

Route::post('/addcontact', [
    'uses' => 'ContactController@postAddContact',
    'as' => 'addcontact'
]);
