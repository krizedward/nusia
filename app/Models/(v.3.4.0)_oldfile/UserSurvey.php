<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldUserSurvey extends Model
{
    use SoftDeletes;

    protected $table = "user_surveys";
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug',
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
     * Define a relationship.
     */
    public function user()
    {
    	return $this->belongsTo('App\User', 'id');
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->slug;
    }
}
