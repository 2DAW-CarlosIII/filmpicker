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
