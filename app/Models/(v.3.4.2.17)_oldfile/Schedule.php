<?php

namespace App\Models;

use App\Models\Instructor;
use App\Models\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $table = "schedules";
    protected $primaryKey = 'id';

    protected $fillable = [
        'instructor_id',
        'schedule_time',
        'status'
    ];

    /**
     * Define a relationship.
     */
    public function instructor()
    {
    	return $this->belongsTo(Instructor::class);
    }

    /**
     * Define a relationship.
     */
    public function session()
    {
    	return $this->hasOne(Session::class);
    }
}
