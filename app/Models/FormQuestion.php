<?php

namespace App\Models;
use App\Models\Form;
use App\Models\FormQuestionChoice;
use App\Models\FormResponse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormQuestion extends Model
{
    use SoftDeletes;

    protected $table = "form_questions";
    protected $primaryKey = 'id';

    protected $fillable = [
        'form_id',
        'is_required',
        'code',
        'question',
        'placeholder',
        'answer_type',
    ];

    /**
     * Define a relationship.
     */
    public function form()
    {
    	return $this->belongsTo(Form::class);
    }

    /**
     * Define a relationship.
     */
    public function form_question_choices()
    {
    	return $this->hasMany(FormQuestionChoice::class);
    }

    /**
     * Define a relationship.
     */
    public function form_responses()
    {
    	return $this->hasMany(FormResponse::class);
    }
}
