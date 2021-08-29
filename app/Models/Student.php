<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\User;
use App\Models\CourseRegistration;
use App\Models\EconomyFlag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "students";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'economy_flag_id',
        'age',
        'status_job',
        'status_description',
        'interest',
        'target_language_experience',
        'target_language_experience_value',
        'description_of_course_taken',
        'indonesian_language_proficiency',
        'learning_objective'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'CRE?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
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
     * Get user information.
     */
    public function economy_flag()
    {
        return $this->belongsTo(EconomyFlag::class);
    }

    /**
     * Define a relationship.
     */
    public function course_registrations()
    {
    	return $this->hasMany(CourseRegistration::class);
    }
}
