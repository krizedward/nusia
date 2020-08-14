<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MaterialPublic;
use App\Models\MaterialSession;
use App\Models\CoursePackage;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\CourseRegistration;
use App\Models\Session;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
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

    public function index()
    {
        if ($this->is_admin()){
            $public = MaterialPublic::all();
            $session = MaterialSession::all();
            return view('materials.admin_index',compact('public','session'));
        }

        else if ($this->is_student()){
            $course_registrations = CourseRegistration::where('student_id', Auth::user()->student->id)->get();

            $arr = [];
            foreach($course_registrations as $course_registration) {
                $mps = MaterialPublic::where('course_package_id', $course_registration->course->course_package_id)->get();
                foreach($mps as $mp) {
                    array_push($arr, $mp->id);
                    array_unique($arr);
                }
            }
            $mps_free_trial = MaterialPublic
                ::join('course_packages', 'material_publics.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_publics.id', $arr)
                ->where('course_types.name', 'LIKE', '%Trial%')
                ->select('material_publics.id as id')
                ->get();
            $mps_private = MaterialPublic
                ::join('course_packages', 'material_publics.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_publics.id', $arr)
                ->where('course_types.count_student_min', 1)
                ->where('course_types.count_student_max', 1)
                ->select('material_publics.id as id')
                ->get();
            $mps_group = MaterialPublic
                ::join('course_packages', 'material_publics.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_publics.id', $arr)
                ->where('course_types.count_student_max', '<>', 1)
                ->select('material_publics.id as id')
                ->get();

            $arr = [];
            foreach($course_registrations as $course_registration) {
                $mss = MaterialSession
                    ::join('sessions', 'material_sessions.session_id', 'sessions.id')
                    ->where('sessions.course_id', $course_registration->course_id)
                    ->get();
                foreach($mss as $ms) {
                    array_push($arr, $ms->id);
                    array_unique($arr);
                }
            }
            $mss_free_trial = MaterialSession
                ::join('sessions', 'material_sessions.session_id', 'sessions.id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_sessions.id', $arr)
                ->where('course_types.name', 'LIKE', '%Trial%')
                ->select('material_sessions.id as id')
                ->get();
            $mss_private = MaterialSession
                ::join('sessions', 'material_sessions.session_id', 'sessions.id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_sessions.id', $arr)
                ->where('course_types.count_student_min', 1)
                ->where('course_types.count_student_max', 1)
                ->select('material_sessions.id as id')
                ->get();
            $mss_group = MaterialSession
                ::join('sessions', 'material_sessions.session_id', 'sessions.id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_sessions.id', $arr)
                ->where('course_types.count_student_max', '<>', 1)
                ->select('material_sessions.id as id')
                ->get();

            return view('materials.student_index', compact(
                'course_registrations',
                'mps_free_trial', 'mps_private', 'mps_group',
                'mss_free_trial', 'mss_private', 'mss_group'
            ));
        }

        else if ($this->is_instructor()){
            //return view('materials.instructor_index');

            $sessions = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('instructors', 'schedules.instructor_id', 'instructors.id')
                ->where('instructor_id', Auth::user()->instructor->id)->get();

            $arr = [];
            foreach($sessions as $session) {
                $mps = MaterialPublic::where('course_package_id', $session->course->course_package_id)->get();
                foreach($mps as $mp) {
                    array_push($arr, $mp->id);
                    array_unique($arr);
                }
            }
            $mps_free_trial = MaterialPublic
                ::join('course_packages', 'material_publics.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_publics.id', $arr)
                ->where('course_types.name', 'LIKE', '%Trial%')
                ->select('material_publics.id as id')
                ->get();
            $mps_private = MaterialPublic
                ::join('course_packages', 'material_publics.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_publics.id', $arr)
                ->where('course_types.count_student_min', 1)
                ->where('course_types.count_student_max', 1)
                ->select('material_publics.id as id')
                ->get();
            $mps_group = MaterialPublic
                ::join('course_packages', 'material_publics.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_publics.id', $arr)
                ->where('course_types.count_student_max', '<>', 1)
                ->select('material_publics.id as id')
                ->get();

            $arr = [];
            foreach($sessions as $session) {
                $mss = MaterialSession::where('material_sessions.session_id', $session->id)->get();
                foreach($mss as $ms) {
                    array_push($arr, $ms->id);
                    array_unique($arr);
                }
            }
            $mss_free_trial = MaterialSession
                ::join('sessions', 'material_sessions.session_id', 'sessions.id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_sessions.id', $arr)
                ->where('course_types.name', 'LIKE', '%Trial%')
                ->select('material_sessions.id as id')
                ->get();
            $mss_private = MaterialSession
                ::join('sessions', 'material_sessions.session_id', 'sessions.id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_sessions.id', $arr)
                ->where('course_types.count_student_min', 1)
                ->where('course_types.count_student_max', 1)
                ->select('material_sessions.id as id')
                ->get();
            $mss_group = MaterialSession
                ::join('sessions', 'material_sessions.session_id', 'sessions.id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                ->distinct()
                ->whereIn('material_sessions.id', $arr)
                ->where('course_types.count_student_max', '<>', 1)
                ->select('material_sessions.id as id')
                ->get();

            return view('materials.instructor_index', compact(
                'sessions',
                'mps_free_trial', 'mps_private', 'mps_group',
                'mss_free_trial', 'mss_private', 'mss_group'
            ));
        } else {
                return redirect('/');
        }
    }

    public function private_index()
    {
        /*$material_publics = MaterialPublic
            ::join('course_packages', 'material_publics.course_package_id', 'course_packages.id')
            ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
            ->distinct()
            ->where('course_types.count_student_min', 1)
            ->where('course_types.count_student_max', 1)
            ->select('material_publics.id', 'material_publics.code', 'material_publics.name', 'material_publics.description', 'material_publics.path', 'course_packages.title as course_package_title', 'courses.id as course_id')
            ->get();
        $material_sessions = MaterialSession
            ::join('sessions', 'material_sessions.session_id', 'sessions.id')
            ->join('courses', 'sessions.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
            ->distinct()
            ->where('course_types.count_student_min', 1)
            ->where('course_types.count_student_max', 1)
            ->select('material_sessions.id', 'material_sessions.code', 'material_sessions.name', 'material_sessions.description', 'material_sessions.path', 'courses.id as course_id', 'sessions.title as session_title', 'courses.title as course_title', 'course_packages.title as course_package_title')
            ->get();*/

        if($this->is_admin()) {
            return view('materials.admin_private_index', compact('material_publics', 'material_sessions'));
        } else if($this->is_instructor()) {
            return view('materials.instructor_private_index', compact('material_publics', 'material_sessions'));
        } else if($this->is_student()) {
            $course_registrations = CourseRegistration::where('student_id', Auth::user()->student->id)->get();
            $arr = [];
            foreach($course_registrations as $course_registration) {
                $mps = MaterialPublic::where('course_package_id', $course_registration->course->course_package_id)->get();
                foreach($mps as $mp) {
                    /*$mp->update([
                        'temp_flag' => 1,
                    ]);*/
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
                ->select('material_publics.id', 'material_publics.code', 'material_publics.name', 'material_publics.description', 'material_publics.path', 'course_packages.title as course_package_title')
                ->get();
            // ambil atribut course_registrations.courses.title dst.

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
                ->select('material_sessions.id', 'material_sessions.code', 'material_sessions.name', 'material_sessions.description', 'material_sessions.path', 'courses.id as course_id', 'sessions.title as session_title', 'courses.title as course_title', 'course_packages.title as course_package_title')
                ->get();

            return view('materials.student_private_index', compact('material_publics', 'material_sessions'));
        } else {
            return redirect('/');
        }
    }

    public function free_trial_index()
    {
        $material_publics = MaterialPublic
            ::join('course_packages', 'material_publics.course_package_id', 'course_packages.id')
            ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
            ->distinct()
            ->where('course_types.name', 'LIKE', '%Trial%')
            ->select('material_publics.id', 'material_publics.code', 'material_publics.name', 'material_publics.description', 'material_publics.path', 'course_packages.title as course_package_title')
            ->get();
        $material_sessions = MaterialSession
            ::join('sessions', 'material_sessions.session_id', 'sessions.id')
            ->join('courses', 'sessions.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
            ->distinct()
            ->where('course_types.name', 'LIKE', '%Trial%')
            ->select('material_sessions.id', 'material_sessions.code', 'material_sessions.name', 'material_sessions.description', 'material_sessions.path', 'courses.id as course_id', 'sessions.title as session_title', 'courses.title as course_title', 'course_packages.title as course_package_title')
            ->get();

        if($this->is_admin()) {
            return view('materials.admin_free_trial_index', compact('material_publics', 'material_sessions'));
        } else if($this->is_instructor()) {
            return view('materials.instructor_free_trial_index', compact('material_publics', 'material_sessions'));
        } else if($this->is_student()) {
            return view('materials.student_free_trial_index', compact('material_publics', 'material_sessions'));
        } else {
            return redirect('/');
        }
    }

    public function group_index()
    {
        $material_publics = MaterialPublic
            ::join('course_packages', 'material_publics.course_package_id', 'course_packages.id')
            ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
            ->distinct()
            ->where('course_types.count_student_max', '<>', 1)
            ->select('material_publics.id', 'material_publics.code', 'material_publics.name', 'material_publics.description', 'material_publics.path', 'course_packages.title as course_package_title')
            ->get();
        $material_sessions = MaterialSession
            ::join('sessions', 'material_sessions.session_id', 'sessions.id')
            ->join('courses', 'sessions.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
            ->distinct()
            ->where('course_types.count_student_max', '<>', 1)
            ->select('material_sessions.id', 'material_sessions.code', 'material_sessions.name', 'material_sessions.description', 'material_sessions.path', 'courses.id as course_id', 'sessions.title as session_title', 'courses.title as course_title', 'course_packages.title as course_package_title')
            ->get();

        if($this->is_admin()) {
            return view('materials.admin_group_index', compact('material_publics', 'material_sessions'));
        } else if($this->is_instructor()) {
            return view('materials.instructor_group_index', compact('material_publics', 'material_sessions'));
        } else if($this->is_student()) {
            return view('materials.student_group_index', compact('material_publics', 'material_sessions'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin() || $this->is_instructor()) {

            return view('materials.create');
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
            'session_id' => ['bail', 'required'],
            'name' => ['bail', 'required', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'path' => ['bail', 'sometimes', 'max:1000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        // Membuat slug baru.
        $data = "";
        while(1) {
            $data = Str::random(255);
            if(MaterialSession::where('slug', $data)->first() === null) break;
        }

        if($this->is_admin() || $this->is_instructor()) {
            MaterialSession::create([
                'slug' => $data,
                'session_id' => $request->session_id,
                'name' => $request->name,
                'description' => $request->description,
                'path' => $request->path
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = MaterialSession::all();
        return view('materials.sessions.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MaterialSession::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }
        return view('materials.sessions.show', compact('data'));
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
            $data = MaterialSession::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('materials.sessions.edit', compact('data'));
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
        $material_session = MaterialSession::findOrFail($id);
        if($material_session == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'session_id' => ['bail', 'required'],
            'name' => ['bail', 'required', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'path' => ['bail', 'sometimes', 'max:1000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin() || $this->is_instructor()) {
            $material_session->update([
                'session_id' => $request->session_id,
                'name' => $request->name,
                'description' => $request->description,
                'path' => $request->path
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = $material_session;
        return view('materials.sessions.show', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MaterialSession::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin() || $this->is_instructor()) {
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $data = MaterialSession::all();
        return view('materials.sessions.index', compact('data'));
    }

    /**
     * Dowload a material from storage.
     */
    public function download($public_or_session = 'Public', $id)
    {
        if($public_or_session == 'Public') {
            $data = MaterialPublic::find($id);
        } else if($public_or_session == 'Session') {
            $data = MaterialSession::find($id);
        }

        $path = public_path().'/uploads/material/'.$data->path;

        if($this->is_admin()) {
            //
        } else if($this->is_instructor()) {
            //
        } else if($this->is_student()) {
            return response()->download($path, $data->path);
        } else {
            //
        }
        return view('materials.sessions.index', compact('data'));
    }
}
