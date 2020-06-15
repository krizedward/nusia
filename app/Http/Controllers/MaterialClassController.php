<?php

namespace App\Http\Controllers;

use App\Models\Instructors;
use App\Models\MaterialClass;
use App\Models\Classroom;
use Illuminate\Http\Request;

class MaterialClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data  = MaterialClass::all();
        $class = Classroom::all();
        return view('material.index',compact('data','class'));
    }

    public function download($id)
    {
        $model_file = MaterialClass::findOrFail($id); //Mencari model atau objek yang dicari
        $destinationPath = "/uploads/material/";
        $file = public_path() . $destinationPath . $model_file->upload_file;//Mencari file dari model yang sudah dicari
        return response()->download($file, $model_file->upload_file); //Download file yang dicari berdasarkan nama file
    }

    public function student($id)
    {
        $data  = MaterialClass::where('class_id',$id)->get();
        return view('material.student',compact('data'));
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
            'title' => 'required',
            'class' => 'required',
        ]);

        $instructor = Instructors::where('user_id',$request->id)->first();
        $file       = $request->file('data');
        
        if($file){

            MaterialClass::create([
                'instructor_id' => $instructor->id,
                'class_id'      => $request->class,
                'title'         => $request->title,
                'upload_file'   => $file->getClientOriginalName(),
            ]);

            //Move Uploaded File
            $destinationPath = 'uploads/material';
            $file->move($destinationPath,$file->getClientOriginalName());    
        }
        

        return redirect('/material');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaterialClass  $materialClass
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialClass $materialClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterialClass  $materialClass
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialClass $materialClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaterialClass  $materialClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialClass $materialClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaterialClass  $materialClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialClass $materialClass)
    {
        //
    }
}
