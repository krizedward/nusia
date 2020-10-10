<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        if($this->is_admin()) {
            $users = User::orderBy('first_name')->orderBy('last_name')->get();
            $lead_instructors = User::where('roles', 'Lead Instructor')->orderBy('first_name')->orderBy('last_name')->get();
            $instructors = User::where('roles', 'Instructor')->orderBy('first_name')->orderBy('last_name')->get();
            $students = User::where('roles', 'Student')->orderBy('first_name')->orderBy('last_name')->get();
            $other_users = User
                ::where('roles', '<>', 'Lead Instructor')
                ->where('roles', '<>', 'Instructor')
                ->where('roles', '<>', 'Student')
                ->get();
            return view('users.admin_index', compact(
                'users', 'lead_instructors', 'instructors', 'students', 'other_users',
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.index');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->is_admin()) {
            $user = User::findOrFail($id);

            $view_name = '';
            if($user->roles == 'Admin') {
                $view_name = 'users.admin_show_admin';
            } else if($user->roles == 'Customer Service') {
                $view_name = 'users.admin_show_customer_service';
            } else if($user->roles == 'Financial Team') {
                $view_name = 'users.admin_show_financial_team';
            } else if($user->roles == 'Lead Instructor') {
                $view_name = 'users.admin_show_lead_instructor';
            } else if($user->roles == 'Instructor') {
                $view_name = 'users.admin_show_instructor';
            } else if($user->roles == 'Student') {
                $view_name = 'users.admin_show_student';
            } else {
                return redirect()->route('home');
            }
            return view($view_name, compact(
                'user',
            ));
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
