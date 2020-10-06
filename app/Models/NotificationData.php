<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationData extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "notification_data";
    protected $primaryKey = 'id';

    protected $fillable = [
        'caption',
        'value'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'NTD?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }
}
