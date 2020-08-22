<?php

namespace App\Models;
use App\Models\FormQuestion;

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
    ];

    /**
     * Define a relationship.
     */
    public function form_questions()
    {
    	return $this->hasMany(FormQuestion::class);
    }
}
