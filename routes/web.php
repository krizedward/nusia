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

Route::redirect('/', 'login');

Route::group(['middleware'=>'auth'], function() {

	Route::get('/home',function() {
		return view('home');
	})->name('home');

	//Route::get('/home/{id}', 'HomeController@index')->name('home');

        Route::resources([
            /*
            |-------------------------------------------------
            | Izin Akses "MaterialType"
            |-------------------------------------------------
            | ADMIN
            | .index   -> Akses semua row dalam satu tampilan yang sama.
            | .create  -> Membuat jenis materi baru.
            | .store   -> Mengirim request pembuatan jenis materi baru.
            | .show    -> 
            | .edit    -> 
            | .update  -> 
            | .destroy -> 
            |
            | INSTRUCTOR
            | .index   -> Akses semua row dalam satu tampilan yang sama.
            | .show    -> 
            |
            | STUDENT
            | .index   -> Akses semua row dalam satu tampilan yang sama.
            | .show    -> 
            */

            'material_types'       => 'MaterialTypeController',

            /*
            |-------------------------------------------------
            | Izin Akses "CourseType"
            |-------------------------------------------------
            | .index   -> ADMIN, INSTRUCTOR, STUDENT
            | .create  -> ADMIN
            | .store   -> ADMIN
            | .show    -> ADMIN, INSTRUCTOR, STUDENT
            | .edit    -> ADMIN
            | .update  -> ADMIN
            | .destroy -> ADMIN
            */

            'course_types'         => 'CourseTypeController',
            'course_levels'        => 'CourseLevelController',
            'course_level_details' => 'CourseLevelDetailController',
            'course_packages'      => 'CoursePackageController',
            'courses'              => 'CourseController',
            'sessions'             => 'SessionController',
            'course_certificates'  => 'CourseCertificateController',
            'material_publics'     => 'MaterialPublicController',
            'material_sessions'    => 'MaterialSessionController',
            'users'                => 'UserController'
        ]);

        // menggunakan nested resources: /courses/{course}/registrations/{user}
        Route::resource('courses.registrations', 'CourseRegistrationController')
            ->only(['index', 'create', 'store', 'destroy'])
            ->names([
                'index'   => 'course_registrations.index',
                'create'  => 'course_registrations.create',
                'store'   => 'course_registrations.store',
                'destroy' => 'course_registrations.destroy'
            ])
            ->parameters([
                'registrations' => 'user'
            ]);

        // menggunakan nested resources: /courses/{course}/payments/{user}
        Route::resource('courses.payments', 'CoursePaymentController')
            ->names([
                'index'   => 'course_payments.index',
                'create'  => 'course_payments.create',
                'store'   => 'course_payments.store',
                'show'    => 'course_payments.show',
                'edit'    => 'course_payments.edit',
                'update'  => 'course_payments.update',
                'destroy' => 'course_payments.destroy'
            ])
            ->parameters([
                'payments' => 'user'
            ]);

        // menggunakan nested resources: /sessions/{session}/registrations/{user}
        Route::resource('sessions.registrations', 'SessionRegistrationController')
            ->names([
                'index'   => 'session_registrations.index',
                'create'  => 'session_registrations.create',
                'store'   => 'session_registrations.store',
                'update'  => 'session_registrations.update',
                'destroy' => 'session_registrations.destroy'
            ])
            ->parameters([
                'registrations' => 'user'
            ]);

	Route::get ('/session/registration', 'SessionRegistrationController@index')   ->name('session_registration.index');
	Route::post('/session/registration', 'SessionRegistrationController@store')   ->name('session_registration.store');
	Route::put ('/session/registration', 'SessionRegistrationController@update')  ->name('session_registration.update');
	Route::post('/session/registration', 'SessionRegistrationController@destroy') ->name('session_registration.destroy');
	Route::get ('/schedule', 'ScheduleController@index')   ->name('schedule.index');
	Route::post('/schedule', 'ScheduleController@store')   ->name('schedule.store');
	Route::put ('/schedule', 'ScheduleController@update')  ->name('schedule.update');
	Route::post('/schedule', 'ScheduleController@destroy') ->name('schedule.destroy');
	Route::get ('/session/{session_id}/rating', 'RatingController@index')   ->name('rating.index');
	Route::post('/session/{session_id}/rating', 'RatingController@store')   ->name('rating.store');
	Route::put ('/session/{session_id}/rating', 'RatingController@update')  ->name('rating.update');
	Route::post('/session/{session_id}/rating', 'RatingController@destroy') ->name('rating.destroy');
	//Route::get ('/user/survey', 'UserSurveyController@index')   ->name('user_survey.index');
	//Route::get ('/user/survey/create', 'UserSurveyController@index')   ->name('user_survey.index');

	//menampilkan detail dari schedule
	//Route::get('/schedule/detail/{id_schedule}','ScheduleController@detail')->name('schedule.detail');
	//menampilkan halaman schedule
	//Route::get('/schedule/{user_id}', 'ScheduleController@index')->name('schedule.index');
	//url create schedule instuctor
	//Route::post('/create/schedule/instuctor/{id}','InstructorsController@schedule');
	//url pilih instructor
	//Route::get('/schedule/{user_id}/{instructor_id}', 'ScheduleController@choose')->name('choose');
	//url simpan data 
	//Route::post('/schedule/store', 'ScheduleController@store')->name('store');
	//url halaman pilih instructor
	//Route::get('/classroom/{id}/instructors/','InstructorsController@index')->name('instructors.index');
	//url memilih instrutor
	//Route::get('/choose/classroom/{id_class}/instructors/{id_instructors}','InstructorsController@choose')->name('instructors.choose');
	//url verifikasi jadwal
	//Route::get('/verfication-schedule/{user_id}/{vs_id}','ScheduleController@verfication')->name('verfication');
	//url pilih session
	//Route::get('/session/{user_id}','ScheduleController@session')->name('session');
	//menampilkan halaman share material
	//Route::get('/material','MaterialClassController@index')->name('material.index');
	//menampilkan halaman detail share material
	//Route::get('/material/share/detail/{class_id}','MaterialClassController@detail')->name('material.detail');
	//url simpan data
	//Route::post('/material/store','MaterialClassController@store');
	//url download material
	//Route::get('/material/download/{id}','MaterialClassController@download');
	//url akses material di student
	//Route::get('/material/student/{id_class}','MaterialClassController@student')->name('material.student');
	//url halaman jadwal instructor
	//Route::get('/schedule/instructors','ScheduleController@instructors');
	//url halaman classrooms
	//Route::get('/classroom','ClassroomController@index')->name('classroom.index');
	//url memilih kelas di student
	//Route::get('/choose/classroom/{id_class}','ClassroomController@choose')->name('classroom.choose');
	//url halaman calendar
	//Route::get('/classroom/{id_class}/instructors/{id_instructors}/time','ScheduleController@calendar')->name('time.index');
	//url schedule selesai pilih
	//Route::get('/classroom/{id_class}/instructors/{id_instructors}/time/{id_schedule}','ScheduleController@summary')->name('schedule.summary');
	//menyimpan url schedule
	//Route::get('/classroom/{id_class}/instructors/{id_instructors}/time/{id_time}/date/{id_date}/user/{id_user}','ScheduleController@savesummary')->name('schedule.savesummary');
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
