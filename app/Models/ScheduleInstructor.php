<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleInstructor extends Model
{
    protected $fillable = ['id','instructor_id','time_meet','date_meet'];
}
