<?php

namespace App\Models;
use App\Models\FormResponse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormResponseDetail extends Model
{
    use SoftDeletes;

    protected $table = "form_response_details";
    protected $primaryKey = 'id';

    protected $fillable = [
        'form_response_id',
        'answer',
    ];

    /**
     * Define a relationship.
     */
    public function form_response()
    {
    	return $this->belongsTo(FormResponse::class);
    }
}
