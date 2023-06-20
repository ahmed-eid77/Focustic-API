<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    // Relation One to Many
    public function exercises(){
        return $this->hasMany(Exercise::class);
    }
}
