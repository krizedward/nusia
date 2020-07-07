<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldCourseLevelDetail extends Model
{
    use SoftDeletes;

    protected $table = "course_level_details";
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug',
        'code',
        'name',
        'description'
    ];

    /**
     * Define a relationship.
     */
    public function course_packages()
    {
    	return $this->hasMany('App\Models\CoursePackage', 'course_level_detail_id');
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
