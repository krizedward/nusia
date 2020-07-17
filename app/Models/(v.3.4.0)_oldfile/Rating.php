<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oldRating extends Model
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
    	return $this->belongsTo('App\Models\Session', 'id');
    }
}