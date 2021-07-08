<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Course;
use App\Models\CourseCertificate;
use App\Models\CourseLevel;
use App\Models\CoursePackage;
use App\Models\CoursePackageDiscount;
use App\Models\CoursePayment;
use App\Models\CourseRegistration;
use App\Models\CourseType;
use App\Models\CourseTypeValue;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\FormQuestionChoice;
use App\Models\FormResponse;
use App\Models\FormResponseDetail;
use App\Models\Instructor;
use App\Models\InstructorSchedule;
use App\Models\MaterialPublic;
use App\Models\MaterialSession;
use App\Models\MaterialType;
use App\Models\MaterialTypeValue;
use App\Models\Message;
use App\Models\Metadata;
use App\Models\Notification;
use App\Models\NotificationDuration;
use App\Models\NotificationLabel;
use App\Models\OtherUser;
use App\Models\PlacementTest;
use App\Models\Rating;
use App\Models\Schedule;
use App\Models\Session;
use App\Models\SessionRegistration;
use App\Models\SessionRegistrationForm;
use App\Models\Student;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\UserNotification;

use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
        return ($this->user_roles() == "Instructor"
            || $this->user_roles() == "Lead Instructor")? 1 : 0;
    }
    public function is_student() {
        return ($this->user_roles() == "Student")? 1 : 0;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$data = $request->all();
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
        }*/

        if($this->is_admin()) {
            CoursePackage::create([
                //'slug' => $data,
                'material_type_id' => 1,
                'course_type_id' => 1,
                'course_level_id' => 1,
                'course_level_detail_id' => 1,
                'title' => $request->name,
                'description' => $request->description,
                //'requirement' => $request->requirement,
                'count_session' => $request->count_session,
                'price' => $request->price
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = CoursePackage::all();
        //return view('courses.packages.index', compact('data'));
        Alert::success('Success', 'Create Course Packages Berhasil !!!');
        return redirect()->route('courses.index');
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
