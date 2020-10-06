<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Notification;
use App\Models\ContentLabel;

class NotificationLabel extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "notification_labels";
    protected $primaryKey = 'id';

    protected $fillable = [
        'notification_id',
        'content_label_id'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'NLB?', // Format kode yang akan digunakan.
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

    /**
     * Define a relationship.
     */
    public function content_label()
    {
    	return $this->belongsTo(ContentLabel::class);
    }
}
