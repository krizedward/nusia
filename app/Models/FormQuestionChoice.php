<?php

namespace App\Models;
use App\Models\FormQuestion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormQuestionChoice extends Model
{
    use SoftDeletes;

    protected $table = "form_question_choices";
    protected $primaryKey = 'id';

    protected $fillable = [
        'form_question_id',
        'answer',
    ];

    /**
     * Define a relationship.
     */
    public function form_question()
    {
    	return $this->belongsTo(FormQuestion::class);
    }
}
