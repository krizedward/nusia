<?php

namespace App\Models;
use App\Models\FormQuestion;
use App\Models\Session;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $table = "forms";
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'is_accessible_by',
    ];

    /**
     * Define a relationship.
     */
    public function form_questions()
    {
    	return $this->hasMany(FormQuestion::class);
    }

    /**
     * Define a relationship.
     */
    public function session()
    {
    	return $this->hasOne(Session::class);
    }
}
