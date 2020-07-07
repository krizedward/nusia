<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldMaterialType extends Model
{
    use SoftDeletes;

    protected $table = "material_types";
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug',
        'code',
        'name',
        'description'
    ];

    /**
     * Define a relationship.
     */
    public function course_packages()
    {
    	return $this->hasMany('App\Models\CoursePackage', 'material_type_id');
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
