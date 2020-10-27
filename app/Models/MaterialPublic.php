<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\CoursePackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialPublic extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "material_publics";
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_package_id',
        'session_number',
        'name',
        'description',
        'path'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'MPC?', // Format kode yang akan digunakan.
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
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->code;
    }
}
