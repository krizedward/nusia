<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\NotificationLabel;

class ContentLabel extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "content_labels";
    protected $primaryKey = 'id';

    protected $fillable = [
        'label',
        'description',
        'icon'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'CLB?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function notification_labels()
    {
    	return $this->hasMany(NotificationLabel::class);
    }
}
