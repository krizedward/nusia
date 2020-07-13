<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MaterialSession;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MaterialSessionController extends Controller
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
        $data = MaterialSession::all();
        return view('materials.sessions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin() || $this->is_instructor()) {
            return view('materials.sessions.create');
        } else {
            // Tidak memiliki hak akses.
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data = Validator::make($data, [
            'session_id' => ['bail', 'required'],
            'name' => ['bail', 'required', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'path' => ['bail', 'sometimes', 'max:1000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        // Membuat slug baru.
        $data = "";
        while(1) {
            $data = Str::random(255);
            if(MaterialSession::where('slug', $slug)->first() === null) break;
        }

        if($this->is_admin() || $this->is_instructor()) {
            MaterialSession::create([
                'slug' => $data,
                'session_id' => $request->session_id,
                'name' => $request->name,
                'description' => $request->description,
                'path' => $request->path
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = MaterialSession::all();
        return view('materials.sessions.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MaterialSession::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }
        return view('materials.sessions.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->is_admin()) {
            $data = MaterialSession::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('materials.sessions.edit', compact('data'));
        } else {
            // Tidak memiliki hak akses.
        }
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
        $material_session = MaterialSession::findOrFail($id);
        if($material_session == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'session_id' => ['bail', 'required'],
            'name' => ['bail', 'required', 'max:255'],
            'description' => ['bail', 'sometimes', 'max:5000'],
            'path' => ['bail', 'sometimes', 'max:1000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin() || $this->is_instructor()) {
            $material_session->update([
                'session_id' => $request->session_id,
                'name' => $request->name,
                'description' => $request->description,
                'path' => $request->path
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = $material_session;
        return view('materials.sessions.show', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MaterialSession::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin() || $this->is_instructor()) {
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $data = MaterialSession::all();
        return view('materials.sessions.index', compact('data'));
    }
}
