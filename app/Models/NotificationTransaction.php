<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Notification;
use App\Models\UserNotification;

class NotificationTransaction extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "notification_transactions";
    protected $primaryKey = 'id';

    protected $fillable = [
        'notification_id',
        'roles'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'NTR?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Get user information.
     */
    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    /**
     * Define a relationship.
     */
    public function user_notifications()
    {
    	return $this->hasMany(UserNotification::class);
    }
}
