<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MaterialPublic;
use App\Models\MaterialSession;
use App\Models\CoursePackage;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\CourseRegistration;
use App\Models\Session;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MaterialController extends Controller
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
     * Dowload a material from storage.
     */
    public function download($public_or_session = 'Public', $id)
    {
        if($public_or_session == 'Public') {
            $data = MaterialPublic::find($id);
        } else if($public_or_session == 'Session') {
            $data = MaterialSession::find($id);
        }

        $file_name = Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path;
        $path = 'uploads/material/' . $data->path;

        if($this->is_admin()) {
            //return response()->download($path, $data->path);
            return response()->download($path, $file_name);
        } else if($this->is_instructor()) {
            //return response()->download($path, $data->path);
            return response()->download($path, $file_name);
        } else if($this->is_student()) {
            //return response()->download($path, $data->path);
            return response()->download($path, $file_name);
        } else {
            //
        }
        //return redirect()->route('materials.index');
    }
}
