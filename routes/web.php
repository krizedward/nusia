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

//Route::redirect('/', 'login');
//akses untuk menguji tampilan draft

/*
Route::get('/test', function () {
    return view('courses.student_private_schedule');
});
*/


Route::get('/', 'HomeController@landing_page')->name('index');

Route::get('/terms-of-service', function() {
    return view('terms');
})->name('terms');

Route::group(['middleware'=>'auth'], function() {

        // NEW ROUTING FOR ADMIN: 9 Oktober 2020 dan selanjutnya.
        /* VIEW (SIDEBAR) */
        Route::get('/courses', 'CourseController@index')->name('courses.index');
        Route::post('/courses', 'MaterialTypeController@store')->name('material_types.index'); // dilakukan pada view courses.index
        Route::post('/courses', 'CourseTypeController@store')->name('course_types.index'); // dilakukan pada view courses.index
        Route::post('/courses', 'CourseLevelController@store')->name('course_levels.index'); // dilakukan pada view courses.index
        Route::post('/courses', 'CoursePackageController@store')->name('course_packages.index'); // dilakukan pada view courses.index
        Route::post('/courses', 'CourseController@store')->name('courses.index'); // dilakukan pada view courses.index
        Route::put('/data/{id}', 'MaterialTypeController@update')->name('material_types.update'); // dilakukan pada view courses.index
        Route::put('/data/{id}', 'CourseTypeController@update')->name('course_types.update'); // dilakukan pada view courses.index
        Route::put('/data/{id}', 'CourseLevelController@update')->name('course_levels.update'); // dilakukan pada view courses.index
        Route::put('/data/{id}', 'CoursePackageController@update')->name('course_packages.update'); // dilakukan pada view courses.index
        Route::delete('/data/{id}', 'MaterialTypeController@destroy')->name('material_types.destroy'); // dilakukan pada view courses.index
        Route::delete('/data/{id}', 'CourseTypeController@destroy')->name('course_types.destroy'); // dilakukan pada view courses.index
        Route::delete('/data/{id}', 'CourseLevelController@destroy')->name('course_levels.destroy'); // dilakukan pada view courses.index
        Route::delete('/data/{id}', 'CoursePackageController@destroy')->name('course_packages.destroy'); // dilakukan pada view courses.index
        /* VIEW */
        Route::get('/courses/{id}', 'CourseController@show')->name('courses.show');
        Route::put('/courses/{id}', 'CourseController@update')->name('courses.update'); // dilakukan pada view courses.show
        Route::delete('/courses/{id}', 'CourseController@destroy')->name('courses.destroy'); // dilakukan pada view courses.show
        Route::post('/schedules', 'ScheduleController@store')->name('schedules.index'); // dilakukan pada view courses.show
        Route::post('/sessions', 'SessionController@store')->name('sessions.index'); // dilakukan pada view courses.show

        /* VIEW (SIDEBAR) */
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::post('/users', 'UserController@store')->name('users.store'); // dilakukan pada view users.index
        /* VIEW */
        Route::get('/users/{id}', 'UserController@show')->name('users.show');
        Route::put('/users/{id}', 'UserController@update')->name('users.update'); // dilakukan pada view users.show
        Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy'); // dilakukan pada view users.show
        Route::post('/users', 'CourseRegistrationController@store')->name('course_registrations.store'); // dilakukan pada view users.show
        /* VIEW */
        Route::get('/users/{user_id}/courses/{course_id}', 'CourseRegistrationController@show')->name('course_registrations.show');
        Route::put('/users/{user_id}/courses/{course_id}', 'CourseRegistrationController@update')->name('course_registrations.update'); // dilakukan pada view course_registrations.show
        Route::delete('/users/{user_id}/courses/{course_id}', 'CourseRegistrationController@destroy')->name('course_registrations.destroy'); // dilakukan pada view course_registrations.show
        Route::put('/courses/{id}', 'CourseController@update')->name('courses.update'); // dilakukan pada view course_registrations.show
        Route::put('/sessions/{id}', 'SessionController@update')->name('sessions.update'); // dilakukan pada view course_registrations.show
        Route::put('/schedules/{id}', 'ScheduleController@update')->name('schedules.update'); // dilakukan pada view course_registrations.show
        /* VIEW */
        Route::get('/users/{user_id}/courses/{course_id}/sessions/{session_id}', 'SessionRegistrationController@show')->name('session_registrations.show');
        Route::put('/users/{user_id}/courses/{course_id}/sessions/{session_id}', 'SessionRegistrationController@update')->name('session_registrations.update'); // dilakukan pada view session_registrations.show
        Route::destroy('/users/{user_id}/courses/{course_id}/sessions/{session_id}', 'SessionRegistrationController@destroy')->name('session_registrations.destroy'); // dilakukan pada view session_registrations.show
        Route::post('/submission', 'TaskSubmissionController@store')->name('task_submissions.store'); // dilakukan pada view session_registrations.show
        Route::put('/submission/{id}', 'TaskSubmissionController@update')->name('task_submissions.update'); // dilakukan pada view session_registrations.show
        Route::destroy('/submission/{id}', 'TaskSubmissionController@destroy')->name('task_submissions.destroy'); // dilakukan pada view session_registrations.show
        Route::put('/task/{id}', 'TaskController@update')->name('tasks.update'); // dilakukan pada view session_registrations.show

        /* VIEW */
        Route::get('/forms', 'FormController@index')->name('forms.index');

        /* VIEW */
        Route::get('/website-rating', 'FormResponseController@index_admin')->name('form_responses.index_admin');

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

        //Private Course Class
        Route::get('/course/private','CourseController@private')->name('courses.private');//menampilkan macam course yang dipilih
        Route::get('/course/instructor/private','InstructorController@private')->name('instructors.private');//menampilkan instructor
        //Route::get('/course/instructor/{id}/private','InstructorController@privates')->name('instructors.privates');
        Route::get('/course/instructor/schedules/private/{id}','ScheduleController@private')->name('schedules.private');//menampilkan jadwal instructor

        // REGISTRASI PRIVATE & GROUP CLASSES
          // Dari form registrasi Student, lanjut ke memilih MaterialType (General Indonesian Language, Basic Conversation, etc)
          Route::get('/student/materials', 'MaterialTypeController@index')->name('material_types.index');

          // Dari memilih MaterialType, lanjut ke memilih CourseType (Private/Public) via CoursePackage
          Route::get('/student/courses/{material_type_id}', 'CoursePackageController@index_material_type')->name('course_packages.index_material_type');

        //Admin
        Route::get('/schedules/instructor/choose','ScheduleController@instructor')->name('schedules.admin_instrucstor');
        Route::get('/schedules/instructor/{code}/detail','ScheduleController@detail')->name('schedules.admin_index');

        Route::get('/sessions/instructor/choose','SessionController@instructor')->name('sessions.admin_instrucstor');
        Route::get('/sessions/instructor/{code}/detail','SessionController@detail')->name('sessions.admin_index');

        // Apabila berencana membuat routing
        // selain Route::resource(s) (pada keyword yang sama),
        // lakukan deklarasi SEBELUM menulis baris kode Route::resource(s).
        Route::resources([
            'payment_types'                 => 'PlacementTypeController',
            'placement_tests'               => 'PlacementTestController',
            'tasks'                         => 'TaskController',
            'task_submissions'              => 'TaskSubmissionController',
            'form_questions'                => 'FormQuestionController',
            'form_question_choices'         => 'FormQuestionChoiceController',
            'form_response_details'         => 'FormResponseDetailController',
            'other_users'                   => 'OtherUserControllerController',
            'messages'                      => 'MessageController',
            'notification_datas'            => 'NotificationDataController',
            'notification_durations'        => 'NotificationDurationController',
            'content_labels'                => 'ContentLabelController',
            'notification_labels'           => 'NotificationLabelController',
            'notifications'                 => 'NotificationController',
            'notification_transactions'     => 'NotificationTransactionController',
            'user_notifications'            => 'UserNotificationController',
            'material_types'                => 'MaterialTypeController',
            'course_types'                  => 'CourseTypeController',
            'course_levels'                 => 'CourseLevelController',
            'course_level_details'          => 'CourseLevelDetailController',
            'course_packages'               => 'CoursePackageController',
            'courses'                       => 'CourseController',
            'sessions'                      => 'SessionController',
            'course_certificates'           => 'CourseCertificateController',
            'material_publics'              => 'MaterialPublicController',
            'material_sessions'             => 'MaterialSessionController',
            'users'                         => 'UserController'
        ]);

        // menggunakan nested resources: /courses/{course}/registrations/{user}
        /*Route::resource('courses-registrations', 'CourseRegistrationController')
            ->only(['index', 'create', 'store', 'destroy'])
            ->names([
                'index'   => 'course_registrations.index',
                'create'  => 'course_registrations.create',
                'store'   => 'course_registrations.store',
                'destroy' => 'course_registrations.destroy'
            ])
            ->parameters([
                'registrations' => 'user'
            ]);*/

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
    Route::get('student/registration-form', 'HomeController@questionnaire')->name('layouts.questionnaire');
    Route::post('student/registration-form', 'HomeController@store')->name('questionnaire.store');

    // menampilkan profil akun
    Route::get('profile/', 'ProfileController@index')->name('profile');

    // sebagai catatan, Admin dapat mengedit profil Instructor dan Student, apabila diperlukan.
    Route::put('profile/', 'ProfileController@update')->name('profile.update');

    // menampilkan profile Student (dilakukan oleh Instructor)
    Route::get('profile/student/{student_id}', 'ProfileController@show')->name('profiles.show');

    // menampilkan contact
    Route::get('contact/', 'HomeController@contact')->name('contact');

    // BAGIAN FORMULIR
        // tampilan admin
        Route::get('/forms', 'FormController@index')->name('forms.index');               // Melihat daftar "formnya" (formnya, bukan responnya).
        Route::get('/forms/create', 'FormController@create')->name('forms.create');      // TIDAK DIGUNAKAN: Membuat "formnya" yang baru (formnya, bukan responnya).
        Route::post('/forms/create', 'FormController@store')->name('forms.store');       // TIDAK DIGUNAKAN: Membuat "formnya" yang baru (formnya, bukan responnya).
        Route::get('/forms/show/{id}', 'FormController@show')->name('forms.show');       // TIDAK DIGUNAKAN: Melihat struktur "formnya" secara detail (formnya, bukan responnya).
        Route::get('/forms/edit/{id}', 'FormController@edit')->name('forms.edit');       // TIDAK DIGUNAKAN: Mengedit struktur "formnya" (formnya, bukan responnya).
        Route::put('/forms/update/{id}', 'FormController@update')->name('forms.update'); // TIDAK DIGUNAKAN: Mengedit struktur "formnya" (formnya, bukan responnya).
        Route::delete('/forms/{id}', 'FormController@destroy')->name('forms.destroy');   // TIDAK DIGUNAKAN: Menghapus struktur "formnya" (formnya DAN SEMUA RESPONNYA).

        // tampilan admin dan/atau instructor (melihat atribut Forms::is_accessible_by)
        Route::get('/forms/responses', 'FormResponseController@index')->name('form_responses.index'); // Menampilkan semua form respon.
        Route::get('/forms/responses/form/{form_id}', 'FormResponseController@index_form')->name('form_responses.index_form'); // Menampilkan semua form respon untuk form id tertentu (bisa jadi tergabung dari banyak sesi berbeda).
        Route::get('/forms/responses/session/{session_id}', 'FormResponseController@index_session')->name('form_responses.index_session'); // Menampilkan semua form respon untuk sesi tertentu (tentu saja memiliki form id yang sama).
        Route::get('/forms/responses/{session_registration_id}', 'FormResponseController@show')->name('form_responses.show'); // 1 session_registration_id hanya memiliki 1 jenis form tertentu, sesuai dengan sesinya masing-masing

        // TEMP REDIRECT FOR DEVELOPMENT PURPOSES
        //Route::redirect('/forms/responses', '/home');
        Route::redirect('/forms/responses/form', '/home');
        Route::redirect('/forms/responses/session', '/home');

        // tampilan student
        Route::get('/forms/student/create/{session_registration_id}', 'FormResponseController@create')->name('form_responses.create'); // Membuat form response yang baru.
        Route::post('/forms/student/create/{session_registration_id}', 'FormResponseController@store')->name('form_responses.store');  // Membuat form response yang baru.

    // BAGIAN ABSENSI
        // tampilan instructor (juga admin) untuk form absensi. untuk melihat tampilan ini, instructor (khusus instructor) harus mengakses melalui tampilan session_registrations.index
        // (hanya dapat diakses oleh kedua instructor yang mengajar pada kelas ybs. hanya 1 instructor saja yang perlu mengisi form absensi)
        Route::get('/forms/student/attendance/{session_id}', 'AttendanceController@edit')->name('attendances.edit');
        Route::put('/forms/student/attendance/{session_id}', 'AttendanceController@update')->name('attendances.update');

        // tampilan instructor (juga admin) untuk melihat pendaftaran mahasiswa pada satu kelas.
        Route::get('/class-registration/{course_id}', 'CourseRegistrationController@index_by_course_id')->name('course_registrations.index_by_course_id');

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
