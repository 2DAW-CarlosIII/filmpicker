<?php

namespace Database\Seeders;

use App\Models\Sala;
use App\Models\User;
use App\Models\Pelicula;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $arrayDatosPeliculas = [["id" => 691179, "media_type" => "movie"], ["id" => 637649, "media_type" => "movie"], ["id" => 503736, "media_type" => "movie"], ["id" => 337404, "media_type" => "movie"]];

        Schema::disableForeignKeyConstraints();
        Sala::truncate();
        User::truncate();
        Pelicula::truncate();
        Schema::enableForeignKeyConstraints();

        $sala = new Sala();
        $sala->id = 'MZCKDA';
        $sala->save();
        $sala = new Sala();
        $sala->id = 'QEWJFV';
        $sala->save();
        $sala = new Sala();
        $sala->id = 'CWIJV0';
        $sala->save();

        $user = new User();
        $user->name = 'user';
        $user->email = 'mail@mail.org';
        $user->password = bcrypt('password');
        $user->sala_id = $sala->id;
        $user->save();

        $user = new User();
        $user->name = 'user2';
        $user->email = 'mail2@mail.org';
        $user->password = bcrypt('password');
        $user->save();

        foreach ($arrayDatosPeliculas as $value) {
            $pelicula = new Pelicula();
            $pelicula->id = $value["id"];
            $pelicula->media_type = $value["media_type"];
            $pelicula->save();
            $pelicula->id = $value["id"];
            $pelicula->save();
        }


        $user->favoritas()->attach($arrayDatosPeliculas[0]["id"], ["media_type" => $arrayDatosPeliculas[0]["media_type"]]);
        $user->porVer()->attach($arrayDatosPeliculas[0]["id"], ["media_type" => $arrayDatosPeliculas[0]["media_type"]]);
        $user->save();

        $sala = Sala::find('CWIJV0');
        $sala->pool()->attach($arrayDatosPeliculas[0]["id"], ["media_type" => $arrayDatosPeliculas[0]["media_type"]]);
        $sala->aceptadas()->attach($arrayDatosPeliculas[0]["id"], ["media_type" => $arrayDatosPeliculas[0]["media_type"]]);
        $sala->matchs()->attach($arrayDatosPeliculas[0]["id"], ["media_type" => $arrayDatosPeliculas[0]["media_type"]]);
        $sala->save();
    }
}
