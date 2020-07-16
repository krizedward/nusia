<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function private()
    {
        return view('registrations.students.private');
    }

    public function group()
    {
        return view('registrations.students.group');;
    }
}
