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


Route::get('/addperson', [
    'uses' => 'PersonController@getAddPerson',
    'as' => 'addperson'
]);

Route::post('/addcontact', [
    'uses' => 'ContactController@postAddContact',
    'as' => 'addcontact'
]);