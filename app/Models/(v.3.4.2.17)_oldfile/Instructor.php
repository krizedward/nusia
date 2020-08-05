<?php

namespace App\Models;

use App\User;
use App\Models\Schedule;
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
    ];

    /**
     * Get user information.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define a relationship.
     */
    public function schedules()
    {
    	return $this->hasMany(Schedule::class);
    }
}
