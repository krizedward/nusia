<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Session;
use App\Models\TaskSubmission;

class Task extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "tasks";
    protected $primaryKey = 'id';

    protected $fillable = [
        'session_id',
        'type',
        'title',
        'description',
        'due_date',
        'path_1',
        'path_2',
        'path_3'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'TAS?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Get user information.
     */
    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    /**
     * Define a relationship.
     */
    public function task_submissions()
    {
    	return $this->hasMany(TaskSubmission::class);
    }
}
