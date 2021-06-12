<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Services\ApiConsumer;

class UserController extends Controller
{
    //Respuestas a una rutas

    /**
     * Retira o añade un item a la lista de favoritos. Devuelve el nuevo estado del item
     */
    public function toggleFav(Request $request)
    {
        $id = $request->input('id');
        $media_type = $request->input('media_type');
        return self::toggleInLista($id, $media_type, "favoritas");
    }

    /**
     * Retira o añade un item a la lista por_ver. Devuelve el nuevo estado del item
     */
    public function togglePorVer(Request $request)
    {
        $id = $request->input('id');
        $media_type = $request->input('media_type');
        return self::toggleInLista($id, $media_type, "porVer");
    }

    /**
     * Comprueba si una pelicula se encuentra en la lista de favoritos y devuelve verdadero o falso.
     */
    public function isFavoritaRespuesta(Request $request)
    {
        return self::isInLista($request->input('id'), $request->input('media_type'), Auth::user()->favoritas) ? 'true' : 'false';
    }

    /**
     * Comprueba si una pelicula se encuentra en la lista por_ver y responde verdadero o falso.
     */
    public function isPorVerRespuesta(Request $request)
    {
        return self::isInLista($request->input('id'), $request->input('media_type'), Auth::user()->porVer) ? 'true' : 'false';
    }

    //Pirvadas

    /**
     * Comprueba si una pelicula/serie se encuentra en la lista y devuelve verdadero o falso
     */
    private static function isInLista($id, $media_type, $lista)
    {
        $isIn = false;
        if (isset($lista)) {
            foreach ($lista as $film) {
                if ($film->media_type == $media_type && $film->id == $id) {
                    $isIn = true;
                    break;
                }
            }
        }
        return $isIn;
    }

    /**
     * Retira o añade un item a una lista. Devuelve el nuevo estado del item
     */
    private static function toggleInLista($id, $media_type, $nombreLista)
    {
        $client = new ApiConsumer();
        $user = User::find(Auth::user()->id);
        $isIn = self::isInLista($id, $media_type, $user->{$nombreLista});

        if ($isIn) {
            DB::table($nombreLista)->where([['user_id', '=', $user->id], ['pelicula_id', '=', $id], ['media_type', '=', $media_type]])->delete();
        } else {
            if (!Pelicula::where([['id', '=', $id], ['media_type', '=', $media_type]])->exists()) {
                Pelicula::inserta($client->getItem($media_type, $id));
            }
            $user->{$nombreLista}()->attach($id, ["media_type" => $media_type]);
        }
        $user->save();

        return !$isIn ? 'true' : 'false';
    }
}
