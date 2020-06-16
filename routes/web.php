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
    return redirect('login');
});

Route::group(['middleware'=>'auth'], function() {

	Route::get('/home', function() {
		return view('home');
	})->name('home');

	/*Student*/
	Route::get('/schedule/{user_id}', 'ScheduleController@index')->name('schedule.index');
	Route::get('/schedule/{user_id}/{instructor_id}', 'ScheduleController@choose')->name('choose');
	Route::post('/schedule/store', 'ScheduleController@store')->name('store');

	Route::get('/instructors','InstructorsController@index')->name('instructors.index');
	/*End-Student*/

	Route::get('/verfication-schedule/{user_id}/{vs_id}','ScheduleController@verfication')->name('verfication');

	Route::get('/session/{user_id}','ScheduleController@session')->name('session');
	Route::get('/material','MaterialClassController@index')->name('material.index');

	Route::post('/material/store','MaterialClassController@store');
	Route::get('/material/download/{id}','MaterialClassController@download');
	Route::get('/material/student/{id_class}','MaterialClassController@student')->name('material.student');

	Route::get('/schedule/instructors','ScheduleController@instructors');
	//halaman classrooms
	Route::get('/classroom','ClassroomController@index')->name('classroom.index');
	//halaman calendar
	Route::get('/calendar','ScheduleController@calendar')->name('calendar.index');

});

Auth::routes();
