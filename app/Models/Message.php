<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class Message extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "messages";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id_sender',
        'user_id_recipient',
        'subject',
        'message'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'MSG?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Get user information.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
