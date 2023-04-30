<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['cours_id','date_debut','date_fin'];

    function cours()
    {
        return $this->belongsTo(Cours::class);
    }
}
