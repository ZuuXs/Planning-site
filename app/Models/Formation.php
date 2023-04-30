<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    function users()
    {
        return $this->hasMany(User::class);
    }
    function cours()
    {
        return $this->hasMany(Cours::class);
    }
}
