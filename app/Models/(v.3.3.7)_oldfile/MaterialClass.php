<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Instructors;
use App\Models\Classroom;

class MaterialClass extends Model
{
    protected $fillable = [
    	'instructor_id',
    	'class_id',
    	'title',
    	'upload_file',
    ];

    public function instructor()
    {
    	return $this->belongsTo(Instructors::class);
    }

    public function class()
    {
    	return $this->belongsTo(Classroom::class);
    }
}
