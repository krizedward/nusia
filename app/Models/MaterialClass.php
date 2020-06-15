<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialClass extends Model
{
    protected $fillable = [
    	'instructor_id',
    	'title',
    	'upload_file',
    ];
}
