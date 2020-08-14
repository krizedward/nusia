<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MaterialPublic;
use App\Models\MaterialType;
use App\Models\CourseType;
use App\Models\CourseLevel;
use App\Models\CourseLevelDetail;
use App\Models\CoursePackage;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MaterialPublicController extends Controller
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
            return view('material_publics.admin_index');
        }
        //$data = MaterialPublic::all();
        //return view('materials.publics.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin()) {
            $material_types = MaterialType::all();
            $course_types = CourseType::all();
            $course_levels = CourseLevel::all();
            $course_level_details = CourseLevelDetail::all();

            return view('material_publics.admin_create', compact(
                'material_types', 'course_types',
                'course_levels', 'course_level_details'
            ));
        }

        if($this->is_instructor()) {
            $material_types = MaterialType::all();
            $course_types = CourseType::all();
            $course_levels = CourseLevel::all();
            $course_level_details = CourseLevelDetail::all();

            return view('material_publics.admin_create', compact(
                'material_types', 'course_types',
                'course_levels', 'course_level_details'
            ));
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
            'material_types' => ['bail', 'required'],
            'course_types' => ['bail', 'required'],
            'course_levels' => ['bail', 'required'],
            'course_level_details' => ['bail', 'required'],
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
            if(MaterialPublic::where('slug', $data)->first() === null) break;
        }

        $material_type_id = MaterialType::where('code', $request->material_types)->first()->id;
        $course_type_id = CourseType::where('code', $request->course_types)->first()->id;
        $course_level_id = CourseLevel::where('code', $request->course_levels)->first()->id;
        $course_level_detail_id = CourseLevelDetail::where('code', $request->course_level_details)->first()->id;

        $course_package_id = CoursePackage
            ::where('material_type_id', $material_type_id)
            ->where('course_type_id', $course_type_id)
            ->where('course_level_id', $course_level_id)
            ->where('course_level_detail_id', $course_level_detail_id)
            ->first()->id;

        if($this->is_admin()) {
            MaterialPublic::create([
                'slug' => $data,
                'course_package_id' => $course_package_id,
                'name' => $request->name,
                'description' => $request->description,
                'path' => $request->path
            ]);
        } else if($this->is_instructor()) {
            // Melakukan request ke Admin.
        } else {
            // Tidak memiliki hak akses.
        }

        return redirect()->route('material_publics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MaterialPublic::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }
        return view('materials.publics.show', compact('data'));
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
            $data = MaterialPublic::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('materials.publics.edit', compact('data'));
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
        $material_public = MaterialPublic::findOrFail($id);
        if($material_public == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'course_package_id' => ['bail', 'required'],
            'name' => ['bail', 'required', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'path' => ['bail', 'sometimes', 'max:1000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin()) {
            $material_public->update([
                'course_package_id' => $request->course_package_id,
                'name' => $request->name,
                'description' => $request->description,
                'path' => $request->path
            ]);
        } else if($this->is_instructor()) {
            // Melakukan request ke Admin.
        } else {
            // Tidak memiliki hak akses.
        }

        $data = $material_public;
        return view('materials.publics.show', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MaterialPublic::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else if($this->is_instructor()) {
            // Melakukan request ke Admin.
        } else {
            // Tidak memiliki hak akses.
        }

        $data = MaterialPublic::all();
        return view('materials.publics.index', compact('data'));
    }
}
