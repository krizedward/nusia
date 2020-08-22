<?php

namespace App\Models;
use App\Models\SessionRegistration;
use App\Models\FormQuestionResponse;

use Illuminate\Database\Eloquent\Model;

class SessionRegistrationForm extends Model
{
    use SoftDeletes;

    protected $table = "session_registration_forms";
    protected $primaryKey = 'id';

    protected $fillable = [
        'session_registration_id',
        'form_question_response_id',
    ];

    /**
     * Define a relationship.
     */
    public function session_registration()
    {
    	return $this->belongsTo(SessionRegistration::class);
    }

    /**
     * Define a relationship.
     */
    public function form_question_response()
    {
    	return $this->belongsTo(FormQuestionResponse);
    }
}
