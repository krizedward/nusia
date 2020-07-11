<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Session;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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
        $courses = Course::all()
            ->join('course_packages', 'course_package_id', '=', 'course_packages.id')
            ->select(
                'slug',
                'course_packages.title',
                'title',
                'description'
            )->paginate(10);
        return view('courses.index', compact(
            'courses'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin() || $this->is_instructor()) {
            return view('courses.create');
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
            'course_package_id' => ['bail', 'required'],
            'title' => ['bail', 'sometimes', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'requirement' => ['bail', 'sometimes', 'max:5000']
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
            $course = Course::firstWhere('slug', $slug);
            if($course === null) break;
        }

        if($this->is_admin() || $this->is_instructor()) {
            Course::create([
                'slug' => $slug,
                'course_package_id' => $request->course_package_id,
                'title' => $request->title,
                'description' => $request->description,
                'requirement' => $request->requirement
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $courses = Course::all()
            ->join('course_packages', 'course_package_id', '=', 'course_packages.id')
            ->select(
                'slug',
                'course_packages.title',
                'title',
                'description'
            )->paginate(10);
        return view('courses.index', compact(
            'courses'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::firstOrFail($id);
        if($course == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $slug = $course->slug;
        $course_package_slug = $course->course_package->slug;
        $course_package_title = $course->course_package->title;
        $title = $course->title;
        $description = $course->description;
        $requirement = $course->requirement;

        return view('courses.show', compact(
            'slug', 'course_package_slug', 'course_package_title',
            'title', 'description', 'requirement'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->is_admin() || $this->is_instructor()) {
            $course = Course::firstOrFail($id);
            if($course == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }

            $slug = $course->slug;
            $course_package_slug = $course->course_package->slug;
            $course_package_title = $course->course_package->title;
            $title = $course->title;
            $description = $course->description;
            $requirement = $course->requirement;

            return view('courses.edit', compact(
                'slug', 'course_package_slug', 'course_package_title',
                'title', 'description', 'requirement'
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
        $course = Course::firstOrFail($id);
        if($course == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'course_package_id' => ['bail', 'required'],
            'title' => ['bail', 'sometimes', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'requirement' => ['bail', 'sometimes', 'max:5000']
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if($this->is_admin() || $this->is_instructor()) {
            $course->update([
                'course_package_id' => $request->course_package_id,
                'title' => $request->title,
                'description' => $request->description,
                'requirement' => $request->requirement
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $slug = $course->slug;
        $course_package_slug = $course->course_package->slug;
        $course_package_title = $course->course_package->title;
        $title = $course->title;
        $description = $course->description;
        $requirement = $course->requirement;

        return view('courses.show', compact(
            'slug', 'course_package_slug', 'course_package_title',
            'title', 'description', 'requirement'
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
        $course = Course::firstOrFail($id);
        if($course == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $course_registration = CourseRegistration::firstWhere('course_id', $id);
        if($course_registration != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        $session = Session::firstWhere('course_id', $id);
        if($session != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($this->is_admin()) {
            $course->delete();
        } else if($this->is_instructor()) {
            // Melakukan request ke Admin.
        } else {
            // Tidak memiliki hak akses.
        }

        $courses = Course::all()
            ->join('course_packages', 'course_package_id', '=', 'course_packages.id')
            ->select(
                'slug',
                'course_packages.title',
                'title',
                'description'
            )->paginate(10);
        return view('courses.index', compact(
            'courses'
        ));
    }
}
