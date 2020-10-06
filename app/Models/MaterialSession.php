<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialSession extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "material_sessions";
    protected $primaryKey = 'id';

    protected $fillable = [
        'session_id',
        'name',
        'description',
        'path'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'MSN?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function session()
    {
    	return $this->belongsTo(Session::class);
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->code;
    }
}
