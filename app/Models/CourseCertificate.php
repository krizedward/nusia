<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\CourseRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCertificate extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "course_certificates";
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_registration_id',
        'path'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'CRC?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function course_registration()
    {
    	return $this->belongsTo(CourseRegistration::class);
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
