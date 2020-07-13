<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursePackage extends Model
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
    	return $this->belongsTo(App\Models\MaterialType::class);
    }

    /**
     * Define a relationship.
     */
    public function course_type()
    {
    	return $this->belongsTo(App\Models\CourseType::class);
    }

    /**
     * Define a relationship.
     */
    public function course_level()
    {
    	return $this->belongsTo(App\Models\CourseLevel::class);
    }

    /**
     * Define a relationship.
     */
    public function course_level_detail()
    {
    	return $this->belongsTo(App\Models\CourseLevelDetail::class);
    }

    /**
     * Define a relationship.
     */
    public function courses()
    {
    	return $this->hasMany(App\Models\Course::class);
    }

    /**
     * Define a relationship.
     */
    public function material_publics()
    {
    	return $this->hasMany(App\Models\MaterialPublic::class);
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
