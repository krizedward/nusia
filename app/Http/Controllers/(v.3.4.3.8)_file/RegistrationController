<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function trial()
    {
        return view('registrations.students.trial');
    }

    public function private()
    {
        $data = Course::all();
        return view('registrations.students.private',compact('data'));
    }

    public function group()
    {
        $data = Course::all();
        return view('registrations.students.group',compact('data'));
    }

    public function instructor()
    {
        return view('registrations.students.private-instructor');
    }

    public function time()
    {
        return view('registrations.students.private-time');
    }
}
