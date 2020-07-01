<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
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
    	return $this->belongsTo('App\Models\Course', 'id');
    }

    /**
     * Define a relationship.
     */
    public function schedule()
    {
    	return $this->belongsTo('App\Models\Schedule', 'id');
    }

    /**
     * Define a relationship.
     */
    public function material_sessions()
    {
    	return $this->hasMany('App\Models\MaterialSession', 'session_id');
    }

    /**
     * Define a relationship.
     */
    public function ratings()
    {
    	return $this->hasMany('App\Models\Rating', 'session_id');
    }

    /**
     * Define a relationship.
     */
    public function session_registrations()
    {
    	return $this->hasMany('App\Models\SessionRegistration', 'session_id');
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
