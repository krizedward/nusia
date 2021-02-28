<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SessionRegistration;
use App\Models\CourseRegistration;
use App\Models\Session;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SessionRegistrationController extends Controller
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
        return ($this->user_roles() == "Instructor")? 1 : 0;
    }
    public function is_student() {
        return ($this->user_roles() == "Student")? 1 : 0;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->is_lead_instructor()){
            $data = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('schedules.instructor_id', Auth::user()->instructor->id)
                ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id)
                ->get();
            // BUG: Cara menampilkan di formulir <select>, hanya Session yang belum dimulai. Jika sudah selesai, untuk apa mengganti link Zoom ?
            return view('role_lead_instructor.session_registrations_index',compact('data'));
        }

        else if ($this->is_instructor()){
            $data = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('schedules.instructor_id', Auth::user()->instructor->id)
                ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id)
                ->get();
            // BUG: Cara menampilkan di formulir <select>, hanya Session yang belum dimulai. Jika sudah selesai, untuk apa mengganti link Zoom ?
            return view('role_instructor.session_registrations_index',compact('data'));
        }

        else if ($this->is_student()){
            // Menyimpan keseluruhan ID course yang sudah terdaftar (untuk Student ybs).
            $completed_registrations = [];

            // Melakukan seleksi daftar early registrations
            // (karena ada Early Registration yang belum/tidak selesai pendaftarannya
            // karena belum/tidak menentukan jadwal [dan instruktur]).
            $early_registrations = CourseRegistration
                ::join('courses', 'course_registrations.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
                ->where('course_packages.title', 'LIKE', '%Early Registration%')
                ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
                ->get();
            foreach($early_registrations as $er)
                if($er->session_registrations->toArray() != null)
                    array_push($completed_registrations, $er->id);

            $other_registrations = CourseRegistration
                ::join('courses', 'course_registrations.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
                ->where('course_packages.title', 'NOT LIKE', '%Early Registration%')
                ->pluck('course_registrations.id');
            foreach($other_registrations as $or)
                // Nilai dalam array bersifat otomatis distinct()
                // karena ada seleksi penggunaan kata "Early Registration" dalam course_package.
                // Sehingga, tidak perlu digunakan PHP function in_array().
                array_push($completed_registrations, $or->id);

            // Bagian ini untuk mengambil daftar sesi yang diikuti oleh Student.
            $course_registrations = Auth::user()->student->course_registrations->pluck('id');
            $session_registrations = SessionRegistration
                ::join('sessions', 'session_registrations.session_id', 'sessions.id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
                ->whereIn('session_registrations.course_registration_id', $course_registrations)
                ->orderBy('schedules.schedule_time')
                ->select('session_registrations.id', 'session_registrations.code', 'session_registrations.session_id', 'session_registrations.course_registration_id', 'session_registrations.registration_time', 'session_registrations.status', 'session_registrations.created_at', 'session_registrations.updated_at', 'session_registrations.deleted_at')
                ->get();

            // Bagian ini untuk mengambil daftar course yang diikuti oleh Student.
            $course_registrations = CourseRegistration
                ::whereIn('id', $completed_registrations)
                ->get();

            return view('role_student.session_registrations_index', compact(
                'session_registrations', 'course_registrations',
            ));
        } else {
            return redirect()->route('home');
        }
    }
}
