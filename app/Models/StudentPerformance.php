<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPerformance extends Model
{
    protected $fillable = [
    	'student_id',
    	'rating',
    	'comment',
    ];
}
