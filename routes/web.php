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

if (env('PUBLIC_REGISTER', false)) {
    Auth::routes();
} else {
    Route::get('login', 'StudentLoginController@index')->name('login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
}
Route::get('studentLogin', 'StudentLoginController@index');
Route::post('studentLogin', 'StudentLoginController@authenticate');


Route::get('/home', 'HomeController@index');

Route::get('/invitations', 'InvitationController@index');
Route::post('/invitations', 'InvitationController@store');


Route::resource('contents', 'Content\WebController');
Route::post('contents/{id}/update', 'Content\WebController@update'); // With multipart/form-data
Route::get('contents/{id}/popout', 'Content\WebController@popout');
Route::post('contents/{id}/popout', 'Content\WebController@updateFromPopout');

Route::resource('users', 'UserController');
Route::post('users/{id}/update', 'UserController@update'); // With multipart/form-data

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{
    Route::get('/', function() { return view('admin'); });
    Route::post('invite', 'AdminController@invite');
    Route::post('discardInvitation', 'AdminController@discardInvitation');
});
