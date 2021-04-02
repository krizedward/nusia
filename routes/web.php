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

// daftar route
// use case digunakan: v3.4.5
// last update Maret 2021

// daftar use case unregistered users
    // melakukan request daftar harga course untuk negara tertentu
    Route::get('/request-price', 'NonRegisteredController@request_price_index')->name('non_registered.request_price.index');
    Route::post('/request-price/store', 'NonRegisteredController@request_price_store')->name('non_registered.request_price.store');
    
    // mendaftar akun baru
    // (dihandle oleh auth routes)
    
    // melihat syarat dan ketentuan layanan
    Route::get('/terms-of-service', 'NonRegisteredController@terms_index')->name('non_registered.terms.index');
    Route::get('/privacy-policy', 'NonRegisteredController@policy_index')->name('non_registered.policy.index');
    
    // lain-lain (redirection)
    Route::redirect('/', '/login');

Route::group(['middleware'=>'auth'], function() {
    // daftar use case registered users
        // mendaftar akun baru
        // (dihandle oleh auth routes)
        
        // menampilkan dashboard
        Route::get('/dashboard', 'RegisteredController@dashboard_index')->name('registered.dashboard.index');
        Route::get('/dashboard', 'RegisteredController@dashboard_index')->name('registered.dashboard.index');
        Route::get('/coming-soon', function() {
            return view('in-development');
        })->name('registered.in-development.index');
        Route::redirect('/dashboard', '/coming-soon');
        Route::get('/db', 'RegisteredController@dashboard_index');
        
        // menampilkan NUSIA contact person
        Route::get('/contact-us', 'RegisteredController@contact_index')->name('registered.contact.index');
        
        // membuka fitur chat
        Route::get('/chat/{change_skin?}/{change_chat_color?}', 'RegisteredController@chat_index')->name('registered.chat.index');
        
        // melihat informasi profil
        Route::get('/profile', 'RegisteredController@profile_index')->name('registered.profile.index');
        
        // memodifikasi informasi profil
        Route::put('/profile/update', 'RegisteredController@profile_update')->name('registered.profile.update');
        
        // melakukan logout
        // redirection, apabila proses logout error (metode GET tidak didukung)
        Route::get('/logout', 'RegisteredController@logout_get_index')->name('registered.logout_get.index');
    
    // daftar use case non-admin users
        // menghubungi admin (via chat)
        Route::get('/non-admin/chat/admin', 'NonAdminController@chat_admin_index')->name('non_admin.chat_admin.index');
        Route::get('/non-admin/chat/admin/{user_id}', 'NonAdminController@chat_admin_show')->name('non_admin.chat_admin.show');
        Route::post('/non-admin/chat/admin/{user_id}/store', 'NonAdminController@chat_admin_store')->name('non_admin.chat_admin.store');
        Route::redirect('/non-admin', '/non-admin/chat/admin');
        Route::redirect('/non-admin/chat', '/non-admin/chat/admin');
        
    // daftar use case student
        // mendaftar course: mengisi formulir registrasi student
        Route::get('/student-registration-form', 'StudentController@student_registration_form_index')->name('student.student_registration_form.index');
        Route::put('/student-registration-form/{user_id}/update', 'StudentController@student_registration_form_update')->name('student.student_registration_form.update');
        
        // mendaftar course: memilih jenis course
        Route::get('/choose-course/{course_registration_id?}', 'StudentController@choose_course_index')->name('student.choose_course.index');
        Route::post('/choose-course/store', 'StudentController@choose_course_store')->name('student.choose_course.store');
        
        // mendaftar course: melengkapi informasi pembayaran
        Route::get('/complete-payment-information/{course_registration_id}', 'StudentController@complete_payment_information_show')->name('student.complete_payment_information.show');
        Route::put('/complete-payment-information/{course_registration_id}/update', 'StudentController@complete_payment_information_update')->name('student.complete_payment_information.update');
        
        // mendaftar course: mengirim bukti pembayaran
        Route::get('/upload-payment-evidence/{course_registration_id}', 'StudentController@upload_payment_evidence_show')->name('student.upload_payment_evidence.show');
        Route::put('/upload-payment-evidence/{course_registration_id}/update', 'StudentController@upload_payment_evidence_update')->name('student.upload_payment_evidence.update');
        
        // mendaftar course: menghubungi financial team (via chat)
        Route::get('/registration-info/chat/financial-team', 'StudentController@chat_financial_team_index')->name('student.chat_financial_team.index');
        Route::get('/registration-info/chat/financial-team/{user_id}', 'StudentController@chat_financial_team_show')->name('student.chat_financial_team.show');
        Route::post('/registration-info/chat/financial-team/{user_id}/store', 'StudentController@chat_financial_team_store')->name('student.chat_financial_team.store');
        Route::redirect('/registration-info', '/registration-info/chat/financial-team');
        Route::redirect('/registration-info/chat', '/registration-info/chat/financial-team');
        
        // mendaftar course: mengirim hasil placement test
        Route::get('/upload-placement-test/{course_registration_id}', 'StudentController@upload_placement_test_show')->name('student.upload_placement_test.show');
        Route::put('/upload-placement-test/{course_registration_id}/update', 'StudentController@upload_placement_test_update')->name('student.upload_placement_test.update');
        
        // mendaftar course: menghubungi lead instructor (via chat)
        Route::get('/placement-test/chat/reviewer-team', 'StudentController@chat_lead_instructor_index')->name('student.chat_lead_instructor.index');
        Route::get('/placement-test/chat/reviewer-team/{user_id}', 'StudentController@chat_lead_instructor_show')->name('student.chat_lead_instructor.show');
        Route::post('/placement-test/chat/reviewer-team/{user_id}/store', 'StudentController@chat_lead_instructor_store')->name('student.chat_lead_instructor.store');
        Route::redirect('/placement-test', '/placement-test/chat/reviewer-team');
        Route::redirect('/placement-test/chat', '/placement-test/chat/reviewer-team');
        
        // mendaftar course: memilih jadwal & memilih instructor
        Route::get('/choose-course-registration/{course_registration_id}', 'StudentController@choose_course_registration_show')->name('student.choose_course_registration.show');
        
        // mendaftar course: mengonfirmasi jadwal & mengonfirmasi instructor
        Route::get('/confirm-course-registration/{course_registration_id}/choose/{course_id}', 'StudentController@confirm_course_registration_show')->name('student.confirm_course_registration.show');
        Route::put('/confirm-course-registration/{course_registration_id}/choose/{course_id}/update', 'StudentController@confirm_course_registration_update')->name('student.confirm_course_registration.update');
        
        // melihat daftar course dalam proses registrasi
        Route::get('/view-course-registration', 'StudentController@view_course_registration_index')->name('student.view_course_registration.index');
        
        // melihat daftar sesi yang sedang atau akan berlangsung
        // & mengikuti kelas (via meeting link)
        // & melihat daftar course yang diikuti
        // & melihat hasil filter daftar course sesuai jenis course
        Route::get('/student/schedule', 'StudentController@schedule_index')->name('student.schedule.index');
        
        // melihat informasi detail masing-masing course
        // & melihat daftar sesi
        // & mengikuti kelas (via meeting link)
        // & melihat status kehadiran masing-masing sesi
        // & melihat daftar materi
        // & melihat daftar tugas
        // & melihat nilai tugas
        // & melihat hasil koreksi tugas
        // & melihat daftar ujian
        // & melihat nilai ujian
        // & melihat hasil koreksi ujian
        // & melihat daftar instructor course
        // & melihat daftar student dalam course
        // & melihat status penerimaan sertifikat keikutsertaan dalam course
        Route::get('/student/schedule/{course_registration_id}', 'StudentController@schedule_show')->name('student.schedule.show');
        
        // mengirim feedback per sesi
        Route::post('/student/schedule/{course_registration_id}/feedback/{session_registration_id}/store', 'StudentController@feedback_store')->name('student.feedback.store');
        
        // mengunduh materi
        Route::get('/student/schedule/{course_registration_id}/material/{material_type}/{material_id}/download', 'StudentController@material_download')->name('student.material.download');
        
        // mengunduh tugas
        Route::get('/student/schedule/{course_registration_id}/assignment/{assignment_id}/download', 'StudentController@assignment_download')->name('student.assignment.download');
        
        // mengumpulkan tugas
        Route::post('/student/schedule/{course_registration_id}/assignment-submission/store', 'StudentController@assignment_submission_store')->name('student.assignment_submission.store');
        
        // mengunduh pengumpulan tugas
        Route::get('/student/schedule/{course_registration_id}/assignment-submission/{submission_id}/download', 'StudentController@assignment_submission_download')->name('student.assignment_submission.download');
        
        // mengunduh ujian
        Route::get('/student/schedule/{course_registration_id}/exam/{exam_id}/download', 'StudentController@exam_download')->name('student.exam.download');
        
        // mengumpulkan ujian
        Route::post('/student/schedule/{course_registration_id}/exam-submission/store', 'StudentController@exam_submission_store')->name('student.exam_submission.store');
        
        // mengunduh pengumpulan ujian
        Route::get('/student/schedule/{course_registration_id}/exam-submission/{submission_id}/download', 'StudentController@exam_submission_download')->name('student.exam_submission.download');
        
        // mengunduh sertifikat
        Route::get('/student/schedule/{course_registration_id}/certificate/download', 'StudentController@certificate_download')->name('student.certificate.download');
        
        // menghubungi instructor course (via chat)
        Route::get('/student/study/chat/instructor', 'StudentController@chat_instructor_index')->name('student.chat_instructor.index');
        Route::get('/student/study/chat/instructor/{user_id}', 'StudentController@chat_instructor_show')->name('student.chat_instructor.show');
        Route::post('/student/study/chat/instructor/{user_id}/store', 'StudentController@chat_instructor_store')->name('student.chat_instructor.store');
        Route::redirect('/student/study', '/student/study/chat/instructor');
        Route::redirect('/student/study/chat', '/student/study/chat/instructor');
        
        // menghubungi student course (via chat)
        Route::get('/student/discuss/chat/friend', 'StudentController@chat_student_index')->name('student.chat_student.index');
        Route::get('/student/discuss/chat/friend/{course_id}', 'StudentController@chat_student_show')->name('student.chat_student.show');
        Route::post('/student/discuss/chat/friend/{course_id}/store', 'StudentController@chat_student_store')->name('student.chat_student.store');
        Route::redirect('/student/discuss', '/student/discuss/chat/friend');
        Route::redirect('/student/discuss/chat', '/student/discuss/chat/friend');
        
        // menghubungi cs (via chat)
        Route::get('/student-course-info/chat/customer-service', 'StudentController@chat_customer_service_index')->name('student.chat_customer_service.index');
        Route::get('/student-course-info/chat/customer-service/{user_id}', 'StudentController@chat_customer_service_show')->name('student.chat_customer_service.show');
        Route::post('/student-course-info/chat/customer-service/{user_id}/store', 'StudentController@chat_customer_service_store')->name('student.chat_customer_service.store');
        Route::redirect('/student-course-info', '/student-course-info/chat/customer-service');
        Route::redirect('/student-course-info/chat', '/student-course-info/chat/customer-service');
        
        // lain-lain (redirection)
        Route::redirect('/student', '/dashboard');
        
    // daftar use case instructor
        // melihat jadwal mengajar yang diintegrasikan dengan sesi, yang sedang atau akan berlangsung
        // & melaksanakan kelas (via meeting link)
        // & melihat ketersediaan jadwal mengajar yang pernah dibuat, secara menyeluruh
        // & melihat daftar course yang diajar
        // & melihat hasil filter daftar course sesuai jenis course
        Route::get('/instructor/schedule', 'InstructorController@schedule_index')->name('instructor.schedule.index');
        
        // menambah ketersediaan jadwal mengajar
        Route::post('/instructor/schedule/store', 'InstructorController@schedule_store')->name('instructor.schedule.store');
        
        // memodifikasi ketersediaan jadwal mengajar
        Route::put('/instructor/schedule/{schedule_id}/update', 'InstructorController@schedule_update')->name('instructor.schedule.update');
        
        // mengintegrasikan ketersediaan jadwal mengajar dengan sesi tertentu
        Route::put('/instructor/schedule/{schedule_id}/integrate-with-session/update', 'InstructorController@schedule_integrate_update')->name('instructor.schedule_integrate.update');
        
        // menghapus ketersediaan jadwal mengajar
        Route::delete('/instructor/schedule/{schedule_id}/destroy', 'InstructorController@schedule_destroy')->name('instructor.schedule.destroy');
        
        // melihat informasi detail masing-masing course
        // & melihat daftar sesi
        // & melaksanakan kelas (via meeting link)
        // & melihat daftar materi
        // & melihat daftar tugas diberikan
        // & melihat daftar pengumpulan tugas
        // & melihat daftar ujian diberikan
        // & melihat daftar pengumpulan ujian
        // & melihat daftar instructor course
        // & melihat daftar student dalam course
        Route::get('/instructor/course/{course_id}', 'InstructorController@course_show')->name('instructor.course.show');
        
        // membuat sesi baru
        // & mengintegrasikan ketersediaan jadwal mengajar dengan sesi tertentu
        // & menambah ketersediaan jadwal mengajar
        Route::post('/instructor/course/{course_id}/session/store', 'InstructorController@session_store')->name('instructor.session.store');
        
        // memodifikasi informasi umum mengenai sesi
        // & memodifikasi ketersediaan jadwal mengajar
        Route::put('/instructor/course/session/update', 'InstructorController@session_update')->name('instructor.session.update');
        
        // menghapus informasi sesi
        // & menghapus ketersediaan jadwal mengajar
        Route::delete('/instructor/course/{course_id}/session/{session_id}/destroy', 'InstructorController@session_destroy')->name('instructor.session.destroy');
        
        // melihat status kehadiran student dalam setiap sesi
        Route::get('/instructor/course/{course_id}/session/{session_id}/attendance', 'InstructorController@student_attendance_index')->name('instructor.student_attendance.index');
        
        // mengubah status kehadiran student dalam satu sesi
        Route::put('/instructor/course/{course_id}/session/{session_id}/attendance/update', 'InstructorController@student_attendance_update')->name('instructor.student_attendance.update');
        
        // melihat feedback per sesi
        Route::get('/instructor/course/{course_id}/session/{session_id}/feedback', 'InstructorController@session_feedback_index')->name('instructor.session_feedback.index');
        
        // mengunggah materi
        Route::post('/instructor/course/{course_id}/material/store', 'InstructorController@material_store')->name('instructor.material.store');
        
        // mengunduh materi
        Route::get('/instructor/course/material/{material_type}/{material_id}/download', 'InstructorController@material_download')->name('instructor.material.download');
        
        // memodifikasi informasi materi
        Route::put('/instructor/course/{course_id}/material/{material_type}/{material_id}/update', 'InstructorController@material_update')->name('instructor.material.update');
        
        // menghapus informasi materi
        Route::delete('/instructor/course/{course_id}/material/{material_type}/{material_id}/destroy', 'InstructorController@material_destroy')->name('instructor.material.destroy');
        
        // mengunggah tugas
        Route::post('/instructor/course/{course_id}/assignment/store', 'InstructorController@assignment_store')->name('instructor.assignment.store');
        
        // mengunduh tugas
        Route::get('/instructor/course/{course_id}/assignment/{assignment_id}/download', 'InstructorController@assignment_download')->name('instructor.assignment.download');
        
        // memodifikasi informasi tugas
        Route::put('/instructor/course/{course_id}/assignment/{assignment_id}/update', 'InstructorController@assignment_update')->name('instructor.assignment.update');
        
        // menghapus informasi tugas
        Route::delete('/instructor/course/{course_id}/assignment/{assignment_id}/destroy', 'InstructorController@assignment_destroy')->name('instructor.assignment.destroy');
        
        // mengunduh pengumpulan tugas
        Route::get('/instructor/course/{course_id}/assignment-submission/{submission_id}/download', 'InstructorController@assignment_submission_download')->name('instructor.assignment_submission.download');
        
        // mengoreksi pengumpulan tugas
        Route::put('/instructor/course/{course_id}/assignment-submission/{submission_id}/update', 'InstructorController@assignment_submission_update')->name('instructor.assignment_submission.update');
        
        // mengunggah ujian
        Route::post('/instructor/course/{course_id}/exam/store', 'InstructorController@exam_store')->name('instructor.exam.store');
        
        // mengunduh ujian
        Route::get('/instructor/course/{course_id}/exam/{exam_id}/download', 'InstructorController@exam_download')->name('instructor.exam.download');
        
        // memodifikasi informasi ujian
        Route::put('/instructor/course/{course_id}/exam/{exam_id}/update', 'InstructorController@exam_update')->name('instructor.exam.update');
        
        // menghapus informasi ujian
        Route::delete('/instructor/course/{course_id}/exam/{exam_id}/destroy', 'InstructorController@exam_destroy')->name('instructor.exam.destroy');
        
        // mengunduh pengumpulan ujian
        Route::get('/instructor/course/{course_id}/exam-submission/{submission_id}/download', 'InstructorController@exam_submission_download')->name('instructor.exam_submission.download');
        
        // mengoreksi pengumpulan ujian
        Route::put('/instructor/course/{course_id}/exam-submission/{submission_id}/update', 'InstructorController@exam_submission_update')->name('instructor.exam_submission.update');
        
        // melihat informasi profil instructor lain
        Route::get('/instructor/show-instructor-profile/{user_id}', 'InstructorController@instructor_profile_show')->name('instructor.instructor_profile.show');
        
        // menghubungi instructor lain (via chat)
        Route::get('/instructor/take-part/chat/other-instructor', 'InstructorController@chat_instructor_index')->name('instructor.chat_instructor.index');
        Route::get('/instructor/take-part/chat/other-instructor/{user_id}', 'InstructorController@chat_instructor_show')->name('instructor.chat_instructor.show');
        Route::post('/instructor/take-part/chat/other-instructor/{user_id}/store', 'InstructorController@chat_instructor_store')->name('instructor.chat_instructor.store');
        Route::redirect('/instructor/take-part', '/instructor/take-part/chat/other-instructor');
        Route::redirect('/instructor/take-part/chat', '/instructor/take-part/chat/other-instructor');
        
        // melihat informasi profil student
        Route::get('/instructor/show-student-profile/{user_id}', 'InstructorController@student_profile_show')->name('instructor.student_profile.show');
        
        // menghubungi student (via chat)
        Route::get('/instructor/mentoring/chat/student', 'InstructorController@chat_student_index')->name('instructor.chat_student.index');
        Route::get('/instructor/mentoring/chat/student/{user_id}', 'InstructorController@chat_student_show')->name('instructor.chat_student.show');
        Route::post('/instructor/mentoring/chat/student/{user_id}/store', 'InstructorController@chat_student_store')->name('instructor.chat_student.store');
        Route::redirect('/instructor/mentoring', '/instructor/mentoring/chat/student');
        Route::redirect('/instructor/mentoring/chat', '/instructor/mentoring/chat/student');
        
        // lain-lain (redirection)
        Route::redirect('/instructor', '/dashboard');
        
    // daftar use case tambahan (untuk lead instructor)
        // melihat informasi registrasi student
        // & melihat daftar jadwal meeting alternatif placement test
        Route::get('/reviewer/student-registration', 'LeadInstructorController@student_registration_index')->name('lead_instructor.student_registration.index');
        
        // melihat informasi profil student
        Route::get('/reviewer/student-registration/{course_registration_id}', 'LeadInstructorController@student_registration_show')->name('lead_instructor.student_registration.show');
        
        // menghubungi student (via chat)
        Route::get('/reviewer/placement-test/chat/student', 'LeadInstructorController@chat_student_index')->name('lead_instructor.chat_student.index');
        Route::get('/reviewer/placement-test/chat/student/{user_id}', 'LeadInstructorController@chat_student_show')->name('lead_instructor.chat_student.show');
        Route::post('/reviewer/placement-test/chat/student/{user_id}/store', 'LeadInstructorController@chat_student_store')->name('lead_instructor.chat_student.store');
        Route::redirect('/reviewer/placement-test', '/reviewer/placement-test/chat/student');
        Route::redirect('/reviewer/placement-test/chat', '/reviewer/placement-test/chat/student');
        
        // mengonfirmasi hasil placement test
        Route::put('/reviewer/student-registration/{course_registration_id}/placement-test/by-video/update', 'LeadInstructorController@confirmation_by_video_update')->name('lead_instructor.confirmation_by_video.update');
        
        // menambahkan jadwal meeting alternatif
        Route::post('/reviewer/student-registration/placement-test/by-meeting/store', 'LeadInstructorController@placement_test_by_meeting_store')->name('lead_instructor.placement_test_by_meeting.store');
        
        // memodifikasi informasi jadwal meeting alternatif
        Route::put('/reviewer/student-registration/placement-test/by-meeting/{session_id}/update', 'LeadInstructorController@placement_test_by_meeting_update')->name('lead_instructor.placement_test_by_meeting.update');
        
        // menghapus informasi jadwal meeting alternatif
        Route::delete('/reviewer/student-registration/placement-test/by-meeting/{session_id}/destroy', 'LeadInstructorController@placement_test_by_meeting_destroy')->name('lead_instructor.placement_test_by_meeting.destroy');
        
        // melihat daftar student peserta meeting alternatif
        Route::get('/reviewer/student-registration/placement-test/by-meeting/{session_id}', 'LeadInstructorController@placement_test_by_meeting_index')->name('lead_instructor.placement_test_by_meeting.index');
        
        // melihat informasi profil student
        Route::get('/reviewer/student-registration/placement-test/by-meeting/{session_id}/participant/{course_registration_id}', 'LeadInstructorController@placement_test_by_meeting_student_profile_show')->name('lead_instructor.placement_test_by_meeting_student_profile.show');
        
        // menghubungi student (via chat)
        Route::get('/reviewer/placement-test-by-meeting/chat/student', 'LeadInstructorController@chat_student_alternative_meeting_index')->name('lead_instructor.chat_student_alternative_meeting.index');
        Route::get('/reviewer/placement-test-by-meeting/chat/student/{user_id}', 'LeadInstructorController@chat_student_alternative_meeting_show')->name('lead_instructor.chat_student_alternative_meeting.show');
        Route::post('/reviewer/placement-test-by-meeting/chat/student/{user_id}/store', 'LeadInstructorController@chat_student_alternative_meeting_store')->name('lead_instructor.chat_student_alternative_meeting.store');
        Route::redirect('/reviewer/placement-test-by-meeting', '/reviewer/placement-test-by-meeting/chat/student');
        Route::redirect('/reviewer/placement-test-by-meeting/chat', '/reviewer/placement-test-by-meeting/chat/student');
        
        // mengonfirmasi hasil placement test (menurut hasil meeting)
        Route::put('/reviewer/student-registration/{course_registration_id}/placement-test/by-meeting/update', 'LeadInstructorController@confirmation_by_meeting_update')->name('lead_instructor.confirmation_by_meeting.update');
        
        // lain-lain (redirection)
        Route::redirect('/reviewer', '/dashboard');
        
    // daftar use case customer service
        // melihat daftar student
        Route::get('/customer-service/student', 'CustomerServiceController@student_index')->name('customer_service.student.index');
        
        // melihat informasi profil student
        Route::get('/customer-service/student/{user_id}', 'CustomerServiceController@student_show')->name('customer_service.student.show');
        
        // menghubungi student (via chat)
        Route::get('/customer-service/chat/student', 'CustomerServiceController@chat_student_index')->name('customer_service.chat_student.index');
        Route::get('/customer-service/chat/student/{user_id}', 'CustomerServiceController@chat_student_show')->name('customer_service.chat_student.show');
        Route::post('/customer-service/chat/student/{user_id}/store', 'CustomerServiceController@chat_student_store')->name('customer_service.chat_student.store');
        
        // melihat informasi daftar course yang diikuti oleh student
        Route::get('/customer-service/student/{user_id}/course-registration', 'CustomerServiceController@student_course_registration_index')->name('customer_service.student_course_registration.index');
        
        // melihat informasi detail masing-masing course
        // & melihat daftar sesi
        // & melihat feedback per sesi yang diberikan oleh student
        // & melihat status kehadiran student dalam setiap sesi
        // & melihat daftar materi
        // & melihat daftar tugas diberikan
        // & melihat daftar pengumpulan tugas
        // & melihat daftar ujian diberikan
        // & melihat daftar pengumpulan ujian
        // & melihat daftar instructor course
        // & melihat informasi profil instructor
        // & melihat daftar student dalam course
        // & melihat status penerimaan sertifikat keikutsertaan dalam course
        Route::get('/customer-service/course-registration/{course_registration_id}', 'CustomerServiceController@student_course_registration_show')->name('customer_service.student_course_registration.show');
        
        // mengunduh sertifikat
        Route::get('/customer-service/course-registration/{course_registration_id}/course-certificate/download', 'CustomerServiceController@course_certificate_download')->name('customer_service.course_certificate.download');
        
        // mengunggah sertifikat
        Route::put('/customer-service/course-registration/{course_registration_id}/course-certificate/update', 'CustomerServiceController@course_certificate_update')->name('customer_service.course_certificate.update');
        
        // lain-lain (redirection)
        Route::redirect('/customer-service', '/dashboard');
    // daftar use case financial team
        // melihat daftar pembayaran student
        Route::get('/finance/student-payment', 'FinancialTeamController@student_payment_index')->name('financial_team.student_payment.index');
        
        // melihat detail informasi pembayaran student
        Route::get('/finance/student-payment/{course_payment_id}', 'FinancialTeamController@student_payment_show')->name('financial_team.student_payment.show');
        
        // mengunduh bukti pembayaran
        Route::get('/finance/student-payment/{course_payment_id}/download', 'FinancialTeamController@student_payment_download')->name('financial_team.student_payment.download');
        
        // mengonfirmasi bukti pembayaran
        Route::put('/finance/student-payment/{course_payment_id}/update', 'FinancialTeamController@student_payment_update')->name('financial_team.student_payment.update');
        
        // menghubungi student (via chat)
        Route::get('/finance/chat/student', 'FinancialTeamController@chat_student_index')->name('financial_team.chat_student.index');
        Route::get('/finance/chat/student/{user_id}', 'FinancialTeamController@chat_student_show')->name('financial_team.chat_student.show');
        Route::post('/finance/chat/student/{user_id}/store', 'FinancialTeamController@chat_student_store')->name('financial_team.chat_student.store');
        Route::redirect('/finance', '/finance/chat/student');
        Route::redirect('/finance/chat', '/finance/chat/student');
        
        // lain-lain (redirection)
        Route::redirect('/finance', '/dashboard');

    // daftar use case admin
        
        // lain-lain (redirection)
        Route::redirect('/admin', '/dashboard');
});

Auth::routes();

//verifikasi email user
Auth::routes(['verify' => true]);