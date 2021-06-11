<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function pool()
    {
        return $this->belongsToMany(Pelicula::class, 'pool');
    }

    public function aceptadas()
    {
        return $this->belongsToMany(Pelicula::class, 'aceptadas');
    }

    public function matchs()
    {
        return $this->belongsToMany(Pelicula::class, 'matchs');
    }
}
