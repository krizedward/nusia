<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\SessionRegistration;
use App\Models\Task;

class TaskSubmission extends Model
{
    use SoftDeletes;
    use AutoNumberTrait;

    protected $table = "task_submissions";
    protected $primaryKey = 'id';

    protected $fillable = [
        'session_registration_id',
        'task_id',
        'title',
        'description',
        'status',
        'score',
        'path_1',
        'path_1_submitted_at',
        'path_2',
        'path_2_submitted_at',
        'path_3',
        'path_3_submitted_at'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'TSB?', // Format kode yang akan digunakan.
                'length' => 5 // Jumlah digit yang akan digunakan sebagai nomor urut
                //refrensi : https://www.lab-informatika.com/membuat-kode-otomatis-di-laravel
            ]
        ];
    }

    /**
     * Get user information.
     */
    public function session_registration()
    {
        return $this->belongsTo(SessionRegistration::class);
    }

    /**
     * Get user information.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
