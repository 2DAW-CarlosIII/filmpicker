<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function creaSala()
    {
        $sala = new Sala();
        $sala->id = self::generarSalaId();
        $sala->save();

        return redirect()->route('preSala', ['salaId' => $sala->id]);
    }
    /**
     * Asocia al usuario autenticado la sala pasada por post
     */
    public function unirseASala(Request $request)
    {
        if (is_null(Sala::find($request->input('salaId')))) {
            return redirect()->back()->withErrors(['msg' => 'La sala no existe']);
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
