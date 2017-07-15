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
	//Auth::loginUsingId(1);
    return view('welcome');
});
Route::get('/delete_topic', 'HomeController@index')->middleware('acl:delete_topic');


Auth::routes();

Route::get('/home', 'HomeController@index');
