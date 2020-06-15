<?php

namespace App\Http\Controllers;

use App\Models\MaterialClass;
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
        return view('material.index');
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
