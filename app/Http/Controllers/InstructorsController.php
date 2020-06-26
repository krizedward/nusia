<?php

namespace App\Http\Controllers;

use App\Models\Instructors;
use App\Models\Classroom;
use App\Models\ScheduleInstructor;
use Illuminate\Http\Request;

class InstructorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = Instructors::all();
        $class = Classroom::where('id',$id)->first();
        return view('instructors.index',compact('data','class'));
    }

    public function choose($class, $instructors)
    {
        return redirect()->route('time.index',[$class,$instructors]);
    }

    public function schedule(Request $request, $id)
    {
        $this->validate($request,[
            'class' => 'required',
            'time_meet'  => 'required',
            'date_meet'  => 'required',
        ]);

        $dt = Instructors::where('user_id',$request->id)->first();
        
        ScheduleInstructor::create([
            'instructor_id' => $dt->id,
            'class_id'      => $request->class,
            'time_meet'     => date('H:i:s', strtotime($request->time_meet)),
            'date_meet'     => date('yy/m/d', strtotime($request->date_meet)),
        ]);

        return redirect('/schedule/'.$id);
        
        /*

        ScheduleInstructor::create([
            'instructor_id' => '1',
            'class_id'      => '1',
            'time_meet'     => '01:01:01',
            'date_meet'     => '2020-02-02',
        ]);

        */

        //return dd($request->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Instructors  $instructors
     * @return \Illuminate\Http\Response
     */
    public function show(Instructors $instructors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructors  $instructors
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructors $instructors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instructors  $instructors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructors $instructors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructors  $instructors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructors $instructors)
    {
        //
    }
}
