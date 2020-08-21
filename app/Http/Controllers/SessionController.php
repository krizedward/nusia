<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Schedule;
use App\Models\SessionRegistration;
use Illuminate\Http\Request;

use App\Models\Session;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
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
    public function index()
    {
        if ($this->is_admin()){
            $data = Session::all();
            return view('sessions.admin_index',compact('data'));
        }

        if ($this->is_instructor()){
            $data = SessionRegistration
                ::join('course_registrations', 'session_registrations.course_registration_id', 'course_registrations.id')
                ->where('course_registrations.student_id', Auth::user()->instructor->id)
                ->select('session_registrations.code', 'session_registrations.session_id', 'session_registrations.course_registration_id', 'session_registrations.registration_time', 'session_registrations.status', 'session_registrations.created_at', 'session_registrations.updated_at')
                ->get();
            return view('sessions.instructor_index', compact('data'));
        }

        if ($this->is_student()){
            $session = Session::all();
            return view('sessions.student_index', compact('session'));
        }

        /*
        if($this->is_admin()) {
            $data = Session::all();
            return view('sessions.index', compact('data'));
        } else if($this->is_instructor() || $this->is_student()) {
            $data = Session::all();
            return view('sessions.index', compact('data'));
        } else {
            // Tidak memiliki hak akses.
        }
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin()) {
            $course = Course::all();
            $schedule = Schedule::all();
            return view('sessions.admin_create', compact('course','schedule'));
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
        if($this->is_admin()) {
            Session::create([
                'course_id' => $request->course,
                'schedule_id' => $request->schedule,
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }
        /*
        $data = $request->all();
        $data = Validator::make($data, [
            'course_id' => ['bail', 'required'],
            'schedule_id' => [
                'bail', 'required',
                Rule::unique('sessions', 'schedule_id')
            ],
            'title' => ['bail', 'sometimes', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'requirement' => ['bail', 'sometimes', 'max:5000'],
            'link_zoom' => ['bail', 'sometimes', 'max:1000']
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
            if(Session::where('slug', $data)->first() === null) break;
        }

        if($this->is_admin() || $this->is_instructor()) {
            Session::create([
                'slug' => $data,
                'course_id' => $request->course_id,
                'schedule_id' => $request->schedule_id,
                'title' => $request->title,
                'description' => $request->description,
                'requirement' => $request->requirement,
                'link_zoom' => $request->link_zoom
            ]);
        } else {
            // Tidak memiliki hak akses.
        }
        */
        if($this->is_admin()) {
            //$data = Session::all();
            //return view('sessions.index', compact('data'));
            \Session::flash('store_student','Success Save Data');
            return redirect()->route('sessions.index');
        } else if($this->is_instructor() || $this->is_student()) {
            $data = Session::all();
            return view('sessions.index', compact('data'));
        } else {
            // Tidak memiliki hak akses.
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Session::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin()) {
            return view('sessions.show', compact('data'));
        } else if($this->is_instructor() || $this->is_student()) {
            return view('sessions.show', compact('data'));
        } else {
            // Tidak memiliki hak akses.
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
        $data = Session::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin()) {
            return view('sessions.edit', compact('data'));
        } else if($this->is_instructor() || $this->is_student()) {
            return view('sessions.edit', compact('data'));
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
        $session = Session::findOrFail($id);

        if($this->is_instructor()) {
            /*
            $session->update([
                'link_zoom' => 'new link',
            ]);*/

            Session::where('id',$request->session_registration)->update([
                'link_zoom' => $request->link_zoom,
            ]);

            return redirect()->route('session_registrations.index');
        }

        /*
        $session = Session::findOrFail($id);
        if($session == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'course_id' => ['bail', 'required'],
            'schedule_id' => [
                'bail', 'required',
                Rule::unique('sessions', 'schedule_id')->ignore($id, 'id')
            ],
            'title' => ['bail', 'sometimes', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'requirement' => ['bail', 'sometimes', 'max:5000'],
            'link_zoom' => ['bail', 'sometimes', 'max:1000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin() || $this->is_instructor()) {
            $session->update([
                'course_id' => $request->course_id,
                'schedule_id' => $request->schedule_id,
                'title' => $request->title,
                'description' => $request->description,
                'requirement' => $request->requirement,
                'link_zoom' => $request->link_zoom
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        if($this->is_admin()) {
            return view('sessions.show', compact('data'));
        } else if($this->is_instructor() || $this->is_student()) {
            return view('sessions.show', compact('data'));
        } else {
            // Tidak memiliki hak akses.
        }
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Session::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($data->session_registrations() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($data->material_sessions() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($data->ratings() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else if($this->is_instructor()) {
            // Melakukan request ke Admin.
        } else {
            // Tidak memiliki hak akses.
        }

        if($this->is_admin()) {
            $data = Session::all();
            return view('sessions.index', compact('data'));
        } else if($this->is_instructor() || $this->is_student()) {
            $data = Session::all();
            return view('sessions.index', compact('data'));
        } else {
            // Tidak memiliki hak akses.
        }
    }

    /**
     * Custom Link By Edward
     */
    public function private()
    {
        if ($this->is_student()) {
            $data = Session::all();
            return view('sessions.student.private', compact('data'));
        } else if ($this->is_instructor()) {
            $data = Session::all();
            return view('sessions.instructor.private', compact('data'));
        }
    }

    public function group()
    {
        if ($this->is_student()) {
            $data = Session::all();
            return view('sessions.student.group', compact('data'));
        } else if ($this->is_instructor()) {
            $data = Session::all();
            return view('sessions.instructor.group', compact('data'));
        }
    }
}
