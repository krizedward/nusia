<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CourseLevel;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CourseLevelController extends Controller
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
    public function is_financial_team() {
        return ($this->user_roles() == "Financial Team")? 1 : 0;
    }
    public function is_customer_service() {
        return ($this->user_roles() == "Customer Service")? 1 : 0;
    }
    public function is_lead_instructor() {
        return ($this->user_roles() == "Lead Instructor")? 1 : 0;
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
            $data = CourseLevel::all();
            return view('course_levels.admin_index', compact('data'));
        }
        //$data = CourseLevel::all();
        //return view('courses.levels.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin()) {
            return view('courses.levels.create');
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
            //'code' => [
            //    'bail', 'required',
            //    Rule::unique('course_levels', 'code'),
            //    'size:1'
            //],
            'name' => [
                'bail', 'required',
                Rule::unique('course_levels', 'name'),
                'max:100'
            ],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'assignment_score_min' => ['bail','sometimes','min:0','max:100'],
            'mid_score_min' => ['bail','sometimes','min:0','max:100'],
            'final_score_min' => ['bail','sometimes','min:0','max:100'],
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        // Membuat slug baru.
        //$data = "";
        //while(1) {
        //    $data = Str::random(255);
        //    if(CourseLevel::where('slug', $data)->first() === null) break;
        //}

        if($this->is_admin()) {
            CourseLevel::create([
                //'slug' => $data,
                //'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'assignment_score_min' => $request->assignment_score_min,
                'mid_exam_score_min' => $request->mid_exam_score_min,
                'final_exam_score_min' => $request->final_exam_score_min,
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = CourseLevel::all();
        //return view('courses.levels.index', compact('data'));
        Alert::success('Success', 'Create Course Level Berhasil !!!');
        return redirect()->route('courses.index'); 
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
            
            $data = CourseLevel::findOrFail($id);
            
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('course_levels.admin_show', compact('data'));
        }
        return view('courses.levels.show', compact('data'));
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
            $data = CourseLevel::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('courses.levels.edit', compact('data'));
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
        $course_level = CourseLevel::findOrFail($id);
        if($course_level == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();

        $data = Validator::make($data, [
            'code' => [
                'bail', 'required',
                Rule::unique('course_levels', 'code')->ignore($id, 'id'),
                'size:1'
            ],
            'name' => [
                'bail', 'required',
                Rule::unique('course_levels', 'name')->ignore($id, 'id'),
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
            $course_level->update([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = $course_level;
        return view('courses.levels.show', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CourseLevel::findOrFail($id);
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

        $data = CourseLevel::all();
        return view('courses.levels.index', compact('data'));
    }
}
