<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Notification;

class NotificationDuration extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "notification_durations";
    protected $primaryKey = 'id';

    protected $fillable = [
        'notification_id',
        'duration_in_month',
        'duration_in_day',
        'duration_in_hour',
        'duration_in_minute',
        'duration_in_second'
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

    /**
     * Define a relationship.
     */
    public function notification()
    {
    	return $this->belongsTo(Notification::class);
    }
}
