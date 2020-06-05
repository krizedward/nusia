<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth'], function() {

	Route::get('/home', function() {
		return view('home');
	})->name('home');

	/*Student*/
	Route::get('/schedule/{user_id}', 'ScheduleController@index');
	Route::get('/schedule/{user_id}/{instructor_id}', 'ScheduleController@choose');
	Route::post('/schedule/store', 'ScheduleController@store');

	Route::get('/instructors','InstructorsController@index');
	/*End-Student*/

});

Auth::routes();
