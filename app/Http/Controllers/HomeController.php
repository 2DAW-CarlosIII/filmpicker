<?php

namespace App\Http\Controllers;

use App\Services\ApiConsumer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Toma una de las listas y llena los datos vacios de cada item que no tenga ya
     */
    private static function completaDatos($lista)
    {
        $client = new ApiConsumer();
        $listaRespuesta = [];
        foreach ($lista as $value) {
            if (is_null($value["poster_path"])) {
                array_push($listaRespuesta, $client->getItem($value["media_type"], $value["id"]));
            } else {
                array_push($listaRespuesta, $value);
            }
        }
        return $listaRespuesta;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ApiConsumer $client)
    {

        $favoritas = self::completaDatos(Auth::user()->favoritas);
        $por_ver = self::completaDatos(Auth::user()->porVer);

        $films = $client->trending();
        return view('home', ['films' => $films, 'cliente' => $client, 'favoritas' => $favoritas, 'por_ver' => $por_ver]);
    }
}
