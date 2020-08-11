<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;
use App\Models\CourseRegistration;
use App\Models\Course;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
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
            return view('schedules.admin_index');
        }

        if ($this->is_instructor()) {
          return view('schedules.instructor_index');
        }

        if ($this->is_student()){
            //halaman yang menampilkan kelompok jadwal yang di tentukan
            // oleh instructor kepada student nusia

            if($course_type == 'Free Trial') {
                $course_registrations = CourseRegistration::where('student_id', Auth::user()->student->id)->get();
                //dd($course_registrations);

                $courses = Course
                    ::join('course_packages', 'courses.course_package_id', 'course_packages.id')
                    ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    ->distinct()
                    ->where('course_types.name', 'LIKE', '%Trial%')
                    ->select('courses.id')
                    ->get();
                //dd($courses);

                $arr = [];
                foreach($course_registrations as $course_registration) {
                    foreach($courses as $course) {
                        if($course_registration->course_id == $course->id) {
                            array_push($arr, $course_registration->course_id);
                            array_unique($arr);
                            break;
                        }
                    }
                }
                $course_registrations = $course_registrations->whereIn('course_id', $arr);
                //dd($course_registrations);

                return view('schedules.student_index', compact('course_registrations'));
            } else if($course_type == 'Private') {
                $course_registrations = CourseRegistration::where('student_id', Auth::user()->student->id)->get();
                //dd($course_registrations);

                $arr = [];
                foreach($course_registrations as $course_registration) {
                    $mps = MaterialPublic::where('course_package_id', $course_registration->course->course_package_id)->get();
                    foreach($mps as $mp) {
                        array_push($arr, $mp->id);
                    }
                }
                $material_publics = MaterialPublic
                    ::join('course_packages', 'material_publics.course_package_id', 'course_packages.id')
                    ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    ->distinct()
                    ->whereIn('material_publics.id', $arr)
                    ->where('course_types.count_student_min', 1)
                    ->where('course_types.count_student_max', 1)
                    ->select('material_publics.id')
                    ->get();
                //dd($material_publics);

                $arr = [];
                foreach($course_registrations as $course_registration) {
                    $mss = MaterialSession
                        ::join('sessions', 'material_sessions.session_id', 'sessions.id')
                        ->where('sessions.course_id', $course_registration->course_id)
                        ->get();
                    foreach($mss as $ms) {
                        array_push($arr, $ms->id);
                    }
                }
                $material_sessions = MaterialSession
                    ::join('sessions', 'material_sessions.session_id', 'sessions.id')
                    ->join('courses', 'sessions.course_id', 'courses.id')
                    ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                    ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    ->distinct()
                    ->whereIn('material_sessions.id', $arr)
                    ->where('course_types.count_student_min', 1)
                    ->where('course_types.count_student_max', 1)
                    ->select('material_sessions.id')
                    ->get();
                //dd($material_sessions);

                return view('schedules.student_index', compact('course_registrations'));
            } else if($course_type == 'Group') {
                $course_registrations = CourseRegistration::where('student_id', Auth::user()->student->id)->get();
                //dd($course_registrations);

                $arr = [];
                foreach($course_registrations as $course_registration) {
                    $mps = MaterialPublic::where('course_package_id', $course_registration->course->course_package_id)->get();
                    foreach($mps as $mp) {
                        array_push($arr, $mp->id);
                    }
                }
                $material_publics = MaterialPublic
                    ::join('course_packages', 'material_publics.course_package_id', 'course_packages.id')
                    ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    ->distinct()
                    ->whereIn('material_publics.id', $arr)
                    ->where('course_types.count_student_max', '<>', 1)
                    ->select('material_publics.id')
                    ->get();
                //dd($material_publics);

                $arr = [];
                foreach($course_registrations as $course_registration) {
                    $mss = MaterialSession
                        ::join('sessions', 'material_sessions.session_id', 'sessions.id')
                        ->where('sessions.course_id', $course_registration->course_id)
                        ->get();
                    foreach($mss as $ms) {
                        array_push($arr, $ms->id);
                    }
                }
                $material_sessions = MaterialSession
                    ::join('sessions', 'material_sessions.session_id', 'sessions.id')
                    ->join('courses', 'sessions.course_id', 'courses.id')
                    ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                    ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    ->distinct()
                    ->whereIn('material_sessions.id', $arr)
                    ->where('course_types.count_student_max', '<>', 1)
                    ->select('material_sessions.id')
                    ->get();
                //dd($material_sessions);

                return view('schedules.student_index', compact('course_registrations'));
            } else {
                return redirect('/');
            }

            $course_registrations = CourseRegistration::where('student_id', Auth::user()->student->id)->get();
            return view('schedules.student_index', compact('course_registrations'));
        }
        //$data = Schedule::all();
        //return view('schedules.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin()) {
            return view('schedules.create');
        } else {
            // Tidak memiliki hak akses.
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data = Validator::make($data, [
            'instructor_id' => ['bail', 'required'],
            'schedule_time' => [
                'bail', 'sometimes', 'date',
                Rule::unique('schedules', 'schedule_time')
                    ->where('instructor_id', $request->instructor_id)
            ],
            'status' => ['bail', 'required']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin() || $this->is_instructor()) {
            Schedule::create([
                'instructor_id' => $request->instructor_id,
                'schedule_time' => $request->schedule_time,
                'status' => $request->status
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = Schedule::all();
        return view('schedules.index', compact('data'));
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
            $data = Schedule::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('schedules.edit', compact('data'));
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
        $schedule = Schedule::findOrFail($id);
        if($schedule == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'instructor_id' => ['bail', 'required'],
            'schedule_time' => [
                'bail', 'sometimes', 'date',
                Rule::unique('schedules', 'schedule_time')
                    ->ignore($id, 'id')
                    ->where('instructor_id', $request->instructor_id)
            ],
            'status' => ['bail', 'required']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin()) {
            $session_registration->update([
                'session_id' => $request->session_id,
                'course_registration_id' => $request->course_registration_id,
                'registration_time' => $request->registration_time,
                'status' => $request->status
            ]);
        } else if($this->is_instructor()) {
            // Melakukan request ke Admin.
        } else {
            // Tidak memiliki hak akses.
        }

        $data = Schedule::all();
        return view('schedules.index', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Schedule::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($data->session() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $data = Schedule::all();
        return view('schedules.index', compact('data'));
    }

    /**
     * Custom Link By Edward
     */
    public function private()
    {
        if ($this->is_student()) {
            $data = Schedule::all();
            return view('schedules.students.private', compact('data'));
        } else if ($this->is_instructor()) {
            $data = Schedule::all();
            return view('schedules.instructor.private', compact('data'));
        }
    }

    public function group()
    {
        if ($this->is_student()) {
            $data = Schedule::all();
            return view('schedules.students.group', compact('data'));
        } else if ($this->is_instructor()) {
            $data = Schedule::all();
            return view('schedules.instructor.group', compact('data'));
        }
    }
}
