<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use stdClass;

class UserController extends Controller
{
    /**
     * Retira o añade un item a la lista de favoritos. Devuelve el nuevo estado del item
     */
    public function toggleFav(Request $request)
    {
        $id = $request->input('id');
        $media_type = $request->input('media_type');

        $isFav = $this->isFav($id, $media_type);

        $user = User::find(Auth::user()->id);

        $item = new stdClass();
        $item->id = $id;
        $item->media_type = $media_type;

        $array = [];
        if ($isFav) {
            foreach ($user->favoritas as $value) {
                if ($media_type != $value->media_type && $value->id != $id) {
                    array_push($array, $value);
                }
            }
        } else {
            if (!is_null($user->favoritas)) {
                foreach ($user->favoritas as $value) { //Este bucle es estúpido pero he sido incapaz de hacerlo funcionar de otra manera
                    array_push($array, $value);
                }
            }
            array_push($array, $item);
        }
        $user->favoritas = $array;
        $user->save();

        return !$isFav ? 'true' : 'false';
    }

    /**
     * Comprueba si una pelicula/serie se encuentra en la lista de favoritos y devuelve verdadero o falso.
     * Preparada para devolver la respuesta a una petición
     */
    public function isFavoritaRespuesta(Request $request)
    {
        return $this->isFav($request->input('id'), $request->input('media_type')) ? 'true' : 'false';
    }

    /**
     * Comprueba si una pelicula/serie se encuentra en la lista de favoritos y devuelve verdadero o falso
     */
    private function isFav($id, $media_type)
    {
        $isFav = false;
        $favoritas = Auth::user()->favoritas;
        if (isset($favoritas)) {
            foreach ($favoritas as $favorita) {
                if ($favorita->id == $id && $favorita->media_type == $media_type) {
                    $isFav = true;
                    break;
                }
            }
        }
        return $isFav;
    }
}
