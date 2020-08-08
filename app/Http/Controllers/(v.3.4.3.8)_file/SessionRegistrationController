<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SessionRegistration;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SessionRegistrationController extends Controller
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
        $data = SessionRegistration::all();
        return view('registrations.sessions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin()) {
            return view('registrations.sessions.create');
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
            'session_id' => [
                'bail', 'required',
                Rule::unique('session_registrations', 'session_id')
                    ->where('course_registration_id', $request->course_registration_id)
            ],
            'course_registration_id' => [
                'bail', 'required',
                Rule::unique('session_registrations', 'course_registration_id')
                    ->where('session_id', $request->session_id)
            ],
            'registration_time' => ['bail', 'sometimes', 'date'],
            'status' => ['bail', 'required']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin() || $this->is_student()) {
            SessionRegistration::create([
                'session_id' => $request->session_id,
                'course_registration_id' => $request->course_registration_id,
                'registration_time' => $request->registration_time,
                'status' => $request->status
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = SessionRegistration::all();
        return view('registrations.sessions.index', compact('data'));
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
            $data = SessionRegistration::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('registrations.sessions.edit', compact('data'));
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
        $session_registration = SessionRegistration::findOrFail($id);
        if($session_registration == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'session_id' => [
                'bail', 'required',
                Rule::unique('session_registrations', 'session_id')
                    ->ignore($id, 'id')
                    ->where('course_registration_id', $request->course_registration_id)
            ],
            'course_registration_id' => [
                'bail', 'required',
                Rule::unique('session_registrations', 'course_registration_id')
                    ->ignore($id, 'id')
                    ->where('session_id', $request->session_id)
            ],
            'registration_time' => ['bail', 'sometimes', 'date'],
            'status' => ['bail', 'required']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin() || $this->is_instructor()) {
            $session_registration->update([
                'session_id' => $request->session_id,
                'course_registration_id' => $request->course_registration_id,
                'registration_time' => $request->registration_time,
                'status' => $request->status
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = SessionRegistration::all();
        return view('registrations.sessions.index', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SessionRegistration::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $data = SessionRegistration::all();
        return view('registrations.sessions.index', compact('data'));
    }
}
