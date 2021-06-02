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
        $user->save();

        self::destruirSala($oldSalaId);
    }


    //************************//
    // Funciones de respuesta //
    //************************//

    /**
     * Crea una sala nueva y la asocia al usuario autenticado
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
     * Asocia al usuario autenticado la sala pasada por post
     */
    public function unirseASala(Request $request)
    {
        $sala = Sala::find($request->input('salaId'));
        if (is_null($sala)) {
            return redirect()->back()->withErrors(['msg' => 'La sala no existe']);
        }
        if ($request->input('por_ver')) {
        }


        self::cambiaSala($request->input('salaId'));
        return redirect()->route('sala', ['salaId' => $request->input('salaId')]);
    }

    //****************//
    //     Vistas     //
    //****************//
    public function vista($salaId)
    {
        return view('sala');
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
