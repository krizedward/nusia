<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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

class CourseRegistrationController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->flag == false) return redirect()->route('courses.index');

        $data = $request->all();
        $data = Validator::make($data, [
            'course_id' => [
                'bail', 'required',
                Rule::unique('course_registrations', 'course_id')
                    ->where('student_id', $request->student_id)
            ],
            'student_id' => [
                'bail', 'required',
                Rule::unique('course_registrations', 'student_id')
                    ->where('course_id', $request->course_id)
            ]
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin()) {
            CourseRegistration::create([
                'course_id' => $request->course_id,
                'student_id' => $request->student_id
            ]);

            $course = Course::findOrFail($request->course_id);
            $course_registration_id = CourseRegistration::all()->last()->id;
            foreach($course->sessions as $s) {
                SessionRegistration::create([
                    'session_id' => $s->id,
                    'course_registration_id' => $course_registration_id,
                    'status' => 'Not Assigned',
                ]);
            }
        }

        $data = CourseRegistration::all();
        return view('registrations.courses.index', compact('data'));
    }

    public function show_by_admin($user_id, $course_id)
    {
        $course_registrations = CourseRegistration::all();
        $course_registration = null;
        $flag = 0;
        foreach($course_registrations as $dt) {
            if(
                Str::slug(
                $dt->student->user->password.
                $dt->student->user->first_name.
                '-'.$dt->student->user->last_name) == $user_id
                &&
                Str::slug($dt->created_at.'-'.$dt->course->title) == $course_id
            ) {
                $course_registration = $dt;
                $flag = 1;
                break;
            }
        }
        if($flag == 0) {
            if(session('redirect_again') != 1) {
                session(['redirect_again' => 1]);
                return redirect()->back();
            } else {
                session(['redirect_again' => null]);
                return redirect()->route('users.index');
            }
        }

        $material_types = MaterialType::all();
        $course_types = CourseType::all();
        $course_levels = CourseLevel::all();

        $course_payments = CoursePayment
            ::where('course_registration_id', $course_registration->id)
            ->orderBy('payment_time')
            ->get();

        return view('role_'.Str::slug(Auth::user()->roles, '_').'.course_registrations_show_'.Str::slug($course_registration->student->user->roles, '_'), compact(
            'course_registration', 'material_types', 'course_types', 'course_levels', 'course_payments',
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CourseRegistration::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($data->course_certificate() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($data->course_payment() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($data->session_registrations() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else if($this->is_instructor()) {
            // Melakukan request ke Admin.
        } else if($this->is_student()) {
            // Melakukan request ke Instructor, kemudian ke Admin.
        } else {
            // Tidak memiliki hak akses.
        }

        $data = CourseRegistration::all();
        return view('registrations.courses.index', compact('data'));
    }
}
