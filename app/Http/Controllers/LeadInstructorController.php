<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Str;

use App\User;
use App\Models\Course;
use App\Models\CourseCertificate;
use App\Models\CourseLevel;
use App\Models\CoursePackage;
use App\Models\CoursePackageDiscount;
use App\Models\CoursePayment;
use App\Models\CourseRegistration;
use App\Models\CourseType;
use App\Models\CourseTypeValue;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\FormQuestionChoice;
use App\Models\FormResponse;
use App\Models\FormResponseDetail;
use App\Models\Instructor;
use App\Models\InstructorSchedule;
use App\Models\MaterialPublic;
use App\Models\MaterialSession;
use App\Models\MaterialType;
use App\Models\MaterialTypeValue;
use App\Models\Message;
use App\Models\Metadata;
use App\Models\Notification;
use App\Models\NotificationDuration;
use App\Models\NotificationLabel;
use App\Models\OtherUser;
use App\Models\PlacementTest;
use App\Models\Rating;
use App\Models\Schedule;
use App\Models\Session;
use App\Models\SessionRegistration;
use App\Models\SessionRegistrationForm;
use App\Models\Student;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\UserNotification;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LeadInstructorController extends Controller
{
    /**
     * Memeriksa role User saat ini.
     * Return user.roles atau null.
     */
    public function user_roles() {
        return (Auth::check())? Auth::user()->roles : null;
    }

    /**
     * Memeriksa jenis role User saat ini.
     * 1: True (jenis role sesuai)
     * 0: False (jenis role tidak sesuai)
     */
    public function is_admin() {
        return ($this->user_roles() == "Admin")? 1 : 0;
    }
    public function is_financial_team() {
        return ($this->user_roles() == "Financial Team")? 1 : 0;
    }
    public function is_customer_service() {
        return ($this->user_roles() == "Customer Service")? 1 : 0;
    }
    public function is_lead_instructor() {
        return ($this->user_roles() == "Lead Instructor")? 1 : 0;
    }
    public function is_instructor() {
        return ($this->user_roles() == "Instructor"
            || $this->user_roles() == "Lead Instructor")? 1 : 0;
    }
    public function is_student() {
        return ($this->user_roles() == "Student")? 1 : 0;
    }

    public function student_registration_index() {
        // melihat informasi registrasi student
        // & melihat daftar jadwal meeting alternatif placement test
        
        // Jika fungsi ini tidak diakses oleh lead instructor.
        if(!$this->is_lead_instructor()) return redirect()->back();
        
        $material_types = MaterialType::where('name', 'NOT LIKE', '%Trial%')->get();
        $placement_tests = PlacementTest
            ::join('course_registrations', 'placement_tests.course_registration_id', 'course_registrations.id')
            ->join('courses', 'course_registrations.course_id', 'courses.id')
            ->where('courses.title', 'LIKE', '%Not Assigned%')
            ->where('placement_tests.status', 'Not Passed')
            ->where('placement_tests.path', '<>', null)
            ->where('courses.requirement', null)
            ->select('placement_tests.*')
            ->distinct()
            ->get();
        $interviews = PlacementTest
            ::join('course_registrations', 'placement_tests.course_registration_id', 'course_registrations.id')
            ->join('courses', 'course_registrations.course_id', 'courses.id')
            ->where('courses.title', 'LIKE', '%Not Assigned%')
            ->where('placement_tests.status', 'Not Passed')
            ->where('placement_tests.path', '<>', null)
            ->where('courses.requirement', '<>', null)
            ->select('placement_tests.*')
            ->distinct()
            ->get();
        
        return view('role_lead_instructor.placement_tests_index', compact(
            'material_types', 'placement_tests', 'interviews'
        ));
    }

    public function student_registration_history_index() {
        // melihat informasi registrasi student
        // & melihat daftar jadwal meeting alternatif placement test
        
        // Jika fungsi ini tidak diakses oleh lead instructor.
        if(!$this->is_lead_instructor()) return redirect()->back();
        
        $material_types = MaterialType::where('name', 'NOT LIKE', '%Trial%')->get();
        $placement_tests = PlacementTest
            ::join('course_registrations', 'placement_tests.course_registration_id', 'course_registrations.id')
            ->join('courses', 'course_registrations.course_id', 'courses.id')
            ->where('placement_tests.path', '<>', null)
            //->where('courses.requirement', null)
            ->select('placement_tests.*')
            ->distinct()
            ->get();
        $interviews = PlacementTest
            ::join('course_registrations', 'placement_tests.course_registration_id', 'course_registrations.id')
            ->join('courses', 'course_registrations.course_id', 'courses.id')
            ->where('placement_tests.path', '<>', null)
            //->where('courses.requirement', '<>', null)
            ->select('placement_tests.*')
            ->distinct()
            ->get();
        
        return view('role_lead_instructor.placement_tests_index', compact(
            'material_types', 'placement_tests', 'interviews'
        ));
    }

    public function student_registration_show($course_registration_id) {
        // melihat informasi profil student
        
        // Jika fungsi ini tidak diakses oleh lead instructor.
        if(!$this->is_lead_instructor()) return redirect()->back();
        
        $course_registration = CourseRegistration::where('id', $course_registration_id)->get()->first();
        
        // Periksa apakah akses untuk mengganti placement test ini diperbolehkan.
        //if($course_registration->placement_test->status == 'Passed') {
            // tidak bisa mengedit karena status sesi sudah "Passed"
        //    session(['caption-danger' => 'This placement test information has been previously updated. No changes can be made.']);
        //    return redirect()->route('lead_instructor.student_registration.index');
        //} //else if($course_registration->placement_test->result_updated_at != null) {
          //  // untuk sesi yang sudah diperiksa oleh Lead Instructor, tetapi memasuki tahap interview
          //  $schedule_now = Carbon::now()->setTimezone(Auth::user()->timezone);
          //  $schedule_time_begin_min_30_mins = Carbon::parse($course_registration->placement_test->result_updated_at)->setTimezone(Auth::user()->timezone)->sub(30, 'minutes');
          //  $schedule_time_end_add_7_days = Carbon::parse($course_registration->placement_test->result_updated_at)->setTimezone(Auth::user()->timezone)->add(100, 'minutes')->add(7, 'days');
          //  if($schedule_now < $schedule_time_begin_min_30_mins || $schedule_now > $schedule_time_end_add_7_days) {
          //      // melihat informasi student hanya dapat dilakukan
          //      // sejak 30 menit sebelum sesi interview dimulai
          //      // hingga 7 hari setelah sesi interview berakhir
          //      // (estimasi durasi interview: 100 menit)
          //      session(['caption-danger' => 'This placement test information can be displayed 30 minutes before the interview begins until 7 days after the interview ends (estimated interview duration: 100 minutes).']);
          //      return redirect()->route('lead_instructor.student_registration.index');
          //  }
        // }
        
        $course_levels = CoursePackage
            ::join('course_levels', 'course_packages.course_level_id', 'course_levels.id')
            ->where('course_packages.material_type_id', $course_registration->course->course_package->material_type_id)
            ->where('course_levels.name', 'NOT LIKE', '%Trial%')
            ->where('course_levels.name', 'NOT LIKE', '%Not Assigned%')
            ->distinct()->select('course_levels.id', 'course_levels.code', 'course_levels.name', 'course_levels.assignment_score_min', 'course_levels.exam_score_min', 'course_levels.created_at', 'course_levels.updated_at', 'course_levels.deleted_at')
            ->get();
        
        return view('role_lead_instructor.placement_tests_show', compact(
            'course_registration', 'course_levels',
        ));
    }

    public function chat_student_index() {
        // menghubungi student (via chat)
    }

    public function chat_student_show($user_id) {
        // menghubungi student (via chat)
        //$users = User::whereIn('id', app(Controller::class)->get_relevant_user_ids_for_chat())->get();
        $users = User::all();
        $messages = Message
            ::where(function($q) {
                $q
                    ->whereIn('user_id_sender', app(Controller::class)->get_relevant_user_ids_for_chat())
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) {
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->whereIn('user_id_recipient', app(Controller::class)->get_relevant_user_ids_for_chat());
            })
            ->orderBy('created_at', 'DESC')
            ->get();
        
        $partner = User::findOrFail($user_id);
        $partner_messages = Message
            ::where(function($q) use($user_id){
                $q
                    ->where('user_id_sender', $user_id)
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) use($user_id){
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->where('user_id_recipient', $user_id);
            })
            ->select('user_id_sender', 'user_id_recipient', 'message', 'created_at')
            ->orderBy('created_at')
            ->get();
        return view('role_lead_instructor.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_student_store(Request $request, $user_id) {
        // menghubungi student (via chat)
        $data = Validator::make($request->all(), [
            'messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id => ['bail', 'required',],
        ]);
        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        Message::create([
            'user_id_sender' => Auth::user()->id,
            'user_id_recipient' => $user_id,
            'subject' => 'Unknown Subject',
            'message' => $request['messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id],
            'created_at' => now(),
        ]);
        return redirect()->back();
    }

    public function confirmation_by_video_update(Request $request, $course_registration_id) {
        // mengonfirmasi hasil placement test
        
        // Jika fungsi ini tidak diakses oleh lead instructor.
        if(!$this->is_lead_instructor()) return redirect()->back();
        
        $data = $request->all();
        
        // Apabila input form diubah menggunakan fitur "Inspect Elements" pada browser,
        // lakukan validasi input dengan data sebelumnya yang diakses.
        if($request->crid != session('crid') || $course_registration_id != session('crid') || $request->crid != $course_registration_id) {
            // Data ini tidak diluluskan dalam proses validasi.
            $data['crid'] = null;
        }
        
        $data = Validator::make($data, [
            'status' => ['bail', 'required',],
            'indonesian_language_proficiency' => ['bail', 'required_if:status,"Passed"',],
            'schedule_time_date' => ['bail', 'required_if:status,"Not Passed"',],
            'schedule_time_time' => ['bail', 'required_if:status,"Not Passed"',],
            'meeting_link' => ['bail', 'required_if:status,"Not Passed"',],
            'crid' => ['bail', 'required'],
        ]);
        if($data->fails()) {
            session(['caption-danger' => 'This placement test information has not been updated. Try again.']);
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        
        $course_registration = CourseRegistration::where('id', $course_registration_id)->get()->first();
        
        // Jika hasil placement test tidak diterima ('Not Passed').
        if($request->status == 'Not Passed') {
            $schedule_time = Carbon::createFromFormat('m/d/Y H:i A', $request->schedule_time_date . ' ' . $request->schedule_time_time)->toDateTimeString();
            if($schedule_time < now()) {
                session(['caption-danger' => 'Cannot schedule the interview as the inputted time has passed the current time.']);
                return redirect()->back()->withInput();
            }
            $course_registration->placement_test->update([
                'result_updated_at' => $schedule_time,
                'updated_at' => now(),
            ]);
            $course_registration->course->update([
                'requirement' => $request->meeting_link,
                'updated_at' => now(),
            ]);
            session(['caption-success' => 'This placement test information has been updated. Thank you!']);
            return redirect()->route('lead_instructor.student_registration.index');
        }
        
        // Jika hasil placement test diterima ('Passed').
        
        // Periksa apakah Student sudah mendaftar pada early classes dengan material sama.
        /*$early_classes_registration = CourseRegistration
            ::join('courses', 'course_registrations.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->where('course_registrations.student_id', $course_registration->student_id)
            ->where('course_packages.title', 'LIKE', '%Early Registration%')
            ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
            ->get();*/
        
        // Simpan keterangan apakah Student sudah mendaftar pada early classes dengan material sama.
        //$have_early_classes_for_same_material_type = 0;
        
        // Untuk semua early classes.
        //foreach($early_classes_registration as $ecr) {
            // Apabila sudah ada pendaftaran pada material type yang sama.
        //    if($ecr->course->course_package->material_type_id == $course_registration->course->course_package->material_type_id) {
                // Maka, tidak diperbolehkan mendaftar pada early class di material type yang sama.
        //        $have_early_classes_for_same_material_type = 1;
                
                // Jika terdaftar pada early class dengan material sama,
                // maka Student perlu bergabung dalam course berbayar.
                // Setelah mengetahui hal ini, tidak diperlukan iterasi kembali.
        //        break;
        //    }
        //}
        
        // Kode tambahan untuk memperoleh course_type
        // (misal "Not Assigned - PRIVATE" menjadi "Private")
        $course_type = ucwords(strtolower($course_registration->course->course_package->course_type->name));
        $first_hyphen_pos = strpos($course_type, '-');
        $substring_loc = strlen($course_type) - $first_hyphen_pos - 2; // -2 sebagai bonus indeks hyphen itu sendiri dan satu spasi.
        $course_type = substr($course_type, 0 - $substring_loc);
        
        //if($have_early_classes_for_same_material_type) {
            // Student sudah pernah terdaftar (sebelumnya) dalam early class, pada material yang sama.
        //    if($course_registration->course->course_package->material_type->name == 'Indonesian Culture') {
        //        $course_package = CoursePackage
        //            ::join('course_types', 'course_packages.course_type_id', 'course_types.id')
        //            ->where('course_packages.title', 'NOT LIKE', '%Free%')
        //            ->where('course_packages.title', 'NOT LIKE', '%Test%')
        //            ->where('course_packages.title', 'NOT LIKE', '%Trial%')
        //            ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
        //            ->where('course_packages.title', 'NOT LIKE', '%Early Registration%')
        //            ->where('course_types.name', 'LIKE', '%'.$course_type.'%')
        //            ->where('course_packages.course_level_id', $request->indonesian_language_proficiency)
         //           ->select('course_packages.id', 'course_packages.code', 'course_packages.material_type_id', 'course_packages.course_type_id', 'course_packages.course_level_id', 'course_packages.title', 'course_packages.description', 'course_packages.count_session', 'course_packages.price', 'course_packages.refund_description', 'course_packages.created_at', 'course_packages.updated_at', 'course_packages.deleted_at')
        //            ->get()->first();
        //    } else {
        //        $course_package = CoursePackage
        //            ::where('title', 'NOT LIKE', '%Free%')
        //            ->where('title', 'NOT LIKE', '%Test%')
        //            ->where('title', 'NOT LIKE', '%Trial%')
        //            ->where('title', 'NOT LIKE', '%Not Assigned%')
        //            ->where('title', 'NOT LIKE', '%Early Registration%')
        //           ->where('title', 'LIKE', '%'.$course_registration->course->course_package->material_type->name.'%')
        //            ->where('title', 'LIKE', '%'.$course_type.'%')
        //            ->where('course_level_id', $request->indonesian_language_proficiency)
        //            ->first();
        //    }
        //} else {
            // Student tidak pernah terdaftar (sebelumnya) dalam early class (pada material yang sama).
            if($course_registration->course->course_package->material_type->name == 'Indonesian Culture') {
                $course_package = CoursePackage
                    ::join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    ->where('course_packages.title', 'NOT LIKE', '%Free%')
                    ->where('course_packages.title', 'NOT LIKE', '%Test%')
                    ->where('course_packages.title', 'NOT LIKE', '%Trial%')
                    ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
                    ->where('course_packages.title', 'NOT LIKE', '%Early Registration%')
                    ->where('course_types.name', 'LIKE', '%'.$course_type.'%')
                    ->where('course_packages.course_level_id', $request->indonesian_language_proficiency)
                    ->select('course_packages.id', 'course_packages.code', 'course_packages.material_type_id', 'course_packages.course_type_id', 'course_packages.course_level_id', 'course_packages.title', 'course_packages.description', 'course_packages.count_session', 'course_packages.price', 'course_packages.refund_description', 'course_packages.created_at', 'course_packages.updated_at', 'course_packages.deleted_at')
                    ->get()->first();
            } else {
                $course_package = CoursePackage
                    ::where('title', 'NOT LIKE', '%Free%')
                    ->where('title', 'NOT LIKE', '%Test%')
                    ->where('title', 'NOT LIKE', '%Trial%')
                    ->where('title', 'NOT LIKE', '%Not Assigned%')
                    /*->where('title', 'LIKE', 'Early Registration%')*/
                    ->where('title', 'LIKE', '%'.$course_registration->course->course_package->material_type->name.'%')
                    ->where('title', 'LIKE', '%'.$course_type.'%')
                    ->where('course_level_id', $request->indonesian_language_proficiency)
                    ->first();
            }
        //}
        
        // Sesuaikan informasi course dengan proficiency level yang ditentukan.
        $course_registration->course->update([
            'course_package_id' => $course_package->id,
            'title' => $course_package->material_type->name . ' - ' . $course_package->course_type->name . ' - ' . $course_package->course_level->name,
            'updated_at' => now(),
        ]);
        
        // Sesuaikan informasi placement test (khususnya, ubah status menjadi "Passed",
        // sehingga Student dapat melanjutkan pendaftaran course.
        $course_registration->placement_test->update([
            'status' => 'Passed',
            'result_updated_at' => now(),
            'updated_at' => now(),
        ]);
        session(['caption-success' => 'This placement test information has been updated. Thank you!']);
        return redirect()->route('lead_instructor.student_registration.index');
    }

    public function placement_test_by_meeting_store(Request $request) {
        // menambahkan jadwal meeting alternatif
    }

    public function placement_test_by_meeting_update(Request $request) {
        // memodifikasi informasi jadwal meeting alternatif
        
        // Jika fungsi ini tidak diakses oleh lead instructor.
        if(!$this->is_lead_instructor()) return redirect()->back();
        
        if($request->type == '1') {
            $data = Validator::make($request->all(), [
                'placement_test_id' => ['bail', 'required',],
                'link_zoom' => ['bail', 'required',],
            ]);
            if($data->fails()) {
                session(['caption-danger' => 'This interview information has not been updated. Try again.']);
                return redirect()->back()
                    ->withErrors($data)
                    ->withInput();
            }
            
            PlacementTest::findOrFail($request->placement_test_id)->course_registration->course->update([
                'requirement' => $request->link_zoom,
            ]);
        } else if($request->type == '2') {
            $data = Validator::make($request->all(), [
                'placement_test_id_2' => ['bail', 'required',],
                'schedule_time_date' => ['bail', 'required',],
                'schedule_time_time' => ['bail', 'required',],
            ]);
            if($data->fails()) {
                session(['caption-danger' => 'This interview information has not been updated. Try again.']);
                return redirect()->back()
                    ->withErrors($data)
                    ->withInput();
            }
            
            $schedule_time = Carbon::createFromFormat('m/d/Y H:i A', $request->schedule_time_date . ' ' . $request->schedule_time_time)->toDateTimeString();
            if($schedule_time < now()) {
                session(['caption-danger' => 'Cannot schedule the interview as the inputted time has passed the current time.']);
                return redirect()->back()->withInput();
            }
            PlacementTest::findOrFail($request->placement_test_id_2)->update([
                'result_updated_at' => $schedule_time,
            ]);
        }
        session(['caption-success' => 'The interview information has been updated. Thank you!']);
        return redirect()->back();
    }

    public function placement_test_by_meeting_destroy($session_id) {
        // menghapus informasi jadwal meeting alternatif
    }

    public function placement_test_by_meeting_index($session_id) {
        // melihat daftar student peserta meeting alternatif
    }

    public function placement_test_by_meeting_student_profile_show($session_id, $course_registration_id) {
        // melihat informasi profil student
    }

    public function chat_student_alternative_meeting_index() {
        // menghubungi student (via chat)
    }

    public function chat_student_alternative_meeting_show($user_id) {
        // menghubungi student (via chat)
        //$users = User::whereIn('id', app(Controller::class)->get_relevant_user_ids_for_chat())->get();
        $users = User::all();
        $messages = Message
            ::where(function($q) {
                $q
                    ->whereIn('user_id_sender', app(Controller::class)->get_relevant_user_ids_for_chat())
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) {
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->whereIn('user_id_recipient', app(Controller::class)->get_relevant_user_ids_for_chat());
            })
            ->orderBy('created_at', 'DESC')
            ->get();
        
        $partner = User::findOrFail($user_id);
        $partner_messages = Message
            ::where(function($q) use($user_id){
                $q
                    ->where('user_id_sender', $user_id)
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) use($user_id){
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->where('user_id_recipient', $user_id);
            })
            ->select('user_id_sender', 'user_id_recipient', 'message', 'created_at')
            ->orderBy('created_at')
            ->get();
        return view('role_lead_instructor.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_student_alternative_meeting_store(Request $request, $user_id) {
        // menghubungi student (via chat)
        $data = Validator::make($request->all(), [
            'messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id => ['bail', 'required',],
        ]);
        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        Message::create([
            'user_id_sender' => Auth::user()->id,
            'user_id_recipient' => $user_id,
            'subject' => 'Unknown Subject',
            'message' => $request['messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id],
            'created_at' => now(),
        ]);
        return redirect()->back();
    }

    public function confirmation_by_meeting_update($course_registration_id) {
        // mengonfirmasi hasil placement test (menurut hasil meeting)
    }

    public function instructor_session_index() {
        // menampilkan halaman alokasi ketersediaan waktu instruktur
        
        // Jika fungsi ini tidak diakses oleh lead instructor.
        if(!$this->is_lead_instructor()) return redirect()->back();
        
        $instructors = Instructor
            ::join('users', 'instructors.user_id', 'users.id')
            ->where('users.email', 'NOT LIKE', '%trial%') // filter trial emails
            ->select('instructors.*')->get();
        $instructor_ids = $instructors->pluck('id')->toArray();
        
        $instructor_schedule_arrs = [];
        $instructor_schedules = InstructorSchedule
            ::join('instructors', 'instructors.id', 'instructor_schedules.instructor_id')
            ->whereIn('instructors.id', $instructor_ids)
            ->join('schedules', 'schedules.id', 'instructor_schedules.schedule_id')
            ->where('schedules.schedule_time', '>=', now())
            //->where('instructor_schedules.status', 'Available') // to check just 'Available' schedules (not used)
            ->select('instructor_schedules.*')->get();
        foreach($instructor_schedules as $is) {
            if(!isset($instructor_schedule_arrs[$is->instructor_id])) {
                $instructor_schedule_arrs[$is->instructor_id] = [$is];
            } else {
                array_push($instructor_schedule_arrs[$is->instructor_id], $is);
            }
        }
        
        $course_packages = CoursePackage
            ::where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
            ->where('course_packages.title', 'NOT LIKE', '%Early Registration%')
            ->where('course_packages.title', 'NOT LIKE', '%Test%')
            ->distinct()->get();
        
        $course_packages_ids = $course_packages->pluck('id')->toArray();
        
        $course_by_instructor_arrs = [];
        $courses = Course
            ::whereIn('courses.course_package_id', $course_packages_ids)
            ->join('sessions', 'sessions.course_id', 'courses.id')
            ->join('schedules', 'sessions.schedule_id', 'schedules.id')
            ->join('instructor_schedules', 'instructor_schedules.schedule_id', 'schedules.id')
            ->whereIn('instructor_schedules.instructor_id', $instructor_ids)
            ->select('courses.*', 'instructor_schedules.instructor_id')->distinct()->get();
        foreach($courses as $c) {
            if(!isset($course_by_instructor_arrs[$c->instructor_id])) {
                $course_by_instructor_arrs[$c->instructor_id] = [$c];
            } else {
                array_push($course_by_instructor_arrs[$c->instructor_id], $c);
            }
        }
        
        $material_types = MaterialType::where('name', 'NOT LIKE', '%Trial%')->get();
        
        return view('role_lead_instructor.assign_sessions', compact(
            'instructor_schedules', 'instructors', 'course_packages',
            'courses', 'material_types',
            'instructor_schedule_arrs', 'course_by_instructor_arrs'
        ));
    }

    public function class_schedule_is_available($schedule_time, $instructor_id, $course_package_id) {
        // returns instructor_schedule_id on true (otherwise, returns false).
        $session_duration = CoursePackage::where('id', $course_package_id)->first()->material_type->duration_in_minute;
        $instructor_schedules = InstructorSchedule
            ::join('schedules', 'instructor_schedules.schedule_id', 'schedules.id')
            ->where('instructor_schedules.instructor_id', $instructor_id)
            ->select('instructor_schedules.id as id', 'instructor_schedules.status as status', 'schedules.schedule_time')
            ->distinct()->get();
        foreach($instructor_schedules as $is) {
            if($schedule_time >= explode('||', $is->schedule_time)[0] && $schedule_time <= explode('||', $is->schedule_time)[1]) {
                return $is->id;
            }
        }
        return false;
    }

    public function add_class_schedule(
        $schedule_time, $schedule_time_end, $instructor_id, $instructor_schedule_id, $create_new_class = 0, $course_id = 0
    ) {
        // Fill $create_new_class with course_package_id to create new class,
        // and the ID will be returned to the main function.
        // However, fill $course_id if there's already a new class.
        // Apart from above descriptions, this function will return null.
        $instructor_schedule = InstructorSchedule::where('id', $instructor_schedule_id)->get()->first();
        $schedule_1 = explode('||', $instructor_schedule->schedule->schedule_time)[0];
        $schedule_2 = explode('||', $instructor_schedule->schedule->schedule_time)[1];
        $other_data_1 = explode('||', $instructor_schedule->schedule->schedule_time)[2];
        $other_data_2 = explode('||', $instructor_schedule->schedule->schedule_time)[3];
        $other_data_3 = explode('||', $instructor_schedule->schedule->schedule_time)[4];
        $other_data_4 = explode('||', $instructor_schedule->schedule->schedule_time)[5];
        $other_data_5 = explode('||', $instructor_schedule->schedule->schedule_time)[6];
        $other_data_6 = explode('||', $instructor_schedule->schedule->schedule_time)[7];
        $other_data_7 = explode('||', $instructor_schedule->schedule->schedule_time)[8];

        if($schedule_1 < $schedule_time) {
            // create "before" (the "available" schedule)
            InstructorSchedule::create([
                'instructor_id' => $instructor_id,
                'schedule_id' => Schedule::create([
                    'schedule_time' => $schedule_1 . '||' . $schedule_time . '||' . $other_data_1 . '||' . $other_data_2 . '||' . $other_data_3 . '||' . $other_data_4 . '||' . $other_data_5 . '||' . $other_data_6 . '||' . 'Proposed',
                ])->id,
                'status' => 'Available',
            ]);
        }

        if($schedule_time_end < $schedule_2) {
            // create "after" (the "available" schedule)
            InstructorSchedule::create([
                'instructor_id' => $instructor_id,
                'schedule_id' => Schedule::create([
                    'schedule_time' => $schedule_time_end . '||' . $schedule_2 . '||' . $other_data_1 . '||' . $other_data_2 . '||' . $other_data_3 . '||' . $other_data_4 . '||' . $other_data_5 . '||' . $other_data_6 . '||' . 'Proposed',
                ])->id,
                'status' => 'Available',
            ]);
        }
        
        // create "exactly" (this is the "busy" schedule)
        $new_busy_instructor_schedule = InstructorSchedule::create([
            'instructor_id' => $instructor_id,
            'schedule_id' => Schedule::create([
                'schedule_time' => $schedule_time . '||' . $schedule_time_end . '||' . $other_data_1 . '||' . $other_data_2 . '||' . $other_data_3 . '||' . $other_data_4 . '||' . $other_data_5 . '||' . $other_data_6 . '||' . 'Assigned',
            ])->id,
            'status' => 'Busy',
        ]);
        
        $instructor_schedule->schedule->delete();
        $instructor_schedule->delete();

        $new_course_id = null;
        if($create_new_class) {
            $course_package = CoursePackage::where('id', $create_new_class)->get()->first();
            $this_instructor_courses_count = InstructorSchedule
                ::join('schedules', 'instructor_schedules.schedule_id', 'schedules.id')
                ->join('sessions', 'sessions.schedule_id', 'schedules.id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->where('instructor_schedules.instructor_id', $instructor_id)
                ->select('courses.id as id')->distinct()->get();
            if($this_instructor_courses_count == null || $this_instructor_courses_count->toArray() == null) {
                $this_instructor_courses_count = 0;
            } else $this_instructor_courses_count = $this_instructor_courses_count->count();
            $new_course_id = Course::create([
                'course_package_id' => $course_package->id,
                'title' =>
                    $course_package->material_type->code
                    . $course_package->course_type->code
                    . $new_busy_instructor_schedule->instructor->code
                    . ($this_instructor_courses_count + 1),
                'description' => null,
                'requirement' => null,
            ])->id;
            Session::create([
                'course_id' => $new_course_id,
                'schedule_id' => $new_busy_instructor_schedule->schedule_id,
                'form_id' => 3,
                'title' => 'Session 1',
                'description' => null,
                'requirement' => null,
                'link_zoom' => null,
                'reschedule_late_confirmation' => 0,
                'reschedule_technical_issue_instructor' => 0,
                'reschedule_technical_issue_student' => 0,
            ]);
        } else {
            // Still a new course anyway.
            $new_course = Course::where('id', $course_id)->get()->first();
            Session::create([
                'course_id' => $new_course->id,
                'schedule_id' => $new_busy_instructor_schedule->schedule_id,
                'form_id' => 3,
                'title' => 'Session ' . ($new_course->sessions->count() + 1),
                'description' => null,
                'requirement' => null,
                'link_zoom' => null,
                'reschedule_late_confirmation' => 0,
                'reschedule_technical_issue_instructor' => 0,
                'reschedule_technical_issue_student' => 0,
            ]);
        }
        return $new_course_id; // Returns null if the course has been previously made.
    }

    public function instructor_session_new_class_update(Request $request) {
        // menambahkan kelas baru (dengan semua sesi dialokasikan secara otomatis)
        
        // Jika fungsi ini tidak diakses oleh lead instructor.
        if(!$this->is_lead_instructor()) return redirect()->back();
        
        $data = Validator::make($request->all(), [
            'course_package_id' => ['bail', 'required',],
            //'class_title' => ['bail', 'required',],
            'instructor_id' => ['bail', 'required',],
            'teaching_frequency' => ['bail', 'required',],
            'schedule_time_date1' => ['bail', 'required',],
            'schedule_time_time1' => ['bail', 'required',],
            'schedule_time_date2' => ['bail', 'sometimes',],
            'schedule_time_time2' => ['bail', 'sometimes',],
            'schedule_time_date3' => ['bail', 'sometimes',],
            'schedule_time_time3' => ['bail', 'sometimes',],
        ]);
        if($data->fails()) {
            session(['caption-danger' => 'This new class information has not been added. Try again.']);
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        
        $course_package = CoursePackage::where('id', $request->course_package_id)->first();
        $number_of_sessions = $course_package->count_session;
        $course_duration_in_minute = $course_package->material_type->duration_in_minute;
        
        $schedule_time_1 = Carbon::createFromFormat('m/d/Y H:i A', $request->schedule_time_date1 . ' ' . $request->schedule_time_time1);
        //$schedule_time_1_str = Carbon::createFromFormat('m/d/Y H:i A', $request->schedule_time_date1 . ' ' . $request->schedule_time_time1)->toDateTimeString();
        $schedule_time_2 = ($request->schedule_time_date2 != null)? Carbon::createFromFormat('m/d/Y H:i A', $request->schedule_time_date2 . ' ' . $request->schedule_time_time2) : null;
        //$schedule_time_2_str = ($request->schedule_time_date2 != null)? Carbon::createFromFormat('m/d/Y H:i A', $request->schedule_time_date2 . ' ' . $request->schedule_time_time2)->toDateTimeString() : null;
        $schedule_time_3 = ($request->schedule_time_date3 != null)? Carbon::createFromFormat('m/d/Y H:i A', $request->schedule_time_date3 . ' ' . $request->schedule_time_time3) : null;
        //$schedule_time_3_str = ($request->schedule_time_date3 != null)? Carbon::createFromFormat('m/d/Y H:i A', $request->schedule_time_date3 . ' ' . $request->schedule_time_time3)->toDateTimeString() : null;
        if(
          $schedule_time_1 < now()
          || ($schedule_time_2 && $schedule_time_2 < now())
          || ($schedule_time_3 && $schedule_time_3 < now())
        ) {
            session(['caption-danger' => 'Cannot schedule the class session as the inputted teaching availability has passed the current time.']);
            return redirect()->back()->withInput();
        }

        $new_course_id = 0; // container for new course ID yeay!
        if($schedule_time_1 && !$schedule_time_2 && !$schedule_time_3) {
            $get_schedule_id = $this->class_schedule_is_available($schedule_time_1, $request->instructor_id, $request->course_package_id);
            if(!$get_schedule_id) {
                session(['caption-danger' => 'Cannot schedule the class session as the inputted teaching availability is invalid for this instructor.']);
                return redirect()->back()->withInput();
            }
            $schedule_time_1_end = Carbon::parse($schedule_time_1)->add($course_duration_in_minute, 'minutes');
            $new_course_id = $this->add_class_schedule($schedule_time_1, $schedule_time_1_end, $request->instructor_id, $get_schedule_id, $request->course_package_id, 0);
            for($i = 1; $i < $number_of_sessions; $i++) {
                $schedule_time_1 = $schedule_time_1->add('1', 'week');
                $get_schedule_id = $this->class_schedule_is_available($schedule_time_1, $request->instructor_id, $request->course_package_id);
                if(!$get_schedule_id) {
                    session(['caption-danger' => 'At least one session is not set properly, please check the new class information.']);
                    return redirect()->back()->withInput();
                }
                $schedule_time_1_end = Carbon::parse($schedule_time_1)->add($course_duration_in_minute, 'minutes');
                $this->add_class_schedule($schedule_time_1, $schedule_time_1_end, $request->instructor_id, $get_schedule_id, 0, $new_course_id);
            }
        } else if($schedule_time_1 && $schedule_time_2 && !$schedule_time_3) {
            /* SORT */ if($schedule_time_1 > $schedule_time_2) { $temp = $schedule_time_1; $schedule_time_1 = $schedule_time_2; $schedule_time_2 = $temp; }
            
            $get_schedule_id = $this->class_schedule_is_available($schedule_time_1, $request->instructor_id, $request->course_package_id);
            if(!$get_schedule_id) {
                session(['caption-danger' => 'Cannot schedule the class session as the inputted teaching availability is invalid for this instructor.']);
                return redirect()->back()->withInput();
            }
            $schedule_time_1_end = Carbon::parse($schedule_time_1)->add($course_duration_in_minute, 'minutes');
            $new_course_id = $this->add_class_schedule($schedule_time_1, $schedule_time_1_end, $request->instructor_id, $get_schedule_id, $request->course_package_id, 0);
            for($i = 1; $i < $number_of_sessions; $i++) {
                $schedule_time_1 = $schedule_time_1->add('1', 'week');
                /* SORT */ if($schedule_time_1 > $schedule_time_2) { $temp = $schedule_time_1; $schedule_time_1 = $schedule_time_2; $schedule_time_2 = $temp; }
                $get_schedule_id = $this->class_schedule_is_available($schedule_time_1, $request->instructor_id, $request->course_package_id);
                if(!$get_schedule_id) {
                    // repeat again the process to make sure the second schedule is available (or not)
                    $schedule_time_1 = $schedule_time_1->add('1', 'week');
                    /* SORT */ if($schedule_time_1 > $schedule_time_2) { $temp = $schedule_time_1; $schedule_time_1 = $schedule_time_2; $schedule_time_2 = $temp; }
                    $get_schedule_id = $this->class_schedule_is_available($schedule_time_1, $request->instructor_id, $request->course_package_id);
                    if(!$get_schedule_id) {
                        // eventually if (still) not available, return this message
                        session(['caption-danger' => 'At least one session is not set properly, please check the new class information.']);
                        return redirect()->back()->withInput();
                    }
                }
                $schedule_time_1_end = Carbon::parse($schedule_time_1)->add($course_duration_in_minute, 'minutes');
                $this->add_class_schedule($schedule_time_1, $schedule_time_1_end, $request->instructor_id, $get_schedule_id, 0, $new_course_id);
            }
        } else if($schedule_time_1 && $schedule_time_2 && $schedule_time_3) {
            /* SORT */ if(min($schedule_time_1, $schedule_time_2, $schedule_time_3) == $schedule_time_1) { $temp_1 = $schedule_time_1; if(min($schedule_time_2, $schedule_time_3) == $schedule_time_2) { $temp_2 = $schedule_time_2; $temp_3 = $schedule_time_3; } else { $temp_2 = $schedule_time_3; $temp_3 = $schedule_time_2; } } else if(min($schedule_time_1, $schedule_time_2, $schedule_time_3) == $schedule_time_2) { $temp_1 = $schedule_time_2; if(min($schedule_time_1, $schedule_time_3) == $schedule_time_1) { $temp_2 = $schedule_time_1; $temp_3 = $schedule_time_3; } else { $temp_2 = $schedule_time_3; $temp_3 = $schedule_time_1; } } else { $temp_1 = $schedule_time_3; if(min($schedule_time_1, $schedule_time_2) == $schedule_time_1) { $temp_2 = $schedule_time_1; $temp_3 = $schedule_time_2; } else { $temp_2 = $schedule_time_2; $temp_3 = $schedule_time_1; } } $schedule_time_1 = $temp_1; $schedule_time_2 = $temp_2; $schedule_time_3 = $temp_3;
            
            $get_schedule_id = $this->class_schedule_is_available($schedule_time_1, $request->instructor_id, $request->course_package_id);
            if(!$get_schedule_id) {
                session(['caption-danger' => 'Cannot schedule the class session as the inputted teaching availability is invalid for this instructor.']);
                return redirect()->back()->withInput();
            }
            $schedule_time_1_end = Carbon::parse($schedule_time_1)->add($course_duration_in_minute, 'minutes');
            $new_course_id = $this->add_class_schedule($schedule_time_1, $schedule_time_1_end, $request->instructor_id, $get_schedule_id, $request->course_package_id, 0);
            for($i = 1; $i < $number_of_sessions; $i++) {
                $schedule_time_1 = $schedule_time_1->add('1', 'week');
                /* SORT */ if(min($schedule_time_1, $schedule_time_2, $schedule_time_3) == $schedule_time_1) { $temp_1 = $schedule_time_1; if(min($schedule_time_2, $schedule_time_3) == $schedule_time_2) { $temp_2 = $schedule_time_2; $temp_3 = $schedule_time_3; } else { $temp_2 = $schedule_time_3; $temp_3 = $schedule_time_2; } } else if(min($schedule_time_1, $schedule_time_2, $schedule_time_3) == $schedule_time_2) { $temp_1 = $schedule_time_2; if(min($schedule_time_1, $schedule_time_3) == $schedule_time_1) { $temp_2 = $schedule_time_1; $temp_3 = $schedule_time_3; } else { $temp_2 = $schedule_time_3; $temp_3 = $schedule_time_1; } } else { $temp_1 = $schedule_time_3; if(min($schedule_time_1, $schedule_time_2) == $schedule_time_1) { $temp_2 = $schedule_time_1; $temp_3 = $schedule_time_2; } else { $temp_2 = $schedule_time_2; $temp_3 = $schedule_time_1; } } $schedule_time_1 = $temp_1; $schedule_time_2 = $temp_2; $schedule_time_3 = $temp_3;
                $get_schedule_id = $this->class_schedule_is_available($schedule_time_1, $request->instructor_id, $request->course_package_id);
                if(!$get_schedule_id) {
                    // repeat again the process to make sure the second schedule is available (or not)
                    $schedule_time_1 = $schedule_time_1->add('1', 'week');
                    /* SORT */ if($schedule_time_1 > $schedule_time_2) { $temp = $schedule_time_1; $schedule_time_1 = $schedule_time_2; $schedule_time_2 = $temp; }
                    $get_schedule_id = $this->class_schedule_is_available($schedule_time_1, $request->instructor_id, $request->course_package_id);
                    if(!$get_schedule_id) {
                        // repeat again the process to make sure the third schedule is available (or not)
                        $schedule_time_1 = $schedule_time_1->add('1', 'week');
                        /* SORT */ if($schedule_time_1 > $schedule_time_2) { $temp = $schedule_time_1; $schedule_time_1 = $schedule_time_2; $schedule_time_2 = $temp; }
                        $get_schedule_id = $this->class_schedule_is_available($schedule_time_1, $request->instructor_id, $request->course_package_id);
                        if(!$get_schedule_id) {
                            // eventually if (still) not available, return this message
                            session(['caption-danger' => 'At least one session is not set properly, please check the new class information.']);
                            return redirect()->back()->withInput();
                        }
                    }
                }
                $schedule_time_1_end = Carbon::parse($schedule_time_1)->add($course_duration_in_minute, 'minutes');
                $this->add_class_schedule($schedule_time_1, $schedule_time_1_end, $request->instructor_id, $get_schedule_id, 0, $new_course_id);
            }
        } else return redirect()->back()->withInput();
        
        session(['caption-success' => 'This new class information has been added. Thank you!']);
        return redirect()->route('lead_instructor.instructor_session.index');
    }

    public function instructor_session_schedule_update(Request $request) {
        // mengedit informasi jadwal masing-masing sesi
        
        // Jika fungsi ini tidak diakses oleh lead instructor.
        if(!$this->is_lead_instructor()) return redirect()->back();
        
        $data = Validator::make($request->all(), [
            'unique_id' => ['bail', 'required',],
            'material_type_id' => ['bail', 'required',],
            'course_id' => ['bail', 'required',],
            'instructor_id' => ['bail', 'required',],
            'session_number' => ['bail', 'required',],
            'session_has_been_created' => ['bail', 'required',],
            'schedule_time_date' . $request->unique_id => ['bail', 'required',],
            'schedule_time_time' . $request->unique_id => ['bail', 'required',],
        ]);
        if($data->fails()) {
            session(['caption-danger' => 'This session information has not been updated. Try again.']);
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        
        $schedule_time = Carbon::createFromFormat('m/d/Y H:i A', $request['schedule_time_date' . $request->unique_id] . ' ' . $request['schedule_time_time' . $request->unique_id])->toDateTimeString();
        if($schedule_time < now()) {
            session(['caption-danger' => 'Cannot schedule the class session as the inputted teaching availability has passed the current time.']);
            return redirect()->back()->withInput();
        }
        
        $instructor_schedule = InstructorSchedule
            ::join('schedules', 'instructor_schedules.schedule_id', 'schedules.id')
            ->where('schedules.schedule_time', $schedule_time)
            ->where('instructor_id', $request->instructor_id)
            ->select('instructor_schedules.id', 'instructor_schedules.code', 'instructor_schedules.instructor_id', 'instructor_schedules.schedule_id', 'instructor_schedules.status', 'instructor_schedules.created_at', 'instructor_schedules.updated_at', 'instructor_schedules.deleted_at')
            ->distinct()->first();
        if($instructor_schedule == null) {
            session(['caption-danger' => 'Cannot schedule, as the inputted teaching availability is invalid for this instructor.']);
            return redirect()->back()->withInput();
        }
        
        if($request->session_has_been_created == 1) {
            Session::where('course_id', $request->course_id)
                ->where('title', 'Session ' . $request->session_number)
                ->first()->update([
                    'schedule_id' => $instructor_schedule->schedule_id,
                    'updated_at' => now(),
            ]);
        } else {
            Session::create([
                'course_id' => $request->course_id,
                'schedule_id' => $instructor_schedule->schedule_id,
                'form_id' => 3,
                'title' => 'Session ' . $request->session_number,
                'description' => null,
                'requirement' => null,
                'link_zoom' => null,
                'reschedule_late_confirmation' => 0,
                'reschedule_technical_issue_instructor' => 0,
                'reschedule_technical_issue_student' => 0,
                'created_at' => now(),
            ]);
        }
        $instructor_schedule->update([
            'status' => 'Busy',
            'updated_at' => now(),
        ]);
        
        session(['caption-success' => 'This session information has been updated. Thank you!']);
        return redirect()->route('lead_instructor.instructor_session.index');
    }

    public function course_certificate_update(Request $request, $course_registration_id) {
        // mengunggah sertifikat
        
    }
}
