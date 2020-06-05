<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Instructors;
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
        $student    = Student::where('user_id',$id)->first();
        $data       = Schedule::all();
        $class      = Classroom::all();
        $instructor = Instructors::all();
        return view('schedule.index',compact('data','class','instructor','student'));
    }

    public function choose($user_id, $id)
    {
        $student    = Student::where('user_id',$user_id)->first();
        $choose     = Instructors::where('id',$id)->first();
        $data       = Schedule::all();
        $class      = Classroom::all();
        $instructor = Instructors::all();
        return view('schedule.index',compact('data','class','instructor','student','choose'));
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

        \Session::flash('Schedule-Student','Create Schedule Success!');
 

        return redirect('/schedule/'.$request->id);
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
