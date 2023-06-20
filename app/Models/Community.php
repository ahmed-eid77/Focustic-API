<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_count',
        'created_by'
    ];

    // Relation Many To Many : Community & User
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
