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

	Route::get('/home',function() {
		return view('home');
	})->name('home');

	//Route::get('/home/{id}', 'HomeController@index')->name('home');

	//menampilkan detail dari schedule
	Route::get('/schedule/detail/{id_schedule}','ScheduleController@detail')->name('schedule.detail');
	//menampilkan halaman schedule
	Route::get('/schedule/{user_id}', 'ScheduleController@index')->name('schedule.index');
	//url create schedule instuctor
	Route::post('/create/schedule/instuctor/{id}','InstructorsController@schedule');
	//url pilih instructor
	Route::get('/schedule/{user_id}/{instructor_id}', 'ScheduleController@choose')->name('choose');
	//url simpan data 
	Route::post('/schedule/store', 'ScheduleController@store')->name('store');
	//url halaman pilih instructor
	Route::get('/classroom/{id}/instructors/','InstructorsController@index')->name('instructors.index');
	//url memilih instrutor
	Route::get('/choose/classroom/{id_class}/instructors/{id_instructors}','InstructorsController@choose')->name('instructors.choose');
	//url verifikasi jadwal
	Route::get('/verfication-schedule/{user_id}/{vs_id}','ScheduleController@verfication')->name('verfication');
	//url pilih session
	Route::get('/session/{user_id}','ScheduleController@session')->name('session');
	//menampilkan halaman share material
	Route::get('/material','MaterialClassController@index')->name('material.index');
	//menampilkan halaman detail share material
	Route::get('/material/share/detail/{class_id}','MaterialClassController@detail')->name('material.detail');
	//url simpan data
	Route::post('/material/store','MaterialClassController@store');
	//url download material
	Route::get('/material/download/{id}','MaterialClassController@download');
	//url akses material di student
	Route::get('/material/student/{id_class}','MaterialClassController@student')->name('material.student');
	//url halaman jadwal instructor
	Route::get('/schedule/instructors','ScheduleController@instructors');
	//url halaman classrooms
	Route::get('/classroom','ClassroomController@index')->name('classroom.index');
	//url memilih kelas di student
	Route::get('/choose/classroom/{id_class}','ClassroomController@choose')->name('classroom.choose');
	//url halaman calendar
	Route::get('/classroom/{id_class}/instructors/{id_instructors}/time','ScheduleController@calendar')->name('time.index');
	//url schedule selesai pilih
	Route::get('/classroom/{id_class}/instructors/{id_instructors}/time/{id_schedule}','ScheduleController@summary')->name('schedule.summary');
	//menyimpan url schedule
	Route::get('/classroom/{id_class}/instructors/{id_instructors}/time/{id_time}/date/{id_date}/user/{id_user}','ScheduleController@savesummary')->name('schedule.savesummary');
	/*
	Route::get('/home', function() {
		
		$parameter =[
			'id' 	=> Auth::user()->id,
			'nama' 	=> Auth::user()->name,
		];

		$enkripsi= \Crypt::encrypt($parameter);
		return view('home',compact('enkripsi'));
	})->name('home');
	*/
});

Auth::routes();
