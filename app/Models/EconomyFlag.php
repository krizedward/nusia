<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\Student;
use App\Models\CoursePackageDiscount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EconomyFlag extends Model
{
    use SoftDeletes;
//    use AutoNumberTrait;

    protected $table = "economy_flags";
    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'name'
    ];

//    public function getAutoNumberOptions()
//    {
//        return [
//            'code' => [
//                'format' => 'ECF?', // Format kode yang akan digunakan.
//                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
//                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
//            ]
//        ];
//    }

    /**
     * Define a relationship.
     */
    public function students()
    {
    	return $this->hasMany(Student::class);
    }

    /**
     * Define a relationship.
     */
    public function course_package_discounts()
    {
    	return $this->hasMany(CoursePackageDiscount::class);
    }
}
