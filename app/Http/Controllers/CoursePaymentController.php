<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;

use App\Models\CoursePayment;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CoursePaymentController extends Controller
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
    public function index($parameter)
    {
        if($this->is_admin()) {
            $data = CoursePayment::all();
            return view('courses.payments.index', compact('data'));
        } else if ($this->is_student()) {
            $data = CoursePayment::all();
            return view('course_payments.student_index', compact('data'));
        } else {
            // Tidak memiliki hak akses.
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin() || $this->is_student()) {
            return view('courses.payments.create');
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
        if($request->flag == false) return redirect()->route('courses.index');



        if($this->is_admin()) {
            /*
            $data = $request->all();
            $data = Validator::make($data, [
                'course_registration_id' => [
                    'bail', 'required',
                    Rule::unique('course_payments', 'course_registration_id')
                ],
                'method' => ['bail', 'required', 'max:20'],
                'payment_time' => ['bail', 'required', 'date'],
                'amount' => ['bail', 'sometimes', 'integer', 'max:1000000000'],
                'status' => ['bail', 'required'],
                'path' => ['bail', 'sometimes', 'max:1000']
            ]);

            if($data->fails()) {
                return redirect()->back()
                    ->withErrors($data)
                    ->withInput();
            }
            CoursePayment::create([
                'course_registration_id' => $request->course_registration_id,
                'method' => $request->method,
                'payment_time' => $request->payment_time,
                'amount' => $request->amount,
                'status' => $request->status,
                'path' => $request->path
            ]);
            */
        } else if ($this->is_student()) {
            $data = $request->all();
            $data = Validator::make($data, [
                'course_id' => [
                    'bail', 'required',
                    Rule::unique('course_registrations', 'course_id')
                        ->where('student_id', $request->student_id)
                ],
                'student_id' => [
                    'bail', 'required',
                    Rule::unique('course_registrations', 'student_id')
                        ->where('course_id', $request->course_id)
                ]
            ]);

            if($data->fails()) {
                return redirect()->back()
                    ->withErrors($data)
                    ->withInput();
            }

            CourseRegistration::create([
                'course_id' => $request->course_id,
                'student_id' => $request->student_id
            ]);

            $course = Course::findOrFail($request->course_id);
            $course_registration_id = CourseRegistration::all()->last()->id;

            CoursePayment::create([
                'course_registration_id' => $course_registration_id,
                'method' => 'None',
                'amount' => $course->course_package->price,
                'status' => 'Not Confirmed',
            ]);
            $data = CoursePayment::all();
            return view('course_payments.student_index', compact('data'));
        } else {
            // Tidak memiliki hak akses.
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->is_admin() || $this->is_student()) {
            $data = CoursePayment::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('courses.payments.show', compact('data'));
        } else {
            // Tidak memiliki hak akses.
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
        if($this->is_admin() || $this->is_student()) {
            $data = CoursePayment::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('courses.payments.edit', compact('data'));
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
        $course_payment = CoursePayment::findOrFail($id);
        if($course_payment == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'course_registration_id' => [
                'bail', 'required',
                Rule::unique('course_payments', 'course_registration_id')->ignore($id, 'id')
            ],
            'method' => ['bail', 'required', 'max:20'],
            'payment_time' => ['bail', 'required', 'date'],
            'amount' => ['bail', 'sometimes', 'integer', 'max:1000000000'],
            'status' => ['bail', 'required'],
            'path' => ['bail', 'sometimes', 'max:1000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin() || $this->is_student()) {
            /*
            $course_payment->update([
                'course_registration_id' => $request->course_registration_id,
                'method' => $request->method,
                'payment_time' => $request->payment_time,
                'amount' => $request->amount,
                'status' => $request->status,
                'path' => $request->path
            ]);
            */
        } else {
            // Tidak memiliki hak akses.
        }

        if($this->is_admin() || $this->is_student()) {
            $data = $course_payment;
            return view('courses.payments.show', compact('data'));
        } else {
            // Tidak memiliki hak akses.
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CoursePayment::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        if($this->is_admin() || $this->is_student()) {
            $data = CoursePayment::all();
            return view('courses.payments.index', compact('data'));
        } else {
            // Tidak memiliki hak akses.
        }
    }
}
