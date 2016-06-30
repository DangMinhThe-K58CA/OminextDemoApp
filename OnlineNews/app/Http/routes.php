<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//
Route::get('/login', function () {
	return view('auth/login');
});
Route::post('/loginProcessing', 'AdminController@loginProcessing');
Route::get('/register', 'AdminController@startRegister');
Route::post('/registerProcessing', 'AdminController@registerProcessing');
Route::get('/logout', 'AdminController@logoutProcessing');
//


Route::get('/', function () {
    return view('index');
});


Route::get('/show', 'FileEntryController@getAllImage');


Route::get('/deleteImage', 'FileEntryController@deleteImage');

Route::get('fileentry/get/{filename}', [
	'as' => 'getentry', 'uses' => 'FileEntryController@get']);


Route::post('fileentry/add',[ 
        'as' => 'addentry', 'uses' => 'FileEntryController@add']);