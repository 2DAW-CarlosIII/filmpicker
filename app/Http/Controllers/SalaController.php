<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Sala;
use App\Services\ApiConsumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class SalaController extends Controller
{
    /************************/
    // Funciones auxiliares //
    /************************/
    private static function generarSalaId()
    {
        do {
            $id = strtoupper(Str::random(6));
        } while (!is_null(Sala::find($id)));
        return $id;
    }
    /**
     * Comprueba si una sala tiene usuarios asociados y en caso de que no, la elimina
     */
    private static function destruirSala($salaId)
    {
        if (!is_null($salaId) && count(Sala::find($salaId)->users) == 0) {
            Sala::destroy($salaId);
        }
    }
    /**
     * Cambia al usuario autenticado de sala
     */
    private static function cambiaSala($salaId)
    {
        $user = User::find(Auth::user()->id);
        $oldSalaId = $user->sala_id;
        $user->sala_id = $salaId;
        $user->posicion_sala = null;
        $user->save();

        self::destruirSala($oldSalaId);
    }

    /**
     * Comprueba si una película se encuentra ya en un array de la sala
     */
    private function is_in($list, $film)
    {
        if (!is_null($list)) {
            for ($i = 0; $i < count($list); $i++) { //$list es array pero por lo que sea no se puede acceder directamente a los elementos que lo integran por lo que no se puede usar un foreach
                if ($list[$i]->media_type == $film['media_type'] && $list[$i]->id == $film['id']) { //Al parecer los campos de un request se tienen que acceder como un array ¯\_(ツ)_/¯
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Inserta un elemento en una de las listas de la sala. No hace la función de guardado
     */
    private function insertar($list, $film)
    {
        if (is_null($list)) {
            $list = [$film];
        } else {
            array_push($list, $film);
        }
        return $list;
    }

    /**
     * Inserta las 20 películas trending de la página indicada
     */
    private function insertarTrending($pool)
    {
        $client = new ApiConsumer();
        $auxObject = $pool;
        $auxObject->page++;
        foreach ($client->trending($auxObject->page)->results as $film) {
            array_push($auxObject->list, $film);
        }
        return $auxObject;
    }


    //************************//
    // Funciones de respuesta //
    //************************//

    /**
     * Crea una sala nueva y te redirige a su preSala
     */
    public function creaSala(ApiConsumer $client)
    {
        $sala = new Sala();
        $sala->id = self::generarSalaId();

        //Se cargan las 20 primeras peliculas trending
        $pool = new stdClass;
        $pool->list = [];
        $pool->page = 1;
        foreach ($client->trending()->results as $film) {
            array_push($pool->list, $film);
        }

        $sala->pool = $pool;
        $sala->save();

        return redirect()->route('preSala', ['salaId' => $sala->id]);
    }
    /**
     * Asocia al usuario autenticado la sala pasada por post e inserta opcionalmente sus peliculas por ver en la sala
     */
    public function unirseASala(Request $request)
    {
        $sala = Sala::find($request->input('salaId'));
        if (is_null($sala)) {
            return redirect()->back()->withErrors(['msg' => 'La sala no existe']);
        }
        if ($request->input('por_ver') && !is_null(Auth::user()->por_ver)) {
            $auxObject = $sala->pool;
            foreach (Auth::user()->por_ver as $film) {
                $alreadyIn = false;
                foreach ($auxObject->list as $filmAlreadyIn) {
                    if ($filmAlreadyIn->media_type == $film->media_type && $filmAlreadyIn->id == $film->id) {
                        $alreadyIn = true;
                        break;
                    }
                }
                if (!$alreadyIn) {
                    array_push($auxObject->list, $film);
                }
            }
            $sala->pool = $auxObject;
            $sala->save();
        }

        self::cambiaSala($request->input('salaId'));
        return redirect()->route('sala', ['salaId' => $request->input('salaId')]);
    }

    /**
     * Saca al usuario autenticado de la sala y en caso de que no quede nadie, la destruye
     */
    public function salirSala()
    {
        $salaId = Auth::user()->sala_id;
        $usuario = User::find(Auth::user()->id);
        $usuario->sala_id = null;
        $usuario->posicion_sala = null;
        $usuario->save();
        self::destruirSala($salaId);
        return redirect()->route('home');
    }

    /**
     * Pasa el puntero del usuario a la siguiente película en la que se encuentra el usuario
     */
    public function next(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $sala = Sala::find($user->sala_id);
        $user->posicion_sala++;
        if (count($sala->pool->list) - 5 < $user->posicion_sala) {
            $sala->pool = $this->insertarTrending($sala->pool);
        }
        $user->save();

        if ($request->input('accepted')) {
            // if (is_null($sala->aceptadas)) {
            //     $sala->aceptadas = [$request->input('film')];
            // } else {

            if ($this->is_in($sala->aceptadas, $request->input('film'))) {
                if (!$this->is_in($sala->matchs, $request->input('film'))) {
                    $sala->matchs = $this->insertar($sala->matchs, $request->input('film'));
                }
            } else {
                $sala->aceptadas = $this->insertar($sala->aceptadas, $request->input('film'));
            }
            // }
        }
        $sala->save();
    }


    //****************//
    //     Vistas     //
    //****************//
    public function vista($salaId, ApiConsumer $client)
    {
        return view('sala', ['sala' => Sala::find($salaId), 'user' => User::find(Auth::user()->id), 'cliente' => $client]);
    }

    public function preSala($salaId = null)
    {
        if (is_null($salaId)) {
            return view('preSala');
        } else {
            return view('preSala', array('salaId' => $salaId));
        }
    }
}
