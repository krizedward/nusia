<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MaterialType;
use App\Models\CourseType;
use App\Models\CourseLevel;
use App\Models\CourseLevelDetail;
use App\Models\CoursePackage;
use App\Models\Course;
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
        $course_packages = CoursePackage::all()
            ->join('material_types', 'material_type_id', '=', 'material_types.id')
            ->join('course_types', 'course_type_id', '=', 'course_types.id')
            ->join('course_levels', 'course_level_id', '=', 'course_levels.id')
            ->join('course_level_details', 'course_level_detail_id', '=', 'course_levels_detail.id')
            ->select(
                'slug',
                'material_types.name',
                'course_types.name',
                'course_levels.name',
                'course_level_details.name',
                'title',
                'description',
                'count_session',
                'price'
            )->paginate(10);
        return view('course_packages.index', compact(
            'course_packages'
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
            return view('course_packages.create');
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

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat slug baru.
        $slug = "";
        while(1) {
            $slug = Str::random(255);
            $course_package = CoursePackage::firstWhere('slug', $slug);
            if($course_package === null) break;
        }

        if($this->is_admin()) {
            CoursePackage::create([
                'slug' => $slug,
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

        $course_packages = CoursePackage::all()
            ->join('material_types', 'material_type_id', '=', 'material_types.id')
            ->join('course_types', 'course_type_id', '=', 'course_types.id')
            ->join('course_levels', 'course_level_id', '=', 'course_levels.id')
            ->join('course_level_details', 'course_level_detail_id', '=', 'course_levels_detail.id')
            ->select(
                'slug',
                'material_types.name',
                'course_types.name',
                'course_levels.name',
                'course_level_details.name',
                'title',
                'description',
                'count_session',
                'price'
            )->paginate(10);
        return view('course_packages.index', compact(
            'course_packages'
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
        $course_package = CoursePackage::firstOrFail($id);
        if($course_package == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $slug = $course_package->slug;
        $material_type_slug = $course_package->material_type->slug;
        $course_type_slug = $course_package->course_type->slug;
        $course_level_slug = $course_package->course_level->slug;
        $course_level_detail_slug = $course_package->course_level_detail->slug;

        $material_type_name = $course_package->material_type->name;
        $course_type_name = $course_package->course_type->name;
        $course_level_name = $course_package->course_level->name;
        $course_level_detail_name = $course_package->course_level_detail->name;
        $title = $course_package->title;
        $description = $course_package->description;
        $count_session = $course_package->count_session;
        $price = $course_package->price;

        return view('course_packages.show', compact(
            'slug', 'material_type_slug', 'course_type_slug',
            'course_level_slug', 'course_level_detail_slug',
            'material_type_name', 'course_type_name',
            'course_level_name', 'course_level_detail_name',
            'title', 'description', 'count_session', 'price'
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
            $course_package = CoursePackage::firstOrFail($id);
            if($course_package == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }

            $slug = $course_package->slug;
            $material_type_slug = $course_package->material_type->slug;
            $course_type_slug = $course_package->course_type->slug;
            $course_level_slug = $course_package->course_level->slug;
            $course_level_detail_slug = $course_package->course_level_detail->slug;

            $material_type_name = $course_package->material_type->name;
            $course_type_name = $course_package->course_type->name;
            $course_level_name = $course_package->course_level->name;
            $course_level_detail_name = $course_package->course_level_detail->name;
            $title = $course_package->title;
            $description = $course_package->description;
            $count_session = $course_package->count_session;
            $price = $course_package->price;

            return view('course_packages.edit', compact(
                'slug', 'material_type_slug', 'course_type_slug',
                'course_level_slug', 'course_level_detail_slug',
                'material_type_name', 'course_type_name',
                'course_level_name', 'course_level_detail_name',
                'title', 'description', 'count_session', 'price'
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
        $course_package = CoursePackage::firstOrFail($id);
        if($course_package == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();

        $validator = Validator::make($data, [
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

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
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

        $slug = $course_package->slug;
        $material_type_slug = $course_package->material_type->slug;
        $course_type_slug = $course_package->course_type->slug;
        $course_level_slug = $course_package->course_level->slug;
        $course_level_detail_slug = $course_package->course_level_detail->slug;

        $material_type_name = $course_package->material_type->name;
        $course_type_name = $course_package->course_type->name;
        $course_level_name = $course_package->course_level->name;
        $course_level_detail_name = $course_package->course_level_detail->name;
        $title = $course_package->title;
        $description = $course_package->description;
        $count_session = $course_package->count_session;
        $price = $course_package->price;

        return view('course_packages.show', compact(
            'slug', 'material_type_slug', 'course_type_slug',
            'course_level_slug', 'course_level_detail_slug',
            'material_type_name', 'course_type_name',
            'course_level_name', 'course_level_detail_name',
            'title', 'description', 'count_session', 'price'
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
        $course_package = CoursePackage::firstOrFail($id);
        if($course_package == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $course = Course::firstWhere('course_package_id', $id);
        if($course != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($this->is_admin()) {
            $course_package->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $course_packages = CoursePackage::all()
            ->join('material_types', 'material_type_id', '=', 'material_types.id')
            ->join('course_types', 'course_type_id', '=', 'course_types.id')
            ->join('course_levels', 'course_level_id', '=', 'course_levels.id')
            ->join('course_level_details', 'course_level_detail_id', '=', 'course_levels_detail.id')
            ->select(
                'slug',
                'material_types.name',
                'course_types.name',
                'course_levels.name',
                'course_level_details.name',
                'title',
                'description',
                'count_session',
                'price'
            )->paginate(10);
        return view('course_packages.index', compact(
            'course_packages'
        ));
    }
}
