<?php

namespace App\Models;

use App\User;
use App\Models\CourseRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldStudent extends Model
{
    use SoftDeletes;

    protected $table = "students";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'age',
        'status_job',
        'status_description',
        'status_value',
        'interest',
        'target_language_experience',
        'target_language_experience_value',
        'description_of_course_taken',
        'indonesian_language_proficiency',
        'learning_objective'
    ];

    /**
     * Get user information.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define a relationship.
     */
    public function course_registrations()
    {
    	return $this->hasMany(CourseRegistration::class);
    }
}
