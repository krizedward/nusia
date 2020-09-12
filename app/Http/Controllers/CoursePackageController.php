<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CoursePackage;
use App\Models\CourseLevel;
use App\Models\CourseLevelDetail;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CoursePackageController extends Controller
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
            $course_package = CoursePackage::all();   
            return view('course_packages.admin_index', compact('course_package'));
        }
        //$data = CoursePackage::all();
        //return view('courses.packages.index', compact('data'));
    }

    public function index_material_type($material_type_id)
    {
        if($this->is_student()){
            $course_level_id = CourseLevel::where('name', Auth::user()->student->indonesian_language_proficiency)->first()->id;
            $course_level_detail_id = CourseLevelDetail::where('name', Auth::user()->student->indonesian_language_proficiency_detail)->first()->id;

            $course_packages = CoursePackage
                ::where('material_type_id', $material_type_id)
                ->get();
            return view('course_packages.student_index_material_type', compact('course_packages'));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin()) {
            return view('courses.packages.create');
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
            'material_type_id' => [
                'bail', 'required',
                Rule::unique('course_packages', 'material_type_id')
                    ->where('course_type_id', $request->course_type_id)
                    ->where('course_level_id', $request->course_level_id)
                    ->where('course_level_detail_id', $request->course_level_detail_id)
            ],
            'course_type_id' => [
                'bail', 'required',
                Rule::unique('course_packages', 'course_type_id')
                    ->where('material_type_id', $request->material_type_id)
                    ->where('course_level_id', $request->course_level_id)
                    ->where('course_level_detail_id', $request->course_level_detail_id)
            ],
            'course_level_id' => [
                'bail', 'required',
                Rule::unique('course_packages', 'course_level_id')
                    ->where('material_type_id', $request->material_type_id)
                    ->where('course_type_id', $request->course_type_id)
                    ->where('course_level_detail_id', $request->course_level_detail_id)
            ],
            'course_level_detail_id' => [
                'bail', 'required',
                Rule::unique('course_packages', 'course_level_detail_id')
                    ->where('material_type_id', $request->material_type_id)
                    ->where('course_type_id', $request->course_type_id)
                    ->where('course_level_id', $request->course_level_id)
            ],
            'title' => ['bail', 'required', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'requirement' => ['bail', 'sometimes', 'max:5000'],
            'count_session' => ['bail', 'sometimes', 'min:0', 'max:100'],
            'price' => ['bail', 'sometimes', 'min:0', 'max:1000000000']
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
            if(CoursePackage::where('slug', $data)->first() === null) break;
        }

        if($this->is_admin()) {
            CoursePackage::create([
                'slug' => $data,
                'material_type_id' => $request->material_type_id,
                'course_type_id' => $request->course_type_id,
                'course_level_id' => $request->course_level_id,
                'course_level_detail_id' => $request->course_level_detail_id,
                'title' => $request->title,
                'description' => $request->description,
                'requirement' => $request->requirement,
                'count_session' => $request->count_session,
                'price' => $request->price
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = CoursePackage::all();
        return view('courses.packages.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->is_admin()) {
            $data = CoursePackage::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
        
            return view('course_packages.admin_show',compact('data'));
        }

        return view('courses.packages.show', compact('data'));
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
            $data = CoursePackage::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('courses.packages.edit', compact('data'));
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
        $course_package = CoursePackage::findOrFail($id);
        if($course_package == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'material_type_id' => [
                'bail', 'required',
                Rule::unique('course_packages', 'material_type_id')
                    ->ignore($id, 'id')
                    ->where('course_type_id', $request->course_type_id)
                    ->where('course_level_id', $request->course_level_id)
                    ->where('course_level_detail_id', $request->course_level_detail_id)
            ],
            'course_type_id' => [
                'bail', 'required',
                Rule::unique('course_packages', 'course_type_id')
                    ->ignore($id, 'id')
                    ->where('material_type_id', $request->material_type_id)
                    ->where('course_level_id', $request->course_level_id)
                    ->where('course_level_detail_id', $request->course_level_detail_id)
            ],
            'course_level_id' => [
                'bail', 'required',
                Rule::unique('course_packages', 'course_level_id')
                    ->ignore($id, 'id')
                    ->where('material_type_id', $request->material_type_id)
                    ->where('course_type_id', $request->course_type_id)
                    ->where('course_level_detail_id', $request->course_level_detail_id)
            ],
            'course_level_detail_id' => [
                'bail', 'required',
                Rule::unique('course_packages', 'course_level_detail_id')
                    ->ignore($id, 'id')
                    ->where('material_type_id', $request->material_type_id)
                    ->where('course_type_id', $request->course_type_id)
                    ->where('course_level_id', $request->course_level_id)
            ],
            'title' => ['bail', 'required', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'requirement' => ['bail', 'sometimes', 'max:5000'],
            'count_session' => ['bail', 'sometimes', 'min:0', 'max:100'],
            'price' => ['bail', 'sometimes', 'min:0', 'max:1000000000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin()) {
            $course_package->update([
                'material_type_id' => $request->material_type_id,
                'course_type_id' => $request->course_type_id,
                'course_level_id' => $request->course_level_id,
                'course_level_detail_id' => $request->course_level_detail_id,
                'title' => $request->title,
                'description' => $request->description,
                'requirement' => $request->requirement,
                'count_session' => $request->count_session,
                'price' => $request->price
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = $course_package;
        return view('courses.packages.show', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CoursePackage::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($data->courses() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $data = CoursePackage::all();
        return view('courses.packages.index', compact('data'));
    }
}
