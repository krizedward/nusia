<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\CoursePackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseLevel extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "course_levels";
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'assignment_score_min',
        'exam_score_min'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'CRL?', // Format kode yang akan digunakan.
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
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->code;
    }
}
