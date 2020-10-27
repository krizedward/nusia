<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\UserNotification;
use App\Models\NotificationLabel;
use App\Models\NotificationDuration;

class Notification extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "notifications";
    protected $primaryKey = 'id';

    protected $fillable = [
        'subject',
        'message',
        'icon_replacement_type',
        'icon_replacement_path'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'NTF?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function user_notifications()
    {
    	return $this->hasMany(UserNotification::class);
    }

    /**
     * Define a relationship.
     */
    public function notification_labels()
    {
    	return $this->hasMany(NotificationLabel::class);
    }

    /**
     * Define a relationship.
     */
    public function notification_duration()
    {
    	return $this->hasOne(NotificationDuration::class);
    }
}
