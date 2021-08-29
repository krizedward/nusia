<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\CoursePackage;
use App\Models\EconomyFlag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursePackageDiscount extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "course_package_discounts";
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_package_id',
        'economy_flag_id',
        'price',
        'description',
        'due_date',
        'status'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'CPD?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function course_package()
    {
    	return $this->belongsTo(CoursePackage::class);
    }

    /**
     * Get user information.
     */
    public function economy_flag()
    {
        return $this->belongsTo(EconomyFlag::class);
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
