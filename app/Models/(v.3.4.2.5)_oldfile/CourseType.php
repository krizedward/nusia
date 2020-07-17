<?php

namespace App\Models;

use App\Models\CoursePackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldCourseType extends Model
{
    use SoftDeletes;

    protected $table = "course_types";
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug',
        'code',
        'name',
        'description',
        'count_student_min',
        'count_student_max'
    ];

    /**
     * Define a relationship.
     */
    public function course_packages()
    {
    	return $this->hasMany(CoursePackage::class);
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
