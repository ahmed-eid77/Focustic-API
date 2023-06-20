<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'body_part',
        'repetitions',
        'sets',
        'duration',
        'cover',
        'link',
        'pivot'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Relationship Many To Many
    public function users(){
        return $this->belongsToMany(User::class);
    }

    // Relationship Many To One
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
