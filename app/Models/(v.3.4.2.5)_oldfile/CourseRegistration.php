<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Student;
use App\Models\CourseCertificate;
use App\Models\CoursePayment;
use App\Models\SessionRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldCourseRegistration extends Model
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
    	return $this->belongsTo(Course::class);
    }

    /**
     * Define a relationship.
     */
    public function student()
    {
    	return $this->belongsTo(Student::class);
    }

    /**
     * Define a relationship.
     */
    public function course_certificate()
    {
    	return $this->hasOne(CourseCertificate::class);
    }

    /**
     * Define a relationship.
     */
    public function course_payment()
    {
    	return $this->hasOne(CoursePayment::class);
    }

    /**
     * Define a relationship.
     */
    public function session_registrations()
    {
    	return $this->hasMany(SessionRegistration::class);
    }
}
