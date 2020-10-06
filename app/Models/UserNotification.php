<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;
use App\Models\Notification;

class UserNotification extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "user_notifications";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'notification_transaction_id'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'USN?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * Define a relationship.
     */
    public function notification_transaction()
    {
    	return $this->belongsTo(NotificationTransaction::class);
    }
}
