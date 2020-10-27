<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\MaterialType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialTypeValue extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "material_type_values";
    protected $primaryKey = 'id';

    protected $fillable = [
        'material_type_id',
        'value'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'MTV?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Define a relationship.
     */
    public function material_type()
    {
    	return $this->belongsTo(MaterialType::class);
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
