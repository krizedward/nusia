<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MaterialType;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MaterialTypeController extends Controller
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
        if($this->is_admin()){
            return view('material_types.admin_index');
        } else if($this->is_instructor()){
            return redirect()->route('home');
        } else if($this->is_student()) {
            $material_types = MaterialType::all();
            return view('material_types.student_index', compact('material_types'));
        } else {
            return redirect()->route('home');
        }
        //$data = MaterialType::all();
        //return view('materials.types.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin()) {
            return view('materials.types.create');
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
            'code' => [
                'bail', 'required',
                Rule::unique('material_types', 'code'),
                'size:1'
            ],
            'name' => [
                'bail', 'required',
                Rule::unique('material_types', 'name'),
                'max:100'
            ],
            'description' => ['bail', 'sometimes', 'max:5000']
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
            if(MaterialType::where('slug', $data)->first() === null) break;
        }

        if($this->is_admin()) {
            MaterialType::create([
                'slug' => $data,
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = MaterialType::all();
        return view('materials.types.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MaterialType::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }
        return view('materials.types.show', compact('data'));
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
            $data = MaterialType::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('materials.types.edit', compact('data'));
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
        $material_type = MaterialType::findOrFail($id);
        if($material_type == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        $data = $request->all();
        $data = Validator::make($data, [
            'code' => [
                'bail', 'required',
                Rule::unique('material_types', 'code')->ignore($id, 'id'),
                'size:1'
            ],
            'name' => [
                'bail', 'required',
                Rule::unique('material_types', 'name')->ignore($id, 'id'),
                'max:100'
            ],
            'description' => ['bail', 'sometimes', 'max:5000']
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($this->is_admin()) {
            $material_type->update([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $data = $material_type;
        return view('materials.types.show', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MaterialType::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($data->course_packages() != null) {
            // Data yang dicari masih terhubung dengan data lain, sehingga tidak dapat dihapus.
            // Return?
        }

        if($this->is_admin()) {
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $data = MaterialType::all();
        return view('materials.types.index', compact('data'));
    }
}
