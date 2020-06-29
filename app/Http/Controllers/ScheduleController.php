<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Schedule;
use App\Models\VerficationSchedule;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Instructors;
use App\Models\ScheduleInstructor;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        
        return view('schedule.index',compact('data','class','instructor','role','instructor_schedule'));
    }

    public function choose($user_id, $id)
    {
        $role       = Student::where('user_id',$user_id)->first();
        $choose     = Instructors::where('id',$id)->first();
        $data       = VerficationSchedule::all();
        $class      = Classroom::all();
        $instructor = Instructors::all();
        return view('schedule.index',compact('data','class','instructor','role','choose'));
        
        //return dd($choose);
    }

    public function verfication($user_id, $vs_id)
    {
        VerficationSchedule::where('id',$vs_id)->update([
            'status' => 'Aggree'
        ]);
        
        return redirect('/Schedule/'.$user_id);
    }

    public function session($id)
    {
        $temp    = User::where('id',$id)->first();
        

        if ($temp->level == 'student') 
        {
            $role    = Student::where('user_id',$id)->first();
        } 

        elseif ($temp->level == 'instructor') 
        {
            $role    = Instructors::where('user_id',$id)->first();
        }

        $data       = VerficationSchedule::all();
        
        return view('session.index', compact('data','role'));
    }

    public function detail()
    {
        return view('schedule.detail');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id'            => 'required',
            'instructor_id' => 'required',
            'class_id'      => 'required',
            'time_meet'     => 'required',
            'date_meet'     => 'required',
        ]);

        $dt = Student::where('user_id',$request->id)->first();

        Schedule::create([
            'student_id'    => $dt->id,
            'instructor_id' => $request->instructor_id,
            'class_id'      => $request->class_id,
            'time_meet'     => date('H:i:s', strtotime($request->time_meet)),
            'date_meet'     => date('yy/m/d', strtotime($request->date_meet)),
        ]);

        $temp = Schedule::all()->last();

        VerficationSchedule::create([
            'schedule_id'   => $temp->id,
            'status'        =>'Request',
        ]);

        \Session::flash('Schedule-Student','Create Schedule Success!');
 

        return redirect('/schedule/'.$request->id);
    }

    public function calendar($class,$instructor)
    {
        $data = ScheduleInstructor::all();
        $class = Classroom::where('id',$class)->first();
        $instructor = Instructors::where('id',$instructor)->first();
        return view('calendar.index',compact('data','class','instructor'));
    }

    public function summary($class,$instructor,$time)
    {
        $time       = ScheduleInstructor::where('id',$time)->first();
        $class      = Classroom::where('id',$class)->first();
        $instructor = Instructors::where('id',$instructor)->first();
        return view('schedule.summary',compact('time','class','instructor'));
    }

    public function savesummary($class,$instructor,$time,$date,$user)
    {
        $dt = Student::where('user_id',$user)->first();

        Schedule::create([
            'student_id'    => $dt->id,
            'instructor_id' => $instructor,
            'class_id'      => $class,
            'time_meet'     => $time,
            'date_meet'     => $date,
        ]);

        $temp = Schedule::all()->last();

        VerficationSchedule::create([
            'schedule_id'   => $temp->id,
            'status'        =>'Request',
        ]);

        \Session::flash('Schedule-Student','Create Schedule Success!');
 

        return redirect('/schedule/'.$user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
