<?php

namespace App\Models;

use App\Models\MaterialType;
use App\Models\CourseType;
use App\Models\CourseLevel;
use App\Models\CourseLevelDetail;
use App\Models\Course;
use App\Models\MaterialPublic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldCoursePackage extends Model
{
    use SoftDeletes;

    protected $table = "course_packages";
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug',
        'material_type_id',
        'course_type_id',
        'course_level_id',
        'course_level_detail_id',
        'title',
        'description',
        'requirement',
        'count_session',
        'price'
    ];

    /**
     * Define a relationship.
     */
    public function material_type()
    {
    	return $this->belongsTo(MaterialType::class);
    }

    /**
     * Define a relationship.
     */
    public function course_type()
    {
    	return $this->belongsTo(CourseType::class);
    }

    /**
     * Define a relationship.
     */
    public function course_level()
    {
    	return $this->belongsTo(CourseLevel::class);
    }

    /**
     * Define a relationship.
     */
    public function course_level_detail()
    {
    	return $this->belongsTo(CourseLevelDetail::class);
    }

    /**
     * Define a relationship.
     */
    public function courses()
    {
    	return $this->hasMany(Course::class);
    }

    /**
     * Define a relationship.
     */
    public function material_publics()
    {
    	return $this->hasMany(MaterialPublic::class);
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
