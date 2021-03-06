<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\PaymentType;
use App\Models\CourseRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursePayment extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "course_payments";
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_registration_id',
        'payment_type_id',
        'payment_time',
        'amount',
        'status',
        'refunded_at',
        'path'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'CRY?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function payment_type()
    {
    	return $this->belongsTo(PaymentType::class);
    }

    /**
     * Define a relationship.
     */
    public function course_registration()
    {
    	return $this->belongsTo(CourseRegistration::class);
    }
}
