<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\User;

use Str;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Session;
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
        return ($this->user_roles() == "Instructor")? 1 : 0;
    }
    public function is_student() {
        return ($this->user_roles() == "Student")? 1 : 0;
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Berpindah ke ProfileController, fungsi update()
    }
}
