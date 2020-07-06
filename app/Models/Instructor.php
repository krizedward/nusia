<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use SoftDeletes;

    protected $table = "instructors";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'interest',
        'working_experience',
        'educational_experience'
    ];

    /**
     * Get user information.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }

    /**
     * Define a relationship.
     */
    public function schedules()
    {
    	return $this->hasMany('App\Models\Schedule', 'instructor_id');
    }
}
