<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Schedule;
use App\Models\VerficationSchedule;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Instructors;
use App\Models\ScheduleInstructor;

class oldHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        //parameter mencari id
        $temp    = User::where('id',$id)->first();
        
        //cek student atau instructor
        if ($temp->level == 'student') 
        {
            $role    = Student::where('user_id',$id)->first();
        } 

        elseif ($temp->level == 'instructor') 
        {
            $role    = Instructors::where('user_id',$id)->first();
        }
        //mengambil data-data
        $data       = VerficationSchedule::all();
        $class      = Classroom::all();
        $instructor = Instructors::all();
        //mengambil data jadwal instruktur
        $instructor_schedule = ScheduleInstructor::all();

        return view('home',compact('data','class','instructor','role','instructor_schedule'));
    }
}
