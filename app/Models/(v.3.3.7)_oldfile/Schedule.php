<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Student;
use App\Models\Instructors;
use App\Models\Classroom;

class Schedule extends Model
{
    protected $fillable = [
    	'student_id',
        'instructor_id',
        'class_id',
        'time_meet',
        'date_meet',
        'zoom_link',
    ];

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }

    public function instructor()
    {
    	return $this->belongsTo(Instructors::class);
    }

    public function class()
    {
    	return $this->belongsTo(Classroom::class);
    }
}
