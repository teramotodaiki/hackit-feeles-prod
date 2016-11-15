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
    return view('welcome', ['invitation' => App\Invitation::first()]);
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/invitations', 'InvitationController@index');
Route::post('/invitations', 'InvitationController@store');

Route::resource('contents', 'ContentController');
Route::post('contents/{id}/update', 'ContentController@update'); // With multipart/form-data

Route::resource('users', 'UserController');
Route::post('users/{id}/update', 'UserController@update'); // With multipart/form-data
