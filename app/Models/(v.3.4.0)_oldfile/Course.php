<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $table = "courses";
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug',
        'course_package_id',
        'title',
        'description',
        'requirement'
    ];

    /**
     * Define a relationship.
     */
    public function course_package()
    {
    	return $this->belongsTo('App\Models\CoursePackage', 'id');
    }

    /**
     * Define a relationship.
     */
    public function course_registrations()
    {
    	return $this->hasMany('App\Models\CourseRegistration', 'course_id');
    }

    /**
     * Define a relationship.
     */
    public function sessions()
    {
    	return $this->hasMany('App\Models\Session', 'course_id');
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
