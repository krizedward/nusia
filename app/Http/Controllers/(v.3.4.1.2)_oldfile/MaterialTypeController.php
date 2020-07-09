<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MaterialType;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class oldMaterialTypeController extends Controller
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
        $material_types = MaterialType::all()
            ->select(
                'slug',
                'code',
                'name',
                'description'
            );
        return view('material_types.index', compact(
            'material_types'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin()) {
            return view('material_types.create');
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

        $validator = Validator::make($data, [
            'code' => [
                'bail', 'required',
                Rule::unique('material_types', 'code')
                    ->where(function($query) {
                        return $query->where('deleted_at', null);
                    }
                ),
                'size:1'
            ],
            'name' => [
                'bail', 'required',
                Rule::unique('material_types', 'name')
                    ->where(function($query) {
                        return $query->where('deleted_at', null);
                    }
                ),
                'max:100'
            ],
            'description' => [
                'bail', 'sometimes',
                'max:5000'
            ]
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat slug baru.
        $slug = "";
        while(1) {
            $slug = Str::random(255);
            $material_type = MaterialType
                ::firstWhere('slug', $slug);
            if($material_type === null) break;
        }

        if($this->is_admin()) {
            MaterialType::create([
                'slug' => $slug,
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description
            ]);
        } else {
            // Tidak memiliki hak akses.
        }

        $material_types = MaterialType::all()
            ->select(
                'slug',
                'code',
                'name',
                'description'
            );
        return view('material_types.index', compact(
            'material_types'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material_type = MaterialType::firstOrFail($id);
        $slug = $material_type->slug;
        $code = $material_type->code;
        $name = $material_type->name;
        $description = $material_type->description;

        return view('material_types.show', compact(
            'slug', 'code', 'name', 'description'
        ));
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
            $material_type = MaterialType::firstOrFail($id);
            $slug = $material_type->slug;
            $code = $material_type->code;
            $name = $material_type->name;
            $description = $material_type->description;

            return view('material_types.edit', compact(
                'slug', 'code', 'name', 'description'
            ));
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
        $material_type = MaterialType::firstOrFail($id);
        $data = $request->all();

        $validator = Validator::make($data, [
            'code' => [
                'bail', 'required',
                Rule::unique('material_types', 'code')
                    ->ignore($id, 'id')
                    ->where(function($query) {
                        return $query->where('deleted_at', null);
                    }
                ),
                'size:1'
            ],
            'name' => [
                'bail', 'required',
                Rule::unique('material_types', 'name')
                    ->ignore($id, 'id')
                    ->where(function($query) {
                        return $query->where('deleted_at', null);
                    }
                ),
                'max:100'
            ],
            'description' => [
                'bail', 'sometimes',
                'max:5000'
            ]
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
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

        $slug = $material_type->slug;
        $code = $material_type->code;
        $name = $material_type->name;
        $description = $material_type->description;

        return view('material_types.show', compact(
            'slug', 'code', 'name', 'description'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material_type = MaterialType::firstOrFail($id);
        if($this->is_admin()) {
            $material_type->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        $material_types = MaterialType::all()
            ->select(
                'slug',
                'code',
                'name',
                'description'
            );
        return view('material_types.index', compact(
            'material_types'
        ));
    }
}
