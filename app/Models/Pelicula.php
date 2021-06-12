<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pelicula extends Model
{
    use HasFactory;

    public $timestamps = false;


    //Relaciones
    //usuarios de los que la película es favorita
    public function users_favorita()
    {
        return $this->belongsToMany(User::class, 'favoritas');
    }
    //Usuarios que han incluido la pelicula en su lista porVer
    public function users_porVer()
    {
        return $this->belongsToMany(User::class, 'porVer');
    }
    //Salas en las que la película se encuentra en el pool
    public function salas_pool()
    {
        return $this->belongsToMany(Sala::class, 'pool');
    }
    //Salas en las que la película se encuentra en las lista de aceptadas
    public function salas_aceptadas()
    {
        return $this->belongsToMany(Sala::class, 'aceptadas');
    }
    //Salas en las que la película se encuentra en la lista de matchs
    public function salas_()
    {
        return $this->belongsToMany(Sala::class, 'matchs');
    }

    //Otras funciones
    public static function inserta($film)
    {
        $pelicula = new Pelicula();
        $pelicula->id = $film->id;
        $pelicula->media_type = $film->media_type;
        if (!is_null($film->poster_path)) {
            $pelicula->title = $film->title ?? $film->name;
            $pelicula->poster_path = $film->poster_path;
            $pelicula->backdrop_path = $film->backdrop_path;
            $pelicula->overview = $film->overview;
            $pelicula->mark = $film->vote_average;
            $pelicula->homepage = $film->homepage;
        }
        $pelicula->save();
    }
}
