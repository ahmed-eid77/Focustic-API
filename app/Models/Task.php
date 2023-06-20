<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'note',
        'duration',
        'initiated_at',
        'due_date',
        'state',
        'kind',
        'reminder',
        'reminder_date',
        'repeat',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];

    // Many To One Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Many to Many Relations
    public function mySessions()
    {
        return $this->belongsToMany(MySession::class, 'my_session_tasks', 'task_id', 'session_id');
    }
}
