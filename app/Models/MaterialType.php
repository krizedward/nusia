<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\CoursePackage;
use App\Models\MaterialTypeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialType extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "material_types";
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'duration_in_minute'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'MTP?', // Format kode yang akan digunakan.
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
    public function material_type_values()
    {
    	return $this->hasMany(MaterialTypeValue::class);
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
