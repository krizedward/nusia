<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\CoursePackage;
//use App\Models\CourseLevelDetail;
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
            $course = Course::orderBy('course_package_id')->get();
            $course_package = CoursePackage::all();
            $course_level   = CourseLevel::orderBy('name')->get();
            //$course_level_detail = CourseLevelDetail::all();
            $course_type = CourseType::orderBy('name')->get();
            $material_public = MaterialPublic::all();
            $material_type = MaterialType::orderBy('name')->get();
            //return view('courses.admin_index', compact('course','course_package','course_level', 'course_type', 'material_public', 'material_type'));

            //return view('courses.admin_index_v1', compact('course','course_package','course_level', 'course_type', 'material_public', 'material_type'));

            //return view('courses.admin_index_v2', compact('course','course_package','course_level', 'course_type', /*'material_public',*/ 'material_type'));

            return view('role_admin.courses_index', compact('course','course_package','course_level', 'course_type','material_type'));
            
        }
    }
}
