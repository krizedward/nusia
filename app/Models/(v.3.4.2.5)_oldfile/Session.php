<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Schedule;
use App\Models\MaterialSession;
use App\Models\Rating;
use App\Models\SessionRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldSession extends Model
{
    use SoftDeletes;

    protected $table = "sessions";
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug',
        'course_id',
        'schedule_id',
        'title',
        'description',
        'requirement',
        'link_zoom'
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
    public function schedule()
    {
    	return $this->belongsTo(Schedule::class);
    }

    /**
     * Define a relationship.
     */
    public function material_sessions()
    {
    	return $this->hasMany(MaterialSession::class);
    }

    /**
     * Define a relationship.
     */
    public function ratings()
    {
    	return $this->hasMany(Rating::class);
    }

    /**
     * Define a relationship.
     */
    public function session_registrations()
    {
    	return $this->hasMany(SessionRegistration::class);
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
