<?php

namespace App\Models;
use App\Models\FormQuestion;
use App\Models\SessionRegistrationForm;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormQuestionResponse extends Model
{
    use SoftDeletes;

    protected $table = "form_question_responses";
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

    /**
     * Define a relationship.
     */
    public function session_registration_form()
    {
    	return $this->hasOne(SessionRegistrationForm::class);
    }
}
