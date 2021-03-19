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
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->where('course_packages.title', 'LIKE', '%Not Assigned%')
            ->where('placement_tests.status', 'Not Passed')
            ->where('placement_tests.path', '<>', null)
            ->get();
        
        return view('role_lead_instructor.placement_tests_index', compact(
            'material_types', 'placement_tests',
        ));
    }

    public function student_registration_show($course_registration_id) {
        // melihat informasi profil student
        
        // Jika fungsi ini tidak diakses oleh lead instructor.
        if(!$this->is_lead_instructor()) return redirect()->back();
        
        $course_registration = CourseRegistration::where('id', $course_registration_id)->get()->first();
        
        // Periksa apakah akses untuk mengganti placement test ini diperbolehkan.
        // Tidak diperbolehkan, jika status sudah "Passed" atau
        // link belum diunggah (untuk placement test yang pernah ditolak sebelumnya).
        if($course_registration->placement_test->path == null || $course_registration->placement_test->status == 'Passed') {
            return redirect()->back();
        }
        
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
        $user_id_senders = Message::where('user_id_sender', 'NOT LIKE', Auth::user()->id)->pluck('user_id_sender')->toArray();
        $user_id_recipients = Message::where('user_id_recipient', 'NOT LIKE', Auth::user()->id)->pluck('user_id_recipient')->toArray();
        $user_ids = array_unique(array_merge($user_id_senders, $user_id_recipients));
        $users = User::whereIn('id', $user_ids)->get();
        $messages = Message::whereIn('user_id_sender', $user_ids)
            ->orWhereIn('user_id_recipient', $user_ids)
            ->orderBy('created_at', 'DESC')
            ->get();
        
        $partner = User::findOrFail($user_id);
        $partner_messages = Message
            ::where('user_id_sender', $user_id)
            ->orWhere('user_id_recipient', $user_id)
            ->select('user_id_sender', 'user_id_recipient', 'message', 'created_at')
            ->orderBy('created_at')
            ->get();
        return view('role_lead_instructor.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_student_store(Request $request, $user_id) {
        // menghubungi student (via chat)
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
            'indonesian_language_proficiency' => ['bail', 'required_unless:status,"Not Passed"',],
            'crid' => ['bail', 'required'],
        ]);
        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        
        $course_registration = CourseRegistration::where('id', $course_registration_id)->get()->first();
        
        // Jika hasil placement test tidak diterima ('Not Passed').
        if($request->status == 'Not Passed') {
            $course_registration->placement_test->update([
                'path' => null,
                'submitted_at' => null,
                'result_updated_at' => now(),
            ]);
            return redirect()->route('lead_instructor.student_registration.index');
        }
        
        // Jika hasil placement test diterima ('Passed').
        
        // Periksa apakah Student sudah mendaftar pada early classes dengan material sama.
        $early_classes_registration = CourseRegistration
            ::join('courses', 'course_registrations.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->where('course_registrations.student_id', $course_registration->student_id)
            ->where('course_packages.title', 'LIKE', '%Early Registration%')
            ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
            ->get();
        
        // Simpan keterangan apakah Student sudah mendaftar pada early classes dengan material sama.
        $have_early_classes_for_same_material_type = 0;
        
        // Untuk semua early classes.
        foreach($early_classes_registration as $ecr) {
            // Apabila sudah ada pendaftaran pada material type yang sama.
            if($ecr->course->course_package->material_type_id == $course_registration->course->course_package->material_type_id) {
                // Maka, tidak diperbolehkan mendaftar pada early class di material type yang sama.
                $have_early_classes_for_same_material_type = 1;
                
                // Jika terdaftar pada early class dengan material sama,
                // maka Student perlu bergabung dalam course berbayar.
                // Setelah mengetahui hal ini, tidak diperlukan iterasi kembali.
                break;
            }
        }
        
        // Kode tambahan untuk memperoleh course_type
        // (misal "Not Assigned - PRIVATE" menjadi "Private")
        $course_type = ucwords(strtolower($course_registration->course->course_package->course_type->name));
        $first_hyphen_pos = strpos($course_type, '-');
        $substring_loc = strlen($course_type) - $first_hyphen_pos - 2; // -2 sebagai bonus indeks hyphen itu sendiri dan satu spasi.
        $course_type = substr($course_type, 0 - $substring_loc);
        
        if($have_early_classes_for_same_material_type) {
            // Student sudah pernah terdaftar (sebelumnya) dalam early class, pada material yang sama.
            if($course_registration->course->course_package->material_type->name == 'Cultural Classes') {
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
                    ->where('title', 'NOT LIKE', '%Early Registration%')
                    ->where('title', 'LIKE', '%'.$course_registration->course->course_package->material_type->name.'%')
                    ->where('title', 'LIKE', '%'.$course_type.'%')
                    ->where('course_level_id', $request->indonesian_language_proficiency)
                    ->first();
            }
        } else {
            // Student tidak pernah terdaftar (sebelumnya) dalam early class (pada material yang sama).
            if($course_registration->course->course_package->material_type->name == 'Cultural Classes') {
                $course_package = CoursePackage
                    ::join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    ->where('course_packages.title', 'NOT LIKE', '%Free%')
                    ->where('course_packages.title', 'NOT LIKE', '%Test%')
                    ->where('course_packages.title', 'NOT LIKE', '%Trial%')
                    ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
                    ->where('course_packages.title', 'LIKE', 'Early Registration%')
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
                    ->where('title', 'LIKE', 'Early Registration%')
                    ->where('title', 'LIKE', '%'.$course_registration->course->course_package->material_type->name.'%')
                    ->where('title', 'LIKE', '%'.$course_type.'%')
                    ->where('course_level_id', $request->indonesian_language_proficiency)
                    ->first();
            }
        }
        
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
        ]);
        return redirect()->route('lead_instructor.student_registration.index');
    }

    public function placement_test_by_meeting_store(Request $request) {
        // menambahkan jadwal meeting alternatif
    }

    public function placement_test_by_meeting_update(Request $request, $session_id) {
        // memodifikasi informasi jadwal meeting alternatif
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
        $user_id_senders = Message::where('user_id_sender', 'NOT LIKE', Auth::user()->id)->pluck('user_id_sender')->toArray();
        $user_id_recipients = Message::where('user_id_recipient', 'NOT LIKE', Auth::user()->id)->pluck('user_id_recipient')->toArray();
        $user_ids = array_unique(array_merge($user_id_senders, $user_id_recipients));
        $users = User::whereIn('id', $user_ids)->get();
        $messages = Message::whereIn('user_id_sender', $user_ids)
            ->orWhereIn('user_id_recipient', $user_ids)
            ->orderBy('created_at', 'DESC')
            ->get();
        
        $partner = User::findOrFail($user_id);
        $partner_messages = Message
            ::where('user_id_sender', $user_id)
            ->orWhere('user_id_recipient', $user_id)
            ->select('user_id_sender', 'user_id_recipient', 'message', 'created_at')
            ->orderBy('created_at')
            ->get();
        return view('role_lead_instructor.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_student_alternative_meeting_store(Request $request, $user_id) {
        // menghubungi student (via chat)
    }

    public function confirmation_by_meeting_update($course_registration_id) {
        // mengonfirmasi hasil placement test (menurut hasil meeting)
    }
}
