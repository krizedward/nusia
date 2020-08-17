<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CourseRegistration;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
        $data = CourseRegistration::all();
        return view('registrations.courses.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin()) {
            return view('registrations.courses.create');
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

        if($this->is_admin() || $this->is_student()) {
            CourseRegistration::create([
                'course_id' => $request->course_id,
                'student_id' => $request->student_id
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        if($this->is_student()) {
            return redirect()->route('home');
        }

        $data = CourseRegistration::all();
        return view('registrations.courses.index', compact('data'));
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
