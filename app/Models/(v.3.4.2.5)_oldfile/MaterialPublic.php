<?php

namespace App\Models;

use App\Models\CoursePackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldMaterialPublic extends Model
{
    use SoftDeletes;

    protected $table = "material_publics";
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug',
        'course_package_id',
        'name',
        'description',
        'path'
    ];

    /**
     * Define a relationship.
     */
    public function course_package()
    {
    	return $this->belongsTo(CoursePackage::class);
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
