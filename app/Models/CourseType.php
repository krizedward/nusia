<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\CoursePackage;
use App\Models\CourseTypeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseType extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "course_types";
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'brief_description_1',
        'brief_description_2',
        'description',
        'count_student_min',
        'count_student_max'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'CRT?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function course_packages()
    {
    	return $this->hasMany(CoursePackage::class);
    }

    /**
     * Define a relationship.
     */
    public function course_type_values()
    {
    	return $this->hasMany(CourseTypeValue::class);
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
