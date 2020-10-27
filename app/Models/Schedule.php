<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\InstructorSchedule;
use App\Models\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "schedules";
    protected $primaryKey = 'id';

    protected $fillable = [
        'schedule_time',
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'SCH?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function instructor_schedules()
    {
    	return $this->hasMany(InstructorSchedule::class);
    }

    /**
     * Define a relationship.
     */
    public function session()
    {
    	return $this->hasOne(Session::class);
    }
}
