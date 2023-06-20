<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rotation_x',
        'rotation_y',
        'rotation_z',
        'ultrasonic'
    ];

    // Many To One Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
