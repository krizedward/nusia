<?php

namespace App\Models;

use App\Models\CourseRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldCoursePayment extends Model
{
    use SoftDeletes;

    protected $table = "course_payments";
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_registration_id',
        'method',
        'payment_time',
        'amount',
        'status',
        'path'
    ];

    /**
     * Define a relationship.
     */
    public function course_registration()
    {
    	return $this->belongsTo(CourseRegistration::class);
    }
}
