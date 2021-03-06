<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\SessionRegistration;

class Rating extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "ratings";
    protected $primaryKey = 'id';

    protected $fillable = [
        'session_registration_id',
        'rating',
        'comment'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'RTG?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function session_registration()
    {
    	return $this->belongsTo(SessionRegistration::class);
    }
}
