<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\MaterialSession;
use App\Models\SessionRegistration;
use App\Models\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'link_zoom'
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
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->slug;
    }
}
