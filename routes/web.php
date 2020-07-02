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
            | .index   -> code, name, description (simple)
            | .create  -> (+) code, name, description
            | .store   -> (+) id, slug, created_at
            | .show    -> code, name, description (full)
            | .edit    -> code, name, description (full)
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> code, name, description (simple)
            | .show    -> code, name, description (full)
            |
            | STUDENT
            | .index   -> code, name, description (simple)
            | .show    -> code, name, description (full)
            */

            'material_types'       => 'MaterialTypeController',

            /*
            |-------------------------------------------------
            | Izin Akses "CourseType"
            |-------------------------------------------------
            | ADMIN
            | .index   -> code, name, description (simple), count_student_min, count_student_max
            | .create  -> (+) code, name, description, count_student_min, count_student_max
            | .store   -> (+) id, slug, created_at
            | .show    -> code, name, description (full), count_student_min, count_student_max
            | .edit    -> code, name, description (full), count_student_min, count_student_max
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> code, name, description (simple), count_student_min, count_student_max
            | .show    -> code, name, description (full), count_student_min, count_student_max
            |
            | STUDENT
            | .index   -> code, name, description (simple), count_student_min, count_student_max
            | .show    -> code, name, description (full), count_student_min, count_student_max
            */

            'course_types'         => 'CourseTypeController',

            /*
            |-------------------------------------------------
            | Izin Akses "CourseLevel"
            |-------------------------------------------------
            | ADMIN
            | .index   -> code, name, description (simple)
            | .create  -> (+) code, name, description
            | .store   -> (+) id, slug, created_at
            | .show    -> code, name, description (full)
            | .edit    -> code, name, description (full)
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> code, name, description (simple)
            | .show    -> code, name, description (full)
            |
            | STUDENT
            | .index   -> code, name, description (simple)
            | .show    -> code, name, description (full)
            */

            'course_levels'        => 'CourseLevelController',

            /*
            |-------------------------------------------------
            | Izin Akses "CourseLevelDetail"
            |-------------------------------------------------
            | ADMIN
            | .index   -> code, name, description (simple)
            | .create  -> (+) code, name, description
            | .store   -> (+) id, slug, created_at
            | .show    -> code, name, description (full)
            | .edit    -> code, name, description (full)
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> code, name, description (simple)
            | .show    -> code, name, description (full)
            |
            | STUDENT
            | .index   -> code, name, description (simple)
            | .show    -> code, name, description (full)
            */

            'course_level_details' => 'CourseLevelDetailController',

            /*
            |-------------------------------------------------
            | Izin Akses "CoursePackage"
            |-------------------------------------------------
            | ADMIN
            | .index   -> material_types.name, course_types.name, course_levels.name, course_level_details.name, title, description (simple), count_session, price
            | .create  -> (+) material_type_id, course_type_id, course_level_id, course_level_detail_id, title, description (full), requirement (full), count_session, price
            | .store   -> (+) id, slug, created_at
            | .show    -> material_types.name, course_types.name, course_levels.name, course_level_details.name, title, description (full), requirement (full), count_session, price
            | .edit    -> material_type_id, course_type_id, course_level_id, course_level_detail_id, title, description (full), requirement (full), count_session, price
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> material_types.name, course_types.name, course_levels.name, course_level_details.name, title, description (simple), count_session, price
            | .show    -> material_types.name, course_types.name, course_levels.name, course_level_details.name, title, description (full), requirement (full), count_session, price
            |
            | STUDENT
            | .index   -> material_types.name, course_types.name, course_levels.name, course_level_details.name, title, description (simple), count_session, price
            | .show    -> material_types.name, course_types.name, course_levels.name, course_level_details.name, title, description (full), requirement (full), count_session, price
            */

            'course_packages'      => 'CoursePackageController',

            /*
            |-------------------------------------------------
            | Izin Akses "Course"
            |-------------------------------------------------
            | ADMIN
            | .index   -> course_packages.title, title, description (simple)
            | .create  -> (+) course_package_id FROM [material_types.name, course_types.name, course_levels.name, course_level_details.name], title, description (full), requirement (full)
            | .store   -> (+) id, slug, created_at
            | .show    -> course_packages.title, title, description (full), requirement (full)
            | .edit    -> course_package_id FROM [material_types.name, course_types.name, course_levels.name, course_level_details.name], title, description (full), requirement (full)
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> course_packages.title, title, description (simple)
            | .create  -> (+) course_package_id FROM [material_types.name, course_types.name, course_levels.name, course_level_details.name], title, description (full), requirement (full)
            | .store   -> (+) id, slug, created_at
            | .show    -> course_packages.title, title, description (full), requirement (full)
            | .edit    -> course_package_id FROM [material_types.name, course_types.name, course_levels.name, course_level_details.name], title, description (full), requirement (full)
            | .update  -> (+) updated_at
            | .destroy -> (requested_to_ADMIN)
            |
            | STUDENT
            | .index   -> course_packages.title, title, description (simple)
            | .show    -> course_packages.title, title, description (full), requirement (full)
            */

            'courses'              => 'CourseController',

            /*
            |-------------------------------------------------
            | Izin Akses "Session"
            |-------------------------------------------------
            | ADMIN
            | .index   -> users.name FROM [users.first_name, users.last_name], courses.title, schedules.schedule_time, title, description (simple), link_zoom
            | .create  -> (+) course_id, users.id FROM [users.first_name, users.last_name], schedule_id FROM INPUT(DATE, TIME), title, description (full), requirement (full), link_zoom
            | .store   -> (+) id, slug, created_at
            | .show    -> users.name FROM [users.first_name, users.last_name], courses.title, schedules.schedule_time, title, description (full), requirement (full), link_zoom
            | .edit    -> course_id, users.id FROM [users.first_name, users.last_name], schedule_id FROM INPUT(DATE, TIME), title, description (full), requirement (full), link_zoom
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> courses.title, schedules.schedule_time, title, description (simple), link_zoom
            | .create  -> (+) course_id, schedule_id FROM INPUT(DATE, TIME), title, description (full), requirement (full), link_zoom
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.title, schedules.schedule_time, title, description (full), requirement (full), link_zoom
            | .edit    -> course_id, schedule_id FROM INPUT(DATE, TIME), title, description (full), requirement (full), link_zoom
            | .update  -> (+) updated_at
            | .destroy -> (requested_to_ADMIN)
            |
            | STUDENT
            | .index   -> courses.title, schedules.schedule_time, title, description (simple), link_zoom
            | .show    -> courses.title, schedules.schedule_time, title, description (full), requirement (full), link_zoom
            */

            'sessions'             => 'SessionController',

            /*
            |-------------------------------------------------
            | Izin Akses "CourseCertificate"
            |-------------------------------------------------
            | ADMIN
            | .index   -> courses.name, users.name FROM [users.first_name, users.last_name], image FROM path
            | .create  -> (+) course_registration_id FROM [courses.name, users.name FROM [users.first_name, users.last_name]], path FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.name, users.name FROM [users.first_name, users.last_name], image FROM path
            | .edit    -> course_registration_id FROM [courses.name, users.name FROM [users.first_name, users.last_name]], path FROM IMAGE
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> courses.name, users.name FROM [users.first_name, users.last_name], image FROM path
            | .create  -> (+) course_registration_id FROM [courses.name, users.name FROM [users.first_name, users.last_name]], path FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.name, users.name FROM [users.first_name, users.last_name], image FROM path
            | .edit    -> course_registration_id FROM [courses.name, users.name FROM [users.first_name, users.last_name]], path FROM IMAGE
            | .update  -> (requested_to_ADMIN)
            |
            | STUDENT
            | .index   -> courses.name, image FROM path
            | .show    -> courses.name, image FROM path
            */

            'course_certificates'  => 'CourseCertificateController',

            /*
            |-------------------------------------------------
            | Izin Akses "MaterialPublic"
            |-------------------------------------------------
            | ADMIN
            | .index   -> course_packages.title, name, description (simple), image FROM path
            | .create  -> (+) course_package_id FROM [material_types.name, course_types.name, course_levels.name, course_level_details.name], name, description (full), path FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> course_packages.title, name, description (full), image FROM path
            | .edit    -> course_package_id FROM [material_types.name, course_types.name, course_levels.name, course_level_details.name], name, description (full), path FROM IMAGE
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> course_packages.title, name, description (simple), image FROM path
            | .create  -> (+) course_package_id FROM [material_types.name, course_types.name, course_levels.name, course_level_details.name], name, description (full), path FROM IMAGE
            | .store   -> (requested_to_ADMIN)
            | .show    -> course_packages.title, name, description (full), image FROM path
            | .edit    -> course_package_id FROM [material_types.name, course_types.name, course_levels.name, course_level_details.name], name, description (full), path FROM IMAGE
            | .update  -> (requested_to_ADMIN)
            | .destroy -> (requested_to_ADMIN)
            |
            | STUDENT
            | .index   -> name, description (simple), image FROM path
            | .show    -> name, description (full), image FROM path
            */

            'material_publics'     => 'MaterialPublicController',

            /*
            |-------------------------------------------------
            | Izin Akses "MaterialSession"
            |-------------------------------------------------
            | ADMIN
            | .index   -> courses.title, sessions.title, users.name FROM [users.first_name, users.last_name], name, description (simple), image FROM path
            | .create  -> (+) courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.title, sessions.title, users.name FROM [users.first_name, users.last_name], name, description (full), image FROM path
            | .edit    -> courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> courses.title, sessions.title, name, description (simple), image FROM path
            | .create  -> (+) courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.title, sessions.title, name, description (full), image FROM path
            | .edit    -> courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | STUDENT
            | .index   -> courses.title, sessions.title, users.name FROM INSTRUCTOR[users.first_name, users.last_name], name, description (simple), image FROM path
            | .show    -> courses.title, sessions.title, users.name FROM INSTRUCTOR[users.first_name, users.last_name], name, description (full), image FROM path
            */

            'material_sessions'    => 'MaterialSessionController',

            /*
            |-------------------------------------------------
            | ----------------------------Izin Akses "User"
            |-------------------------------------------------
            | ADMIN
            | .index   -> courses.title, sessions.title, users.name FROM [users.first_name, users.last_name], name, description (simple), image FROM path
            | .create  -> (+) courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.title, sessions.title, users.name FROM [users.first_name, users.last_name], name, description (full), image FROM path
            | .edit    -> courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> courses.title, sessions.title, name, description (simple), image FROM path
            | .create  -> (+) courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.title, sessions.title, name, description (full), image FROM path
            | .edit    -> courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | STUDENT
            | .index   -> courses.title, sessions.title, users.name FROM INSTRUCTOR[users.first_name, users.last_name], name, description (simple), image FROM path
            | .show    -> courses.title, sessions.title, users.name FROM INSTRUCTOR[users.first_name, users.last_name], name, description (full), image FROM path
            */

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
