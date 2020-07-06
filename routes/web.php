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

	Route::get('/home', function() {
            return view('home');
	})->name('home');

	//Route::get('/home/{id}', 'HomeController@index')->name('home');

        // Apabila berencana membuat routing
        // selain Route::resource(s) (pada keyword yang sama),
        // lakukan deklarasi SEBELUM menulis baris kode Route::resource(s).
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
            | .index   -> users.name FROM INSTRUCTOR[users.first_name, users.last_name], courses.title (OR course_packages.title), schedules.schedule_time, title, description (simple), link_zoom
            | .create  -> (+) course_id, users.id FROM INSTRUCTOR[users.first_name, users.last_name], schedule_id FROM INPUT(DATE, TIME), title, description (full), requirement (full), link_zoom
            | .store   -> (+) id, slug, created_at
            | .show    -> users.name FROM INSTRUCTOR[users.first_name, users.last_name], courses.title (OR course_packages.title), schedules.schedule_time, title, description (full), requirement (full), link_zoom
            | .edit    -> course_id, users.id FROM INSTRUCTOR[users.first_name, users.last_name], schedule_id FROM INPUT(DATE, TIME), title, description (full), requirement (full), link_zoom
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> courses.title (OR course_packages.title), schedules.schedule_time, title, description (simple), link_zoom
            | .create  -> (+) course_id, schedule_id FROM INPUT(DATE, TIME), title, description (full), requirement (full), link_zoom
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.title (OR course_packages.title), schedules.schedule_time, title, description (full), requirement (full), link_zoom
            | .edit    -> course_id, schedule_id FROM INPUT(DATE, TIME), title, description (full), requirement (full), link_zoom
            | .update  -> (+) updated_at
            | .destroy -> (requested_to_ADMIN)
            |
            | STUDENT
            | .index   -> courses.title (OR course_packages.title), schedules.schedule_time, title, description (simple), link_zoom
            | .show    -> courses.title (OR course_packages.title), schedules.schedule_time, title, description (full), requirement (full), link_zoom
            */

            'sessions'             => 'SessionController',

            /*
            |-------------------------------------------------
            | Izin Akses "CourseCertificate"
            |-------------------------------------------------
            | ADMIN
            | .index   -> courses.name, users.name FROM STUDENT[users.first_name, users.last_name], image FROM path
            | .create  -> (+) course_registration_id FROM [courses.name, users.name FROM STUDENT[users.first_name, users.last_name]], path FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.name, users.name FROM STUDENT[users.first_name, users.last_name], image FROM path
            | .edit    -> course_registration_id FROM [courses.name, users.name FROM STUDENT[users.first_name, users.last_name]], path FROM IMAGE
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> courses.name, users.name FROM STUDENT[users.first_name, users.last_name], image FROM path
            | .create  -> (+) course_registration_id FROM [courses.name, users.name FROM STUDENT[users.first_name, users.last_name]], path FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.name, users.name FROM STUDENT[users.first_name, users.last_name], image FROM path
            | .edit    -> course_registration_id FROM [courses.name, users.name FROM STUDENT[users.first_name, users.last_name]], path FROM IMAGE
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
            | .index   -> courses.title (OR course_packages.title), sessions.title, users.name FROM INSTRUCTOR[users.first_name, users.last_name], name, description (simple), image FROM path
            | .create  -> (+) courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.title (OR course_packages.title), sessions.title, users.name FROM INSTRUCTOR[users.first_name, users.last_name], name, description (full), image FROM path
            | .edit    -> courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> courses.title (OR course_packages.title), sessions.title, name, description (simple), image FROM path
            | .create  -> (+) courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> courses.title (OR course_packages.title), sessions.title, name, description (full), image FROM path
            | .edit    -> courses.id, sessions.id, name, description (full), path FROM IMAGE
            | .update  -> (+) updated_at
            | .destroy -> (+) deleted_at
            |
            | STUDENT
            | .index   -> courses.title (OR course_packages.title), sessions.title, users.name FROM INSTRUCTOR[users.first_name, users.last_name], name, description (simple), image FROM path
            | .show    -> courses.title (OR course_packages.title), sessions.title, users.name FROM INSTRUCTOR[users.first_name, users.last_name], name, description (full), image FROM path
            */

            'material_sessions'    => 'MaterialSessionController',

            /*
            |-------------------------------------------------
            | Izin Akses "User"
            |-------------------------------------------------
            | ADMIN
            | .index   -> roles, image FROM image_profile, name FROM [first_name, last_name], email, phone
            | .create  -> (+) email, password, roles, citizenship, first_name, last_name, gender, birthdate, phone, image_profile FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> image FROM image_profile, roles, first_name, last_name, gender, birthdate, citizenship, email, email_verification_status FROM email_verified_at, OPTIONAL FOR (password), phone
            | .edit    -> email, password, roles, citizenship, first_name, last_name, gender, birthdate, phone, image_profile FROM IMAGE
            | .update  -> (+) updated_at, CONDITIONAL FOR (email_verified_at)
            | .destroy -> (+) deleted_at
            |
            | INSTRUCTOR
            | .index   -> image FROM image_profile, first_name, last_name, email
            | .create  -> (+) email, password, roles, citizenship, first_name, last_name, gender, birthdate, phone, image_profile FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> roles, image FROM image_profile, first_name, last_name, gender, birthdate, citizenship, email, email_verification_status FROM email_verified_at, HIDDEN FOR (password), phone
            | .edit    -> email, password, roles, citizenship, first_name, last_name, gender, birthdate, phone, image_profile FROM IMAGE
            | .update  -> (+) updated_at, CONDITIONAL FOR (email_verified_at)
            | .destroy -> (+) deleted_at
            |
            | STUDENT
            | .index   -> image FROM image_profile, first_name, last_name, email
            | .create  -> (+) email, password, roles, citizenship, first_name, last_name, gender, birthdate, phone, image_profile FROM IMAGE
            | .store   -> (+) id, slug, created_at
            | .show    -> roles, image FROM image_profile, first_name, last_name, gender, birthdate, citizenship, email, email_verification_status FROM email_verified_at, HIDDEN FOR (password), phone
            | .edit    -> email, password, roles, citizenship, first_name, last_name, gender, birthdate, phone, image_profile FROM IMAGE
            | .update  -> (+) updated_at, CONDITIONAL FOR (email_verified_at)
            | .destroy -> (+) deleted_at
            */

            'users'                => 'UserController'
        ]);

        /*
        |-------------------------------------------------
        | Izin Akses "CourseRegistration"
        |-------------------------------------------------
        | ADMIN
        | .index   -> courses.title (OR course_packages.title), users.name FROM STUDENT[users.first_name, users.last_name], course_registration_time FROM created_at, course_payments.status
        | .create  -> (+) course_id FROM courses.title (OR course_packages.title), student_id FROM STUDENT[users.first_name, users.last_name]
        | .store   -> (+) id, created_at
        | .destroy -> (+) deleted_at
        |
        | INSTRUCTOR
        | .index   -> courses.title (OR course_packages.title), users.name FROM STUDENT[users.first_name, users.last_name], course_registration_time FROM created_at
        | .destroy -> (requested_to_ADMIN)
        |
        | STUDENT
        | .index   -> courses.title (OR course_packages.title), course_registration_time FROM created_at, course_payments.status
        | .store   -> (+) id, created_at, course_id, student_id
        | .destroy -> (requested_to_INSTRUCTOR_then_to_ADMIN)
        */

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

        /*
        |-------------------------------------------------
        | Izin Akses "CoursePayment"
        |-------------------------------------------------
        | ADMIN
        | .index   -> courses.title (OR course_packages.title), users.name FROM STUDENT[users.first_name, users.last_name], method, amount, status, payment_time
        | .create  -> (+) course_registration_id FROM [courses.title (OR course_registrations.title), users.name FROM STUDENT[users.first_name, users.last_name]], method, amount, status, payment_time, path FROM IMAGE
        | .store   -> (+) id, slug, created_at
        | .show    -> courses.title (OR course_packages.title), users.name FROM STUDENT[users.first_name, users.last_name], method, amount, status, payment_time, image FROM path
        | .edit    -> course_registration_id FROM [courses.title (OR course_registrations.title), users.name FROM STUDENT[users.first_name, users.last_name]], method, amount, status, payment_time, path FROM IMAGE
        | .update  -> (+) updated_at
        | .destroy -> (+) deleted_at
        |
        | INSTRUCTOR (none)
        |
        | STUDENT
        | .index   -> courses.title (OR course_packages.title), method, amount, status, payment_time
        | .create  -> (+) course_registration_id FROM courses.title (OR course_registrations.title), method, amount, status, payment_time, path FROM IMAGE
        | .store   -> (+) id, slug, created_at
        | .show    -> courses.title (OR course_packages.title), method, amount, status, payment_time, image FROM path
        | .edit    -> course_registration_id FROM courses.title (OR course_registrations.title), method, amount, status, payment_time, path FROM IMAGE
        | .update  -> (+) updated_at
        */

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

        /*
        |-------------------------------------------------
        | Izin Akses "SessionRegistration"
        |-------------------------------------------------
        | ADMIN
        | .index   -> courses.title (OR course_packages.title), sessions.title, users.name FROM STUDENT[users.first_name, users.last_name], registration_time, status
        | .create  -> (+) course_registration_id FROM [courses.title (OR course_registrations.title), users.name FROM STUDENT[users.first_name, users.last_name]], session_id FROM sessions.title, registration_time, status
        | .store   -> (+) id, created_at
        | .edit    -> course_registration_id FROM [courses.title (OR course_registrations.title), users.name FROM STUDENT[users.first_name, users.last_name]], session_id FROM sessions.title, registration_time, status
        | .update  -> (+) updated_at
        | .destroy -> (+) deleted_at
        |
        | INSTRUCTOR
        | .index   -> courses.title (OR course_packages.title), sessions.title, users.name FROM STUDENT[users.first_name, users.last_name], registration_time, status
        | .update  -> (+) updated_at, CHANGE (status)
        |
        | STUDENT
        | .index   -> courses.title (OR course_packages.title), sessions.title, registration_time, status
        | .store   -> (+) id, status, created_at
        */

        // menggunakan nested resources: /sessions/{session}/registrations/{user}
        Route::resource('sessions.registrations', 'SessionRegistrationController')
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
            ->names([
                'index'   => 'session_registrations.index',
                'create'  => 'session_registrations.create',
                'store'   => 'session_registrations.store',
                'edit'    => 'session_registrations.edit',
                'update'  => 'session_registrations.update',
                'destroy' => 'session_registrations.destroy'
            ])
            ->parameters([
                'registrations' => 'user'
            ]);

        /*
        |-------------------------------------------------
        | Izin Akses "Schedule"
        |-------------------------------------------------
        | ADMIN
        | .index   -> users.name FROM INSTRUCTOR[users.first_name, users.last_name], schedule_time, status CHECK ON ALL (sessions)
        | .create  -> (+) instructor_id FROM INSTRUCTOR[users.first_name, users.last_name], schedule_time, status CHECK ON ALL (sessions)
        | .store   -> (+) id, created_at
        | .edit    -> (+) instructor_id FROM INSTRUCTOR[users.first_name, users.last_name], schedule_time, status CHECK ON ALL (sessions)
        | .update  -> (+) updated_at
        | .destroy -> (+) deleted_at
        |
        | INSTRUCTOR
        | .index   -> schedule_time, status CHECK ON ALL (sessions)
        | .store   -> (+) id, instructor_id, schedule_time, status, created_at
        | .update  -> (requested_to_ADMIN)
        |
        | STUDENT
        | .index   -> users.name FROM INSTRUCTOR[users.first_name, users.last_name], schedule_time, status CHECK ON ALL (CURRENT_STUDENT_ALREADY_REGISTERED(sessions))
        */

        // menggunakan resources: /schedules/{user}
        Route::resource('schedules', 'ScheduleController')
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
            ->parameters([
                'schedules' => 'user'
            ]);

        /*
        |-------------------------------------------------
        | Izin Akses "Rating"
        |-------------------------------------------------
        | ADMIN
        | .index   -> sessions.title, rating, comment, created_at
        | .destroy -> (+) deleted_at (INCLUSIVE WITH sessions SO CANNOT DELETE ALONE)
        |
        | INSTRUCTOR
        | .index   -> sessions.title, rating, comment, created_at
        |
        | STUDENT
        | .store   -> (+) session_id, rating, comment, created_at
        */

        // menggunakan resources: /ratings/{session}
        Route::resource('ratings', 'RatingController')
            ->only(['index', 'store', 'destroy'])
            ->parameters([
                'ratings' => 'session'
            ]);

        /*
        |-------------------------------------------------
        | Izin Akses "Instructor"
        |-------------------------------------------------
        | ADMIN
        | .index   -> image FROM users.image_profile, users.name FROM INSTRUCTOR[users.first_name, users.last_name], interest (simple), working_experience (simple), educational_experience (simple)
        | .create  -> (+) user_id FROM INSTRUCTOR[users.first_name, users.last_name], interest (full), working_experience (full), educational_experience (full)
        | .store   -> (+) id, created_at
        | .show    -> image FROM users.image_profile, users.name FROM INSTRUCTOR[users.first_name, users.last_name], interest (full), working_experience (full), educational_experience (full)
        | .edit    -> user_id FROM INSTRUCTOR[users.first_name, users.last_name], interest (full), working_experience (full), educational_experience (full)
        | .update  -> (+) updated_at
        | .destroy -> (+) deleted_at (INCLUSIVE WITH users SO CANNOT DELETE ALONE)
        |
        | INSTRUCTOR
        | .index   -> image FROM users.image_profile, interest (simple), working_experience (simple), educational_experience (simple)
        | .create  -> (+) interest (full), working_experience (full), educational_experience (full)
        | .store   -> (+) id, user_id, created_at
        | .show    -> image FROM users.image_profile, users.name FROM INSTRUCTOR[users.first_name, users.last_name], interest (full), working_experience (full), educational_experience (full)
        | .edit    -> interest (full), working_experience (full), educational_experience (full)
        | .update  -> (+) updated_at
        | .destroy -> (requested_to_ADMIN)
        |
        | STUDENT
        | .index   -> image FROM users.image_profile, users.name FROM INSTRUCTOR[users.first_name, users.last_name], interest (simple), working_experience (simple), educational_experience (simple)
        | .show    -> image FROM users.image_profile, users.name FROM INSTRUCTOR[users.first_name, users.last_name], interest (full), working_experience (full), educational_experience (full)
        */

        // menggunakan resources: /instructors/{user}
        Route::resource('instructors', 'InstructorController')
            ->parameters([
                'instructors' => 'user'
            ]);

        /*
        |-------------------------------------------------
        | Izin Akses "Student"
        |-------------------------------------------------
        | ADMIN
        | .index   -> users.name FROM STUDENT[users.first_name, users.last_name], age, status_job, interest, target_language_experience (ALSO COMPACT(target_language_experience_value)), indonesian_language_proficiency
        | .create  -> (+) user_id FROM STUDENT[users.first_name, users.last_name], age, status_job, status_description, status_value, interest, target_language_experience, target_language_experience_value, description_of_course_taken, indonesian_language_proficiency, learning_objective
        | .store   -> (+) id, created_at
        | .show    -> users.name FROM STUDENT[users.first_name, users.last_name], age, status_job, status_description, status_value, interest, target_language_experience, target_language_experience_value, description_of_course_taken, indonesian_language_proficiency, learning_objective
        | .edit    -> user_id FROM STUDENT[users.first_name, users.last_name], age, status_job, status_description, status_value, interest, target_language_experience, target_language_experience_value, description_of_course_taken, indonesian_language_proficiency, learning_objective
        | .update  -> (+) updated_at
        | .destroy -> (+) deleted_at (INCLUSIVE WITH users SO CANNOT DELETE ALONE)
        |
        | INSTRUCTOR
        | .index   -> users.name FROM STUDENT[users.first_name, users.last_name], age, status_job, interest, target_language_experience (ALSO COMPACT(target_language_experience_value)), indonesian_language_proficiency
        | .show    -> users.name FROM STUDENT[users.first_name, users.last_name], age, status_job, status_description, status_value, interest, target_language_experience, target_language_experience_value, description_of_course_taken, indonesian_language_proficiency, learning_objective
        |
        | STUDENT
        | .index   -> age, status_job, interest, target_language_experience (ALSO COMPACT(target_language_experience_value)), indonesian_language_proficiency
        | .create  -> (+) age, status_job, status_description, status_value, interest, target_language_experience, target_language_experience_value, description_of_course_taken, indonesian_language_proficiency, learning_objective
        | .store   -> (+) id, user_id, created_at
        | .show    -> users.name FROM STUDENT[users.first_name, users.last_name], age, status_job, status_description, status_value, interest, target_language_experience, target_language_experience_value, description_of_course_taken, indonesian_language_proficiency, learning_objective
        | .edit    -> age, status_job, status_description, status_value, interest, target_language_experience, target_language_experience_value, description_of_course_taken, indonesian_language_proficiency, learning_objective
        | .update  -> (+) updated_at
        | .destroy -> (+) deleted_at (INCLUSIVE WITH users SO CANNOT DELETE ALONE)
        */

        // menggunakan resources: /students/{user}
        Route::resource('students', 'StudentController')
            ->parameters([
                'students' => 'user'
            ]);

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
