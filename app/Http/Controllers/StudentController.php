<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Str;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
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
        $data = Student::all();
        return view('users.students.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'slug' => Str::random(255),
            'email' => $request->email,
            'password' => $request->password,
            'gender' => 'Male',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);
        $temp = User::all()->last();

        Student::create([
            'user_id' => $temp->id,
        ]);

        \Session::flash('coba','Create Success !!!');

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
