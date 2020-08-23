<?php

namespace App\Models;
use App\Models\FormQuestion;
use App\Models\FormResponseDetail;
use App\Models\SessionRegistrationForm;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormResponse extends Model
{
    use SoftDeletes;

    protected $table = "form_responses";
    protected $primaryKey = 'id';

    protected $fillable = [
        'form_question_id',
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
    public function form_response_details()
    {
    	return $this->hasMany(FormResponseDetail::class);
    }

    /**
     * Define a relationship.
     */
    public function session_registration_form()
    {
    	return $this->hasOne(SessionRegistrationForm::class);
    }
}
