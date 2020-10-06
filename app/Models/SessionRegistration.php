<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Session;
use App\Models\CourseRegistration;
use App\Models\SessionRegistrationForm;
use App\Models\Rating;
use App\Models\TaskSubmission;

class SessionRegistration extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "session_registrations";
    protected $primaryKey = 'id';

    protected $fillable = [
        'session_id',
        'course_registration_id',
        'registration_time',
        'status'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'SRG?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function session()
    {
    	return $this->belongsTo(Session::class);
    }

    /**
     * Define a relationship.
     */
    public function course_registration()
    {
    	return $this->belongsTo(CourseRegistration::class);
    }

    /**
     * Define a relationship.
     */
    public function session_registration_forms()
    {
    	return $this->hasMany(SessionRegistrationForm::class);
    }

    /**
     * Define a relationship.
     */
    public function ratings()
    {
    	return $this->hasMany(Rating::class);
    }

    /**
     * Define a relationship.
     */
    public function task_submissions()
    {
    	return $this->hasMany(TaskSubmission::class);
    }
}
