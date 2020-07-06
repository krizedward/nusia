<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseRegistration extends Model
{
    use SoftDeletes;

    protected $table = "course_registrations";
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id',
        'student_id'
    ];

    /**
     * Define a relationship.
     */
    public function course()
    {
    	return $this->belongsTo('App\Models\Course', 'id');
    }

    /**
     * Define a relationship.
     */
    public function student()
    {
    	return $this->belongsTo('App\Models\Student', 'id');
    }

    /**
     * Define a relationship.
     */
    public function course_certificate()
    {
    	return $this->hasOne('App\Models\CourseCertificate', 'course_registration_id');
    }

    /**
     * Define a relationship.
     */
    public function course_payment()
    {
    	return $this->hasOne('App\Models\CoursePayment', 'course_registration_id');
    }

    /**
     * Define a relationship.
     */
    public function session_registrations()
    {
    	return $this->hasMany('App\Models\SessionRegistration', 'course_registration_id');
    }
}
