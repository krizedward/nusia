<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CourseCertificate;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CourseCertificateController extends Controller
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
            $data = CourseCertificate::all();
            return view('course_certificates.admin_index', compact('data'));
        } else if($this->is_student()) {
            $data = CourseCertificate::all();
            return view('courses.certificates.index', compact('data'));
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
            return view('courses.certificates.create');
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
            'course_registration_id' => [
                'bail', 'required',
                Rule::unique('course_certificates', 'course_registration_id')
            ],
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
            if(CourseCertificate::where('slug', $data)->first() === null) break;
        }

        if($this->is_admin() || $this->is_instructor()) {
            Session::create([
                'slug' => $data,
                'course_registration_id' => $request->course_registration_id,
                'path' => $request->path
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        if($this->is_admin() || $this->is_instructor()) {
            $data = CourseCertificate::all();
            return view('courses.certificates.index', compact('data'));
        } else if($this->is_student()) {
            $data = CourseCertificate::all();
            return view('courses.certificates.index', compact('data'));
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
        $data = CourseCertificate::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin() || $this->is_instructor()) {
            return view('courses.certificates.show', compact('data'));
        } else if($this->is_student()) {
            return view('courses.certificates.show', compact('data'));
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
        $data = CourseCertificate::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin() || $this->is_instructor()) {
            return view('courses.certificates.edit', compact('data'));
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
        $course_certificate = CourseCertificate::firstOrFail($id);
        if($course_certificate == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'course_registration_id' => [
                'bail', 'required',
                Rule::unique('course_certificates', 'course_registration_id')->ignore($id, 'id')
            ],
            'path' => ['bail', 'sometimes', 'max:1000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin()) {
            $course_certificate->update([
                'course_registration_id' => $request->course_registration_id,
                'path' => $request->path
            ]);
        } else if($this->is_instructor()) {
            // Melakukan request ke Admin.
        } else {
            // Tidak memiliki hak akses.
        }

        $data = $course_certificate;
        if($this->is_admin() || $this->is_instructor()) {
            return view('courses.certificates.show', compact('data'));
        } else if($this->is_student()) {
            return view('courses.certificates.show', compact('data'));
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
        $data = CourseCertificate::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        if($this->is_admin() || $this->is_instructor()) {
            $data = CourseCertificate::all();
            return view('courses.certificates.index', compact('data'));
        } else if($this->is_student()) {
            $data = CourseCertificate::all();
            return view('courses.certificates.index', compact('data'));
        } else {
            // Tidak memiliki hak akses.
        }
    }
}
