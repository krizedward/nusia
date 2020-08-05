<?php

namespace App\Models;

use App\Models\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use SoftDeletes;

    protected $table = "ratings";
    protected $primaryKey = 'id';

    protected $fillable = [
        'session_id',
        'rating',
        'comment'
    ];

    /**
     * Define a relationship.
     */
    public function session()
    {
    	return $this->belongsTo(Session::class);
    }
}
