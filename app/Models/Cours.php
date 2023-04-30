<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $table = "Cours";

    function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function users()
    {
        return $this->belongsToMany(User::class, 'cours_users');
    }
    function plannings()
    {
        return $this->hasMany(Planning::class);
    }
}
