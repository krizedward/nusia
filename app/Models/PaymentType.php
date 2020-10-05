<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentType extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "payment_types";
    protected $primaryKey = 'id';

    protected $fillable = [
        'method',
        'brief_description',
        'detailed_description',
        'account_number',
        'account_name'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'PTY?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }
}
