<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class oldVerficationSchedule extends Model
{
    protected $fillable = [
    	'schedule_id',
    	'upload_data',
    	'done',
    	'status',
    ];

    public function schedule()
    {
    	return $this->belongsTo(Schedule::class);
    }

}
