<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\Session;
use App\Models\CoursePackage;
use App\Models\CourseRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    //use AutoNumberTrait;

    protected $table = "courses";
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_package_id',
        'title',
        'description',
        'requirement'
    ];

    //public function getAutoNumberOptions()
    //{
    //    return [
    //        'code' => [
    //            'format' => 'CRE?', // Format kode yang akan digunakan.
    //            'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
    //            //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
    //        ]
    //    ];
    //}

    /**
     * Define a relationship.
     */
    public function course_package()
    {
    	return $this->belongsTo(CoursePackage::class);
    }

    /**
     * Define a relationship.
     */
    public function course_registrations()
    {
    	return $this->hasMany(CourseRegistration::class);
    }

    /**
     * Define a relationship.
     */
    public function sessions()
    {
    	return $this->hasMany(Session::class);
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
