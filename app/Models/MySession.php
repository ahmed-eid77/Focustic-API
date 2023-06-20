<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MySession extends Model
{
    use HasFactory;

    public $table = 'my_sessions';

    protected $fillable = [
        'user_id',
        'name',
        'state',
        'start_time',
        'end_time'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // Many To One Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Many to Many Relations
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'my_session_tasks', 'session_id', 'task_id');
    }
}
