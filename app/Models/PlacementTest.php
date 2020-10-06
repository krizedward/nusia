<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\CourseRegistration;

class PlacementTest extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "placement_tests";
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_registration_id',
        'path',
        'status',
        'submitted_at',
        'result_updated_at'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'PLT?', // Format kode yang akan digunakan.
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
}
