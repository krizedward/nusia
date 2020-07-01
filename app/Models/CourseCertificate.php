<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCertificate extends Model
{
    use SoftDeletes;

    protected $table = "course_certificates";
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug',
        'course_registration_id',
        'path'
    ];

    /**
     * Define a relationship.
     */
    public function course_registration()
    {
    	return $this->belongsTo('App\Models\CourseRegistration', 'id');
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
