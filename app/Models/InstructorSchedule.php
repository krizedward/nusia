<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\Instructor;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstructorSchedule extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "instructor_schedules";
    protected $primaryKey = 'id';

    protected $fillable = [
        'instructor_id',
        'schedule_id',
        'status'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'ISC?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

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
    public function schedule()
    {
    	return $this->belongsTo(Schedule::class);
    }
}
