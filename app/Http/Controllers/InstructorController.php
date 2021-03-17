<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class InstructorController extends Controller
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

    public function schedule_index() {
        // melihat jadwal mengajar yang diintegrasikan dengan sesi, yang sedang atau akan berlangsung
        // & melaksanakan kelas (via meeting link)
        // & melihat ketersediaan jadwal mengajar yang pernah dibuat, secara menyeluruh
        // & melihat daftar course yang diajar
        // & melihat hasil filter daftar course sesuai jenis course
        $data = Session
            ::join('schedules', 'sessions.schedule_id', 'schedules.id')
            ->where('schedules.instructor_id', Auth::user()->instructor->id)
            ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id)
            ->get();
        // BUG: Cara menampilkan di formulir <select>, hanya Session yang belum dimulai. Jika sudah selesai, untuk apa mengganti link Zoom ?
        return view('role_instructor.session_registrations_index',compact('data'));
    }

    public function schedule_store(Request $request) {
        // menambah ketersediaan jadwal mengajar
    }

    public function schedule_update(Request $request, $schedule_id) {
        // memodifikasi ketersediaan jadwal mengajar
    }

    public function schedule_integrate_update(Request $request, $schedule_id) {
        // mengintegrasikan ketersediaan jadwal mengajar dengan sesi tertentu
    }

    public function schedule_destroy($schedule_id) {
        // menghapus ketersediaan jadwal mengajar
    }

    public function course_show($course_id) {
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
        $data = Course::findOrFail($course_id);
        return view('role_instructor.course_registrations_index_by_course_id', compact('data'));
    }

    public function session_store(Request $request, $course_id) {
        // membuat sesi baru
        // & mengintegrasikan ketersediaan jadwal mengajar dengan sesi tertentu
        // & menambah ketersediaan jadwal mengajar
    }

    public function session_update(Request $request, $course_id, $session_id) {
        // memodifikasi informasi umum mengenai sesi
        // & memodifikasi ketersediaan jadwal mengajar
        Session::where('id', $request->session_registration)->update([
            'link_zoom' => $request->link_zoom,
        ]);
        return redirect()->route('instructor.course.show', [$course_id]);
    }

    public function session_destroy($course_id, $session_id) {
        // menghapus informasi sesi
        // & menghapus ketersediaan jadwal mengajar
    }

    public function student_attendance_index($course_id, $session_id) {
        // melihat status kehadiran student dalam setiap sesi
        $session_registrations = SessionRegistration::where('session_id', $session_id)->get();
        if($session_registrations->count() == 0) {
            return redirect()->route('instructor.student_attendance.index');
        }
        
        $session = Session::findOrFail($session_id);
        $schedule_time = Carbon::parse($session->schedule->schedule_time);
        if(now() <= $schedule_time->add($session->course->course_package->material_type->duration_in_minute, 'minutes')) {
            // tidak diperbolehkan mengakses link.
            return redirect()->back();
        }
        
        return view('role_instructor.attendances_edit', compact('session_registrations', 'session'));
    }

    public function student_attendance_update(Request $request, $course_id, $session_id) {
        // mengubah status kehadiran student dalam satu sesi
            foreach(Session::findOrFail($session_id)->session_registrations as $sr) {
                $flag = 0;
                foreach($request->all() as $key => $val) {
                    if($key == 'flag'.$sr->course_registration->student->id && $val == 'true') {
                        $sr->update([
                            'status' => 'Should Submit Form',
                        ]);
                        $flag = 1;
                        break;
                    }
                }
                if($flag == 0) {
                    $sr->update([
                        'status' => 'Not Present',
                    ]);
                }
            }
    }

    public function session_feedback_index($course_id, $session_id) {
        // melihat feedback per sesi
    }

    public function material_store(Request $request, $course_id) {
        // mengunggah materi
    }

    public function material_download($course_id, $material_type, $material_id) {
        // mengunduh materi
        // 1 untuk MaterialPublic
        // 2 untuk MaterialSession
        if($material_type == 1) $data = MaterialPublic::find($material_id);
        else if($material_type == 2) $data = MaterialSession::find($material_id);
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path;
        $path = 'uploads/material/' . $data->path;
        return response()->download($path, $file_name);
    }

    public function material_update(Request $request, $course_id, $material_type, $material_id) {
        // memodifikasi informasi materi
    }

    public function material_destroy($course_id, $material_type, $material_id) {
        // menghapus informasi materi
    }

    public function assignment_store(Request $request, $course_id) {
        // mengunggah tugas
    }

    public function assignment_download($course_id, $assignment_id) {
        // mengunduh tugas
        $data = Task::where('type', 'Assignment')->where('id', $assignment_id)->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path;
        $path = 'uploads/assignment/' . $data->path;
        return response()->download($path, $file_name);
    }

    public function assignment_update(Request $request, $course_id, $assignment_id) {
        // memodifikasi informasi tugas
    }

    public function assignment_destroy(Request $request, $course_id, $assignment_id) {
        // menghapus informasi tugas
    }

    public function assignment_submission_download($course_id, $submission_id) {
        // mengunduh pengumpulan tugas
        $data = TaskSubmission
            ::join('tasks', 'task_submissions.task_id', 'tasks.id')->where('tasks.type', 'Assignment')
            ->where('task_submissions.id', $submission_id)
            ->select('task_submissions.id', 'task_submissions.code', 'task_submissions.session_registration_id', 'task_submissions.task_id', 'task_submissions.title', 'task_submissions.description', 'task_submissions.status', 'task_submissions.score', 'task_submissions.instructor_reply', 'task_submissions.path_1', 'task_submissions.path_1_submitted_at', 'task_submissions.path_2', 'task_submissions.path_2_submitted_at', 'task_submissions.path_3', 'task_submissions.path_3_submitted_at', 'task_submissions.created_at', 'task_submissions.updated_at', 'task_submissions.deleted_at')
            ->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path_1;
        $path = 'uploads/assignment/submission/' . $data->path_1;
        return response()->download($path, $file_name);
    }

    public function assignment_submission_update(Request $request, $course_id, $submission_id) {
        // mengoreksi pengumpulan tugas
    }

    public function exam_store(Request $request, $course_id) {
        // mengunggah ujian
    }

    public function exam_download($course_id, $exam_id) {
        // mengunduh ujian
        $data = Task::where('type', 'Exam')->where('id', $exam_id)->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path;
        $path = 'uploads/exam/' . $data->path;
        return response()->download($path, $file_name);
    }

    public function exam_update(Request $request, $course_id, $exam_id) {
        // memodifikasi informasi ujian
    }

    public function exam_destroy(Request $request, $course_id, $exam_id) {
        // menghapus informasi ujian
    }

    public function exam_submission_download($course_id, $submission_id) {
        // mengunduh pengumpulan ujian
        $data = TaskSubmission
            ::join('tasks', 'task_submissions.task_id', 'tasks.id')->where('tasks.type', 'Exam')
            ->where('task_submissions.id', $submission_id)
            ->select('task_submissions.id', 'task_submissions.code', 'task_submissions.session_registration_id', 'task_submissions.task_id', 'task_submissions.title', 'task_submissions.description', 'task_submissions.status', 'task_submissions.score', 'task_submissions.instructor_reply', 'task_submissions.path_1', 'task_submissions.path_1_submitted_at', 'task_submissions.path_2', 'task_submissions.path_2_submitted_at', 'task_submissions.path_3', 'task_submissions.path_3_submitted_at', 'task_submissions.created_at', 'task_submissions.updated_at', 'task_submissions.deleted_at')
            ->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path_1;
        $path = 'uploads/exam/submission/' . $data->path_1;
        return response()->download($path, $file_name);
    }

    public function exam_submission_update(Request $request, $course_id, $submission_id) {
        // mengoreksi pengumpulan ujian
    }

    public function instructor_profile_show($user_id) {
        // melihat informasi profil instructor lain
    }

    public function chat_instructor_index() {
        // menghubungi instructor lain (via chat)
    }

    public function chat_instructor_show($user_id) {
        // menghubungi instructor lain (via chat)
    }

    public function chat_instructor_store(Request $request, $user_id) {
        // menghubungi instructor lain (via chat)
    }

    public function student_profile_show($user_id) {
        // melihat informasi profil student
        
        // PERLU MENGUBAH KEMBALI KODE INI SESUAI UPDATE DB YANG BARU
        $student = Student::where('user_id', $user_id)->get()->first();
        
        $flag = 0;
        foreach($student->course_registrations as $cr) {
            foreach($cr->session_registrations as $sr) {
                if($sr->session->schedule->instructor_id == Auth::user()->instructor->id) {
                    $flag = 1;
                    break;
                } else if($sr->session->schedule->instructor_id_2 == Auth::user()->instructor->id) {
                    $flag = 1;
                    break;
                }
            }
            if($flag == 1) break;
        }
        
        if($flag == 1) {
            return view('role_instructor.student_profile_show', compact('student'));
        } else {
            return redirect()->back();
        }
    }

    public function chat_group_index() {
        // menghubungi member course (via group chat)
    }

    public function chat_group_show($course_id) {
        // menghubungi member course (via group chat)
    }

    public function chat_group_store(Request $request, $course_id) {
        // menghubungi member course (via group chat)
    }

    public function chat_student_index() {
        // menghubungi student (via chat)
    }

    public function chat_student_show($user_id) {
        // menghubungi student (via chat)
    }

    public function chat_student_store(Request $request, $user_id) {
        // menghubungi student (via chat)
    }

    public function index_course()
    {
        $courses = null;
        $sessions = null;
        if ($this->is_lead_instructor() || $this->is_instructor()) {
            $courses = Course
                ::join('sessions', 'courses.id', 'sessions.course_id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('instructor_schedules', 'instructor_schedules.schedule_id', 'schedules.id')
                ->where('instructor_schedules.instructor_id', Auth::user()->instructor->id)
                //->where('instructor_schedules.status', 'Busy')
                ->select('courses.id', 'courses.code', 'courses.course_package_id', 'courses.title', 'courses.description', 'courses.requirement', 'courses.created_at', 'courses.updated_at')
                ->distinct()
                ->get();
            $sessions = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('instructor_schedules', 'instructor_schedules.schedule_id', 'schedules.id')
                ->where('instructor_schedules.instructor_id', Auth::user()->instructor->id)
                ->distinct()
                ->orderBy('schedules.schedule_time')
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.form_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.reschedule_late_confirmation', 'sessions.reschedule_technical_issue_instructor', 'sessions.reschedule_technical_issue_student', 'sessions.created_at', 'sessions.updated_at', 'sessions.deleted_at')
                ->get();
        } else return redirect()->route('home');

        if($this->is_lead_instructor()) {
            return view('role_lead_instructor.instructor_index_course', compact(
                'courses', 'sessions',
            ));
        } else if($this->is_instructor()) {
            return view('role_instructor.instructor_index_course', compact(
                'courses', 'sessions',
            ));
        }
    }

    public function show_course($course_id)
    {
        /*if ($this->is_lead_instructor() || $this->is_instructor()) {
            $course = Course
                ::join('sessions', 'sessions.course_id', 'courses.id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('instructor_schedules', 'instructor_schedules.schedule_id', 'schedules.id')
                ->where('instructor_schedules.instructor_id', Auth::user()->instructor->id)
                ->where('courses.id', $course_id)
                ->select('courses.id', 'courses.code', 'courses.course_package_id', 'courses.title', 'courses.description', 'courses.requirement', 'courses.created_at', 'courses.updated_at', 'courses.deleted_at')
                ->distinct()->get()->first();
        } else return redirect()->route('sessions.index');

        if($this->is_lead_instructor()) {
            return view('role_lead_instructor.instructor_show_course', compact('course'));
        } else if($this->is_instructor()) {
            return view('role_instructor.instructor_show_course', compact('course'));
        }*/
    }
}
