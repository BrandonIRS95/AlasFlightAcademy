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

Route::get('/admin', [
    'uses' => 'UserController@getAdminView',
    'as' => 'admin',
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