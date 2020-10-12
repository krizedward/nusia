<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\CoursePackage;
use App\Models\CourseLevelDetail;
use App\Models\CourseLevel;
use App\Models\CourseType;
use App\Models\MaterialPublic;
use App\Models\MaterialType;
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
            $course = Course::all();
            $course_package = CoursePackage::all();
            $course_level   = CourseLevel::all();
            //$course_level_detail = CourseLevelDetail::all();
            $course_type = CourseType::all();
            $material_public = MaterialPublic::all();
            $material_type = MaterialType::all();
            return view('courses.admin_index', compact('course','course_package','course_level', 'course_type', 'material_public', 'material_type'));
        } else if ($this->is_student()) {
            $i = 0;
            foreach(Auth::user()->student->course_registrations as $cr) {
                if(strlen( strstr($cr->course->course_package->course_type->name, 'Trial') ) != 0) {
                    $i++;
                    break;
                }
            }

            if(Auth::user()->citizenship == 'Not Available') {
                return redirect()->route('layouts.questionnaire');
            } else if($i == 0) {
                // jika Student tidak sedang mengikuti Free Trial class,
                // maka Student diperbolehkan untuk mendaftar pada satu atau beberapa kelas lain
                // sesuai dengan language proficiency masing-masing Student.

                // seleksi berikut, khusus free trial saja
                // (PERLU DITAMBAHKAN JIKA ADA KELAS "Private" DAN "Group").
                $data = Course
                    ::join('course_packages', 'courses.course_package_id', 'course_packages.id')
                    ->join('course_levels', 'course_packages.course_level_id', 'course_levels.id')
                    ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    ->where('course_levels.name', 'LIKE', '%'.Auth::user()->student->indonesian_language_proficiency.'%')
                    ->where('course_types.name', 'LIKE', '%Trial%')
                    ->select('courses.id', 'courses.code', 'courses.course_package_id', 'courses.title', 'courses.description', 'courses.requirement', 'courses.created_at', 'courses.updated_at')
                    ->get();
                $is_local_access = config('database.connections.mysql.username') == 'root';
                return view('courses.student_index', compact('data', 'is_local_access'));
            } else {
                // jika Student sedang mengikuti Free Trial class,
                // maka Student tidak diperbolehkan untuk mendaftar dalam class lain.
                // Free Trial class dibatasi sejumlah 3 sesi.
                // Setiap Student hanya diperbolehkan mengikuti Free Trial class, sebanyak satu kali.
                return redirect()->route('home');
            }
        }
        //$data = Course::all();
        //return view('courses.index', compact('data'));
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
        $data = Validator::make($data, [
            'course_package_id' => ['bail', 'required'],
            'title' => ['bail', 'sometimes', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'requirement' => ['bail', 'sometimes', 'max:5000']
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
            if(Course::where('slug', $data)->first() === null) break;
        }

        if($this->is_admin() || $this->is_instructor()) {
            Course::create([
                'slug' => $data,
                'course_package_id' => $request->course_package_id,
                'title' => $request->title,
                'description' => $request->description,
                'requirement' => $request->requirement
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = Course::all();
        return view('courses.index', compact('data'));
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
            # code...
            $data = Course::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('courses.admin_show', compact('data'));
        }
        return view('courses.admin_show', compact('data'));
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
            $data = Course::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('courses.edit', compact('data'));
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
        $course = Course::findOrFail($id);
        if($course == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'course_package_id' => ['bail', 'required'],
            'title' => ['bail', 'sometimes', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'requirement' => ['bail', 'sometimes', 'max:5000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
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

        $data = $course;
        return view('courses.show', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Course::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($data->course_registrations() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($data->sessions() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else if($this->is_instructor()) {
            // Melakukan request ke Admin.
        } else {
            // Tidak memiliki hak akses.
        }

        $data = Course::all();
        return view('courses.index', compact('data'));
    }

    /**
     * Private Courses
     *
     * Roles: Student
    */
    public function private()
    {
        if ($this->is_student()) {
            //$course = Course::all();
            //return view('courses.student_private_index', compact('course'));

            $i = 0;
            foreach(Auth::user()->student->course_registrations as $cr) {
                if(strlen( strstr($cr->course->course_package->course_type->name, 'Private') ) != 0) {
                    $i++;
                    break;
                }
            }

            if(Auth::user()->citizenship == 'Not Available') {
                return redirect()->route('layouts.questionnaire');
            } else if($i == 0) {
                // jika Student tidak sedang mengikuti Free Trial class,
                // maka Student diperbolehkan untuk mendaftar pada satu atau beberapa kelas lain
                // sesuai dengan language proficiency masing-masing Student.

                // seleksi berikut, khusus free trial saja
                // (PERLU DITAMBAHKAN JIKA ADA KELAS "Private" DAN "Group").
                $data = Course
                    ::join('course_packages', 'courses.course_package_id', 'course_packages.id')
                    ->join('course_levels', 'course_packages.course_level_id', 'course_levels.id')
                    ->join('course_types', 'course_packages.course_type_id', 'course_types.id')
                    //->where('course_levels.name', 'LIKE', '%'.Auth::user()->student->indonesian_language_proficiency.'%')
                    ->where('course_types.name', 'LIKE', '%Private%')
                    ->select('courses.id', 'courses.code', 'courses.course_package_id', 'courses.title', 'courses.description', 'courses.requirement', 'courses.created_at', 'courses.updated_at')
                    ->get();
                $is_local_access = config('database.connections.mysql.username') == 'root';
                return view('courses.student_private_index', compact('data', 'is_local_access'));
            } else {
                // jika Student sedang mengikuti Free Trial class,
                // maka Student tidak diperbolehkan untuk mendaftar dalam class lain.
                // Free Trial class dibatasi sejumlah 3 sesi.
                // Setiap Student hanya diperbolehkan mengikuti Free Trial class, sebanyak satu kali.
                return redirect()->route('home');
            }

        }
    }
}
