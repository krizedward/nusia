<?php

namespace App\Models;

use App\Models\Session;
use App\Models\CourseRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SessionRegistration extends Model
{
    use SoftDeletes;

    protected $table = "session_registrations";
    protected $primaryKey = 'id';

    protected $fillable = [
        'session_id',
        'course_registration_id',
        'registration_time',
        'status'
    ];

    /**
     * Define a relationship.
     */
    public function session()
    {
    	return $this->belongsTo(Session::class);
    }

    /**
     * Define a relationship.
     */
    public function course_registration()
    {
    	return $this->belongsTo(CourseRegistration::class);
    }
}
