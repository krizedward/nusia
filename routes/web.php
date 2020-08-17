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

	/*Route::get('/home', function() {
            return view('home');
	})->name('home');*/

	//Route::get('/home/{id}', 'HomeController@index')->name('home');

	Route::get('/home', 'HomeController@index')->name('home');

        // bug apabila proses logout error, maka metode GET tidak didukung.
        Route::get('/logout', function() {
            return redirect()->route('home');
        });

        Route::get('/material/private', 'MaterialController@private_index')->name('materials.private_index');
        Route::get('/material/free-trial', 'MaterialController@free_trial_index')->name('materials.free_trial_index');
        Route::get('/material/group', 'MaterialController@group_index')->name('materials.group_index');
        Route::get('/material/create', 'MaterialController@create')->name('materials.create');
        Route::post('/material/create', 'MaterialController@store')->name('materials.store');
        Route::get('/material/edit/{id}', 'MaterialController@edit')->name('materials.edit');
        Route::put('/material/edit/{id}', 'MaterialController@update')->name('materials.update');
        Route::delete('/material/destroy/{id}', 'MaterialController@destroy')->name('materials.destroy');
        Route::get('/material/download/{id}', 'MaterialController@download')->name('materials.download');

        // Apabila berencana membuat routing
        // selain Route::resource(s) (pada keyword yang sama),
        // lakukan deklarasi SEBELUM menulis baris kode Route::resource(s).
        Route::resources([
            'material_types'        => 'MaterialTypeController',
            'course_types'          => 'CourseTypeController',
            'course_levels'         => 'CourseLevelController',
            'course_level_details'  => 'CourseLevelDetailController',
            'course_packages'       => 'CoursePackageController',
            'courses'               => 'CourseController',
            'sessions'              => 'SessionController',
            'course_certificates'   => 'CourseCertificateController',
            'material_publics'      => 'MaterialPublicController',
            'material_sessions'     => 'MaterialSessionController',
            'users'                 => 'UserController'
        ]);

        // menggunakan nested resources: /courses/{course}/registrations/{user}
        Route::resource('courses-registrations', 'CourseRegistrationController')
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

        // menggunakan nested resources: /session-registrations/{session_registration}
        Route::resource('session-registrations', 'SessionRegistrationController')
            ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
            ->names([
                'index'   => 'session_registrations.index',
                'create'  => 'session_registrations.create',
                'store'   => 'session_registrations.store',
                'show'    => 'session_registrations.show',
                'edit'    => 'session_registrations.edit',
                'update'  => 'session_registrations.update',
                'destroy' => 'session_registrations.destroy'
            ])
            ->parameters([
                'registrations' => 'user'
            ]);

        // menggunakan resources: /schedules/{user}
        Route::resource('schedules', 'ScheduleController')
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
            ->parameters([
                'schedules' => 'user'
            ]);

        // menggunakan resources: /ratings/{session}
        Route::resource('ratings', 'RatingController')
            ->only(['index', 'store', 'destroy'])
            ->parameters([
                'ratings' => 'session'
            ]);

        // menggunakan resources: /instructors/{user}
        Route::resource('instructors', 'InstructorController')
            ->parameters([
                'instructors' => 'user'
            ]);

        // menggunakan resources: /students/{user}
        Route::resource('students', 'StudentController')
            ->parameters([
                'students' => 'user'
            ]);

    /*link custom*/
    //halaman instructor
    Route::get('/schedules/{course_type?}', 'ScheduleController@index')->name('schedules.index');
    Route::get('/schedules/private','ScheduleController@private')->name('schedules.private');
    Route::get('/schedules/group','ScheduleController@group')->name('schedules.group');

    Route::get('/session/private', 'SessionController@private')->name('session.private');
    Route::get('/session/group', 'SessionController@group')->name('session.group');

    Route::get('/materials', 'MaterialController@index')->name('materials.index');
    Route::get('/materials/create', 'MaterialController@create')->name('materials.create');
    Route::get('/materials/download/{public_or_session}/{id}', 'MaterialController@download')->name('materials.download');

    //halaman student
    Route::get('/registration/student/trial','RegistrationController@trial')->name('registration.trial');
    Route::get('/registration/student/private','RegistrationController@private')->name('registration.private');
    Route::get('/registration/student/private/instructor','RegistrationController@instructor')->name('registration.private-instructor');
    Route::get('/registration/student/private/instructor/time','RegistrationController@time')->name('registration.private-time');
    Route::get('/registration/student/group','RegistrationController@group')->name('registration.group');

    Route::get('/schedules/student/private','ScheduleController@private')->name('schedules.student.private');
    Route::get('/schedules/student/group','ScheduleController@group')->name('schedules.student.group');

    Route::get('/courses','CourseController@index')->name('courses.index');
    Route::post('/courses','CourseRegistrationController@store')->name('course_registrations.store');

    //halaman questionnaire
    //questionnaire aku taruh di HomeController
    Route::get('student/questionnaire', 'HomeController@questionnaire')->name('layouts.questionnaire');
    Route::post('student/questionnaire', 'HomeController@store')->name('questionnaire.store');
    Route::get('profile/{id}', 'HomeController@profile')->name('profile');
    /*end link*/

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

//verifikasi email user
Auth::routes(['verify' => true]);
