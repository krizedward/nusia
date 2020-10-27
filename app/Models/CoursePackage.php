<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\MaterialType;
use App\Models\CourseType;
use App\Models\CourseLevel;
use App\Models\Course;
use App\Models\MaterialPublic;
use App\Models\CoursePackageDiscount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursePackage extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "course_packages";
    protected $primaryKey = 'id';

    protected $fillable = [
        'material_type_id',
        'course_type_id',
        'course_level_id',
        'title',
        'description',
        'count_session',
        'price',
        'refund_description'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'CRP?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function material_type()
    {
    	return $this->belongsTo(MaterialType::class);
    }

    /**
     * Define a relationship.
     */
    public function course_type()
    {
    	return $this->belongsTo(CourseType::class);
    }

    /**
     * Define a relationship.
     */
    public function course_level()
    {
    	return $this->belongsTo(CourseLevel::class);
    }

    /**
     * Define a relationship.
     */
    public function courses()
    {
    	return $this->hasMany(Course::class);
    }

    /**
     * Define a relationship.
     */
    public function material_publics()
    {
    	return $this->hasMany(MaterialPublic::class);
    }

    /**
     * Define a relationship.
     */
    public function course_package_discounts()
    {
    	return $this->hasMany(CoursePackageDiscount::class);
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
