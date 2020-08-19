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
    public function index($course_type = 'Free Trial')
    {
        if ($this->is_admin()){
            $data = SessionRegistration::all();
            return view('session_registrations.admin_index',compact('data','session'));
        }

        else if ($this->is_instructor()){
            $data = SessionRegistration::all();
            $session = Session::all();
            return view('session_registrations.instructor_index',compact('data','session'));
        }

        else if ($this->is_student()){
            //halaman yang menampilkan detail jadwal yang di tentukan
            // oleh instructor kepada student nusia
            /*
            $arr = [];
            if($course_type == 'Free Trial') {
                $course_registrations = CourseRegistration
                    ::join('courses', 'course_registrations.course_id', 'courses.id')
                    ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                    ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    ->where('student_id', Auth::user()->student->id)
                    ->where('course_types.name', 'LIKE', '%Trial%')
                    ->select('course_registrations.id')
                    ->get();
                foreach($course_registrations as $cr) {
                    array_push($arr, $cr->id);
                }
            } else if($course_type == 'Private') {
                $course_registrations = CourseRegistration
                    ::join('courses', 'course_registrations.course_id', 'courses.id')
                    ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                    ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    ->where('student_id', Auth::user()->student->id)
                    ->where('course_types.count_student_min', 1)
                    ->where('course_types.count_student_max', 1)
                    ->select('course_registrations.id')
                    ->get();
                foreach($course_registrations as $cr) {
                    array_push($arr, $cr->id);
                }
            } else if($course_type == 'Group') {
                $course_registrations = CourseRegistration
                    ::join('courses', 'course_registrations.course_id', 'courses.id')
                    ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                    ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    ->where('student_id', Auth::user()->student->id)
                    ->where('course_types.count_student_max', '<>', 1)
                    ->select('course_registrations.id')
                    ->get();
                foreach($course_registrations as $cr) {
                    array_push($arr, $cr->id);
                }
            } else {
                return redirect()->route('home');
            }

            $data = SessionRegistration
                ::whereIn('course_registration_id', $arr)
                ->get();

            return view('session_registrations.student_index',compact('data'));
            */

            $timeStudent = Carbon::now(Auth::user()->timezone);

            $data = SessionRegistration
                ::join('course_registrations', 'session_registrations.course_registration_id', 'course_registrations.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->select('session_registrations.code', 'session_registrations.session_id', 'session_registrations.course_registration_id', 'session_registrations.registration_time', 'session_registrations.status', 'session_registrations.created_at', 'session_registrations.updated_at')
                ->get();
            return view('session_registrations.student_index',compact('data', 'timeStudent'));
        } else {
            return redirect()->route('home');
        }

        //$data = SessionRegistration::all();
        //return view('registrations.sessions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($this->is_admin()){
            $session = Session::all();
            $course_registration = CourseRegistration::all();
            return view('session_registrations.admin_create', compact('session', 'course_registration'));
        }
        /*
        if($this->is_admin()) {
            return view('registrations.sessions.create');
        } else {
            // Tidak memiliki hak akses.
        }
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->is_admin()) {
            SessionRegistration::create([
                'session_id' => $request->session_id,
                'course_registration_id' => $request->course_id,
            ]);
        }

        if($this->is_student()) {
            CourseRegistration::create([
                'course_id' => $request->course_id,
                'student_id' => $request->student_id
            ]);

            $temp = CourseRegistration::all()->last();

            SessionRegistration::create([
                'session_id' => $request->session_id,
                'course_registration_id' => $temp->id,
            ]);

            return redirect()->route('session_registrations.index',[1] );
        }

        /*
        $data = $request->all();
        $data = Validator::make($data, [
            'session_id' => [
                'bail', 'required',
                Rule::unique('session_registrations', 'session_id')
                    ->where('course_registration_id', $request->course_registration_id)
            ],
            'course_registration_id' => [
                'bail', 'required',
                Rule::unique('session_registrations', 'course_registration_id')
                    ->where('session_id', $request->session_id)
            ],
            'registration_time' => ['bail', 'sometimes', 'date'],
            'status' => ['bail', 'required']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin() || $this->is_student()) {
            SessionRegistration::create([
                'session_id' => $request->session_id,
                'course_registration_id' => $request->course_registration_id,
                'registration_time' => $request->registration_time,
                'status' => $request->status
            ]);
        } else {
            // Tidak memiliki hak akses.
        }
        */
        \Session::flash('store_student','Success Save Data');
        return redirect()->route('session_registrations.index',[1] );
    }

    public function show($a, $b)
    {
        if ($this->is_instructor()){
            return view('session_registrations.instructor_show');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->is_admin()) {
            $data = SessionRegistration::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('registrations.sessions.edit', compact('data'));
        } else {
            // Tidak memiliki hak akses.
        }
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
        $session_registration = SessionRegistration::findOrFail($id);
        if($session_registration == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'session_id' => [
                'bail', 'required',
                Rule::unique('session_registrations', 'session_id')
                    ->ignore($id, 'id')
                    ->where('course_registration_id', $request->course_registration_id)
            ],
            'course_registration_id' => [
                'bail', 'required',
                Rule::unique('session_registrations', 'course_registration_id')
                    ->ignore($id, 'id')
                    ->where('session_id', $request->session_id)
            ],
            'registration_time' => ['bail', 'sometimes', 'date'],
            'status' => ['bail', 'required']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin() || $this->is_instructor()) {
            $session_registration->update([
                'session_id' => $request->session_id,
                'course_registration_id' => $request->course_registration_id,
                'registration_time' => $request->registration_time,
                'status' => $request->status
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = SessionRegistration::all();
        return view('registrations.sessions.index', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SessionRegistration::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $data = SessionRegistration::all();
        return view('registrations.sessions.index', compact('data'));
    }
}
