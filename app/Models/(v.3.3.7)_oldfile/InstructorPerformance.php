<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class oldInstructorPerformance extends Model
{
    protected $fillable = [
    	'instructor_id',
    	'rating',
    	'comment',
    ];
}
