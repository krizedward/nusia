<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CourseLevelDetail;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CourseLevelDetailController extends Controller
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
        $data = CourseLevelDetail::all();
        return view('courses.level_details.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin()) {
            return view('courses.level_details.create');
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
            'code' => [
                'bail', 'required',
                Rule::unique('course_level_details', 'code'),
                'size:1'
            ],
            'name' => [
                'bail', 'required',
                Rule::unique('course_level_details', 'name'),
                'max:100'
            ],
            'description' => ['bail', 'sometimes', 'max:5000']
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
            if(CourseLevelDetail::where('slug', $slug)->first() === null) break;
        }

        if($this->is_admin()) {
            CourseLevelDetail::create([
                'slug' => $data,
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = CourseLevelDetail::all();
        return view('courses.level_details.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = CourseLevelDetail::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }
        return view('courses.level_details.show', compact('data'));
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
            $data = CourseLevelDetail::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('courses.level_details.edit', compact('data'));
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
        $course_level_detail = CourseLevelDetail::findOrFail($id);
        if($course_level_detail == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'code' => [
                'bail', 'required',
                Rule::unique('course_level_details', 'code')->ignore($id, 'id'),
                'size:1'
            ],
            'name' => [
                'bail', 'required',
                Rule::unique('course_level_details', 'name')->ignore($id, 'id'),
                'max:100'
            ],
            'description' => ['bail', 'sometimes', 'max:5000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin()) {
            $course_level_detail->update([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = $course_level_detail;
        return view('courses.level_details.show', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CourseLevelDetail::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($data->course_packages() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $data = CourseLevelDetail::all();
        return view('courses.level_details.index', compact('data'));
    }
}
