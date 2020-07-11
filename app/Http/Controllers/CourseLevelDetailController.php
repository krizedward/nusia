<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CourseLevelDetail;
use App\Models\CoursePackage;
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
        $course_level_details = CourseLevelDetail::all()
            ->select(
                'slug',
                'code',
                'name',
                'description'
            )->paginate(10);
        return view('course_level_details.index', compact(
            'course_level_details'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin()) {
            return view('course_level_details.create');
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

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat slug baru.
        $slug = "";
        while(1) {
            $slug = Str::random(255);
            $course_level_detail = CourseLevelDetail::firstWhere('slug', $slug);
            if($course_level_detail === null) break;
        }

        if($this->is_admin()) {
            CourseLevelDetail::create([
                'slug' => $slug,
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $course_level_details = CourseLevelDetail::all()
            ->select(
                'slug',
                'code',
                'name',
                'description'
            )->paginate(10);
        return view('course_level_details.index', compact(
            'course_level_details'
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
        $course_level_detail = CourseLevelDetail::firstOrFail($id);
        if($course_level_detail == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $slug = $course_level_detail->slug;
        $code = $course_level_detail->code;
        $name = $course_level_detail->name;
        $description = $course_level_detail->description;

        return view('course_level_details.show', compact(
            'slug', 'code', 'name', 'description'
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
        if($this->is_admin()) {
            $course_level_detail = CourseLevelDetail::firstOrFail($id);
            if($course_level_detail == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }

            $slug = $course_level_detail->slug;
            $code = $course_level_detail->code;
            $name = $course_level_detail->name;
            $description = $course_level_detail->description;

            return view('course_level_details.edit', compact(
                'slug', 'code', 'name', 'description'
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
        $course_level_detail = CourseLevelDetail::firstOrFail($id);
        if($course_level_detail == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();

        $validator = Validator::make($data, [
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

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
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

        $slug = $course_level_detail->slug;
        $code = $course_level_detail->code;
        $name = $course_level_detail->name;
        $description = $course_level_detail->description;

        return view('course_level_details.show', compact(
            'slug', 'code', 'name', 'description'
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
        $course_level_detail = CourseLevelDetail::firstOrFail($id);
        if($course_level_detail == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $course_package = CoursePackage::firstWhere('course_level_detail_id', $id);
        if($course_package != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($this->is_admin()) {
            $course_level_detail->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $course_level_details = CourseLevelDetail::all()
            ->select(
                'slug',
                'code',
                'name',
                'description'
            )->paginate(10);
        return view('course_level_details.index', compact(
            'course_level_details'
        ));
    }
}
