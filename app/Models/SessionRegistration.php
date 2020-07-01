<?php

namespace App\Models;

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
    	return $this->belongsTo('App\Models\Session', 'id');
    }

    /**
     * Define a relationship.
     */
    public function course_registration()
    {
    	return $this->belongsTo('App\Models\CourseRegistration', 'id');
    }
}
