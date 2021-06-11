<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'favoritas',
        'porVer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'favoritas' => 'object',
    //     'por_ver' => 'object'
    // ];

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function favoritas()
    {
        return $this->belongsToMany(Pelicula::class, 'favoritas');
    }

    public function porVer()
    {
        return $this->belongsToMany(Pelicula::class, 'porVer');
    }
}
