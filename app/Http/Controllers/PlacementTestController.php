<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\MaterialType;
use App\Models\PlacementTest;

class PlacementTestController extends Controller
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
        if($this->is_admin() || $this->is_lead_instructor()) {
            $material_types = MaterialType::where('name', 'NOT LIKE', '%Trial%')->get();
            $placement_tests = PlacementTest
                ::join('course_registrations', 'placement_tests.course_registration_id', 'course_registrations.id')
                ->join('courses', 'course_registrations.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->where('course_packages.title', 'LIKE', '%Not Assigned%')
                ->where('placement_tests.status', 'Not Passed')
                ->get();

            return view('registrations.lead_instructor_placement_tests_index', compact(
                'material_types', 'placement_tests',
            ));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $course_registration_id
     * @return \Illuminate\Http\Response
     */
    public function show($course_registration_id)
    {
        if($this->is_admin() || $this->is_lead_instructor()) {
            $course_registration = PlacementTest::where('course_registration_id', $course_registration_id)->get()->first()->course_registration;

            return view('registrations.lead_instructor_placement_tests_show', compact(
                'course_registration',
            ));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
