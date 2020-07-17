<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;

class oldUser extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = "users";
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'email',
        'password',
        'roles',
        'citizenship',
        'first_name',
        'last_name',
        'gender',
        'birthdate',
        'phone',
        'image_profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define a relationship.
     */
    public function instructor()
    {
    	return $this->hasOne('App\Models\Instructor', 'user_id');
    }

    /**
     * Define a relationship.
     */
    public function student()
    {
    	return $this->hasOne('App\Models\Student', 'user_id');
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->slug;
    }
}
