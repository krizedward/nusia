<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldMaterialSession extends Model
{
    use SoftDeletes;

    protected $table = "material_sessions";
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug',
        'session_id',
        'name',
        'description',
        'path'
    ];

    /**
     * Define a relationship.
     */
    public function session()
    {
    	return $this->belongsTo('App\Models\Session', 'id');
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->slug;
    }
}
