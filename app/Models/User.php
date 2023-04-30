<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    public $timestamps = false;

    protected $fillable = ['nom','prenom','login','mdp','formation_id','type'];

    protected $hidden = ['mdp'];


    public function getAuthPassword()
    {
        return $this->mdp;
    }

    public function isAdmin()
    {
        return $this->type == 'admin';
    }

    public function isStudent()
    {
        return ($this->type == 'etudiant' || $this->type == 'admin');
    }

    public function isProf()
    {
        return ($this->type == 'enseignant' || $this->type == 'admin');
    }

    function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    function cours()
    {
        if ($this->isProf()) {
            return $this->hasMany(Cours::class);
        }

        return $this->belongsToMany(Cours::class, 'cours_users');
    }
}
