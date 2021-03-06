<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Course;
use App\Models\Schedule;
use App\Models\MaterialSession;
use App\Models\SessionRegistration;
use App\Models\Form;
use App\Models\Task;

class Session extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "sessions";
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id',
        'schedule_id',
        'form_id',
        'title',
        'description',
        'requirement',
        'link_zoom',
        'reschedule_late_confirmation',
        'reschedule_technical_issue_instructor',
        'reschedule_technical_issue_student',
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'SNS?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }

    /**
     * Define a relationship.
     */
    public function schedule()
    {
    	return $this->belongsTo(Schedule::class);
    }

    /**
     * Define a relationship.
     */
    public function form()
    {
    	return $this->belongsTo(Form::class);
    }

    /**
     * Define a relationship.
     */
    public function material_sessions()
    {
    	return $this->hasMany(MaterialSession::class);
    }

    /**
     * Define a relationship.
     */
    public function session_registrations()
    {
    	return $this->hasMany(SessionRegistration::class);
    }

    /**
     * Define a relationship.
     */
    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->code;
    }
}
