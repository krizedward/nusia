<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\User;
use App\Models\InstructorSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "instructors";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'interest',
        'working_experience',
        'bio_description',
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'INS-?', // Format kode yang akan digunakan.
                'length' => 3 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

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
    public function instructor_schedules()
    {
    	return $this->hasMany(InstructorSchedule::class);
    }
}
