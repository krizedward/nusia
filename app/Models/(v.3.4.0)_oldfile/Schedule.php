<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldSchedule extends Model
{
    use SoftDeletes;

    protected $table = "schedules";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'schedule_time',
        'status'
    ];

    /**
     * Define a relationship.
     */
    public function user()
    {
    	return $this->belongsTo('App\User', 'id');
    }

    /**
     * Define a relationship.
     */
    public function session()
    {
    	return $this->hasOne('App\Models\Session', 'schedule_id');
    }
}
