<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\Course;
use App\Models\Student;
use App\Models\CourseCertificate;
use App\Models\CoursePayment;
use App\Models\SessionRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseRegistration extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "course_registrations";
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id',
        'student_id'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'CRR?', // Format kode yang akan digunakan.
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
    public function student()
    {
    	return $this->belongsTo(Student::class);
    }

    /**
     * Define a relationship.
     */
    public function course_certificate()
    {
    	return $this->hasOne(CourseCertificate::class);
    }

    /**
     * Define a relationship.
     */
    public function course_payment()
    {
    	return $this->hasMany(CoursePayment::class); // diubah dari hasOne menjadi hasMany untuk fitur cicilan.
    }

    /**
     * Define a relationship.
     */
    public function session_registrations()
    {
    	return $this->hasMany(SessionRegistration::class);
    }
}
