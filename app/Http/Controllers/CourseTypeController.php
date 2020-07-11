<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CourseType;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CourseTypeController extends Controller
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
        $course_types = CourseType::all()
            ->select(
                'slug',
                'code',
                'name',
                'description',
                'count_student_min',
                'count_student_max'
            )->paginate(10);
        return view('course_types.index', compact(
            'course_types'
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
            return view('course_types.create');
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
                Rule::unique('course_types', 'code')
                    ->where(function($query) {
                        return $query->where('deleted_at', null);
                    }
                ),
                'size:1'
            ],
            'name' => [
                'bail', 'required',
                Rule::unique('course_types', 'name')
                    ->where(function($query) {
                        return $query->where('deleted_at', null);
                    }
                ),
                'max:100'
            ],
            'description' => [
                'bail', 'sometimes',
                'max:5000'
            ],
            'count_student_min' => [
                'bail', 'sometimes',
                'min:0', 'max:1000'
            ],
            'count_student_max' => [
                'bail', 'sometimes',
                'min:0', 'max:1000'
            ]
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
            $course_type = CourseType
                ::firstWhere('slug', $slug);
            if($course_type === null) break;
        }

        if($this->is_admin()) {
            CourseType::create([
                'slug' => $slug,
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'count_student_min' => $request->count_student_min,
                'count_student_max' => $request->count_student_max
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $course_types = CourseType::all()
            ->select(
                'slug',
                'code',
                'name',
                'description',
                'count_student_min',
                'count_student_max'
            )->paginate(10);
        return view('course_types.index', compact(
            'course_types'
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
        $course_type = CourseType::firstOrFail($id);
        if($course_type == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $slug = $course_type->slug;
        $code = $course_type->code;
        $name = $course_type->name;
        $description = $course_type->description;
        $count_student_min = $course_type->count_student_min;
        $count_student_max = $course_type->count_student_max;

        return view('course_types.show', compact(
            'slug', 'code', 'name', 'description',
            'count_student_min', 'count_student_max'
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
            $course_type = CourseType::firstOrFail($id);
            if($course_type == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }

            $slug = $course_type->slug;
            $code = $course_type->code;
            $name = $course_type->name;
            $description = $course_type->description;
            $count_student_min = $course_type->count_student_min;
            $count_student_max = $course_type->count_student_max;

            return view('course_types.edit', compact(
                'slug', 'code', 'name', 'description',
                'count_student_min', 'count_student_max'
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
        $course_type = CourseType::firstOrFail($id);
        if($course_type == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'code' => [
                'bail', 'required',
                Rule::unique('course_types', 'code')
                    ->ignore($id, 'id')
                    ->where(function($query) {
                        return $query->where('deleted_at', null);
                    }
                ),
                'size:1'
            ],
            'name' => [
                'bail', 'required',
                Rule::unique('course_types', 'name')
                    ->ignore($id, 'id')
                    ->where(function($query) {
                        return $query->where('deleted_at', null);
                    }
                ),
                'max:100'
            ],
            'description' => [
                'bail', 'sometimes',
                'max:5000'
            ],
            'count_student_min' => [
                'bail', 'sometimes',
                'min:0', 'max:1000'
            ],
            'count_student_max' => [
                'bail', 'sometimes',
                'min:0', 'max:1000'
            ]
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if($this->is_admin()) {
            $course_type->update([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'count_student_min' => $request->count_student_min,
                'count_student_max' => $request->count_student_max
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $slug = $course_type->slug;
        $code = $course_type->code;
        $name = $course_type->name;
        $description = $course_type->description;
        $count_student_min = $course_type->count_student_min;
        $count_student_max = $course_type->count_student_max;

        return view('course_types.show', compact(
            'slug', 'code', 'name', 'description',
            'count_student_min', 'count_student_max'
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
        $course_type = CourseType::firstOrFail($id);

        if($course_type == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin()) {
            $course_type->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $course_types = CourseType::all()
            ->select(
                'slug',
                'code',
                'name',
                'description',
                'count_student_min',
                'count_student_max'
            )->paginate(10);
        return view('course_types.index', compact(
            'course_types'
        ));
    }
}
