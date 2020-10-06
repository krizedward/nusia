<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class OtherUser extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "other_users";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'profile_description'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'OTH?', // Format kode yang akan digunakan.
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
