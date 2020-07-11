<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Session;
use App\Models\SessionRegistration;
use App\Models\MaterialSession;
use App\Models\Rating;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class Session extends Controller
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
        if($this->is_admin()) {
            $sessions = Session::all()
                ->join('schedules', 'sessions.schedule_id', '=', 'schedules.id')
                ->join('instructors', 'schedules.instructor_id', '=', 'instructors.id')
                ->join('users', 'instructors.user_id', '=', 'users.id')
                ->join('courses', 'sessions.course_id', '=', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', '=', 'course_packages.id')
                ->distinct()
                ->select(
                    'users.first_name',
                    'users.last_name',
                    'courses.title',
                    'course_packages.title',
                    'schedules.schedule_time',
                    'title',
                    'description',
                    'link_zoom'
                )->paginate(10);

            return view('sessions.index', compact(
                'sessions'
            ));
        } else if($this->is_instructor() || $this->is_student()) {
            $sessions = Session::all()
                ->join('schedules', 'sessions.schedule_id', '=', 'schedules.id')
                ->join('courses', 'sessions.course_id', '=', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', '=', 'course_packages.id')
                ->distinct()
                ->select(
                    'courses.title',
                    'course_packages.title',
                    'schedules.schedule_time',
                    'title',
                    'description',
                    'link_zoom'
                )->paginate(10);

            return view('sessions.index', compact(
                'sessions'
            ));
        } else {
            // Tidak memiliki hak akses.
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
            return view('sessions.create');
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

        $validator = Validator::make($data, [
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

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat slug baru.
        $slug = "";
        while(1) {
            $slug = Str::random(255);
            $session = Session::firstWhere('slug', $slug);
            if($session === null) break;
        }

        if($this->is_admin() || $this->is_instructor()) {
            Session::create([
                'slug' => $slug,
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
            $sessions = Session::all()
                ->join('schedules', 'sessions.schedule_id', '=', 'schedules.id')
                ->join('instructors', 'schedules.instructor_id', '=', 'instructors.id')
                ->join('users', 'instructors.user_id', '=', 'users.id')
                ->join('courses', 'sessions.course_id', '=', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', '=', 'course_packages.id')
                ->distinct()
                ->select(
                    'users.first_name',
                    'users.last_name',
                    'courses.title',
                    'course_packages.title',
                    'schedules.schedule_time',
                    'title',
                    'description',
                    'link_zoom'
                )->paginate(10);

            return view('sessions.index', compact(
                'sessions'
            ));
        } else if($this->is_instructor() || $this->is_student()) {
            $sessions = Session::all()
                ->join('schedules', 'sessions.schedule_id', '=', 'schedules.id')
                ->join('courses', 'sessions.course_id', '=', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', '=', 'course_packages.id')
                ->distinct()
                ->select(
                    'courses.title',
                    'course_packages.title',
                    'schedules.schedule_time',
                    'title',
                    'description',
                    'link_zoom'
                )->paginate(10);

            return view('sessions.index', compact(
                'sessions'
            ));
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
        $session = Session::firstOrFail($id);
        if($session == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin()) {
            $slug = $session->slug;
            $schedule = $session->schedule();

            $user = $schedule->instructor()->user();
            $user_name = $user->first_name.' '.$user->last_name;

            $course_title = ($session->course()->title != null)?
                $session->course()->title : $session->course()->course_package()->title;

            $schedule_time = $schedule->schedule_time;
            $title = $session->title;
            $description = $session->description;
            $requirement = $session->requirement;
            $link_zoom = $session->link_zoom;

            return view('sessions.show', compact(
                'slug', 'user_name', 'course_title', 'schedule_time',
                'title', 'description', 'requirement', 'link_zoom'
            ));
        } else if($this->is_instructor() || $this->is_student()) {
            $slug = $session->slug;

            $course_title = ($session->course()->title != null)?
                $session->course()->title : $session->course()->course_package()->title;

            $schedule_time = $session->schedule()->schedule_time;
            $title = $session->title;
            $description = $session->description;
            $requirement = $session->requirement;
            $link_zoom = $session->link_zoom;

            return view('sessions.show', compact(
                'slug', 'course_title', 'schedule_time',
                'title', 'description', 'requirement', 'link_zoom'
            ));
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
        $session = Session::firstOrFail($id);
        if($session == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin()) {
            $slug = $session->slug;
            $schedule = $session->schedule();

            $user = $schedule->instructor()->user();
            $user_name = $user->first_name.' '.$user->last_name;

            $course_title = ($session->course()->title != null)?
                $session->course()->title : $session->course()->course_package()->title;

            $schedule_time = $schedule->schedule_time;
            $title = $session->title;
            $description = $session->description;
            $requirement = $session->requirement;
            $link_zoom = $session->link_zoom;

            return view('sessions.edit', compact(
                'slug', 'user_name', 'course_title', 'schedule_time',
                'title', 'description', 'requirement', 'link_zoom'
            ));
        } else if($this->is_instructor() || $this->is_student()) {
            $slug = $session->slug;

            $course_title = ($session->course()->title != null)?
                $session->course()->title : $session->course()->course_package()->title;

            $schedule_time = $session->schedule()->schedule_time;
            $title = $session->title;
            $description = $session->description;
            $requirement = $session->requirement;
            $link_zoom = $session->link_zoom;

            return view('sessions.edit', compact(
                'slug', 'course_title', 'schedule_time',
                'title', 'description', 'requirement', 'link_zoom'
            ));
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
        $session = Session::firstOrFail($id);
        if($session == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();

        $validator = Validator::make($data, [
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

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
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
            $slug = $session->slug;
            $schedule = $session->schedule();

            $user = $schedule->instructor()->user();
            $user_name = $user->first_name.' '.$user->last_name;

            $course_title = ($session->course()->title != null)?
                $session->course()->title : $session->course()->course_package()->title;

            $schedule_time = $schedule->schedule_time;
            $title = $session->title;
            $description = $session->description;
            $requirement = $session->requirement;
            $link_zoom = $session->link_zoom;

            return view('sessions.show', compact(
                'slug', 'user_name', 'course_title', 'schedule_time',
                'title', 'description', 'requirement', 'link_zoom'
            ));
        } else if($this->is_instructor() || $this->is_student()) {
            $slug = $session->slug;

            $course_title = ($session->course()->title != null)?
                $session->course()->title : $session->course()->course_package()->title;

            $schedule_time = $session->schedule()->schedule_time;
            $title = $session->title;
            $description = $session->description;
            $requirement = $session->requirement;
            $link_zoom = $session->link_zoom;

            return view('sessions.show', compact(
                'slug', 'course_title', 'schedule_time',
                'title', 'description', 'requirement', 'link_zoom'
            ));
        } else {
            // Tidak memiliki hak akses.
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Session::firstOrFail($id);
        if($session == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $session_registration = SessionRegistration::firstWhere('session_id', $id);
        if($session_registration != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        $material_session = MaterialSession::firstWhere('session_id', $id);
        if($material_session != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        $rating = Rating::firstWhere('session_id', $id);
        if($rating != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($this->is_admin()) {
            $session->delete();
        } else if($this->is_instructor()) {
            // Melakukan request ke Admin.
        } else {
            // Tidak memiliki hak akses.
        }

        if($this->is_admin()) {
            $sessions = Session::all()
                ->join('schedules', 'sessions.schedule_id', '=', 'schedules.id')
                ->join('instructors', 'schedules.instructor_id', '=', 'instructors.id')
                ->join('users', 'instructors.user_id', '=', 'users.id')
                ->join('courses', 'sessions.course_id', '=', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', '=', 'course_packages.id')
                ->distinct()
                ->select(
                    'users.first_name',
                    'users.last_name',
                    'courses.title',
                    'course_packages.title',
                    'schedules.schedule_time',
                    'title',
                    'description',
                    'link_zoom'
                )->paginate(10);

            return view('sessions.index', compact(
                'sessions'
            ));
        } else if($this->is_instructor() || $this->is_student()) {
            $sessions = Session::all()
                ->join('schedules', 'sessions.schedule_id', '=', 'schedules.id')
                ->join('courses', 'sessions.course_id', '=', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', '=', 'course_packages.id')
                ->distinct()
                ->select(
                    'courses.title',
                    'course_packages.title',
                    'schedules.schedule_time',
                    'title',
                    'description',
                    'link_zoom'
                )->paginate(10);

            return view('sessions.index', compact(
                'sessions'
            ));
        } else {
            // Tidak memiliki hak akses.
        }
    }
}
