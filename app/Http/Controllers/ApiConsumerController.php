<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class ApiConsumerController extends Controller
{
    /**
     * Recover 20 of the most popular film from the TMDB
     *
     */
    public static function trending($page = 1)
    {
        $response = Http::get('https://' . Config::get('constants.API_HOST') . 'trending/all/week?', [
            'api_key' => env('TMDBAPI_KEY'),
            'page' => $page
        ]);
        return json_decode($response);
    }

    /**
     * Recupera información de un item específico (película o programa de tv)
     *
     */
    public static function getItem($mediaType, $id)
    {
        $response = Http::get('https://' . Config::get('constants.API_HOST') . $mediaType . '/' . $id . '?', [
            'api_key' => env('TMDBAPI_KEY')
        ]);
        return json_decode($response);
    }

    /**
     * Recupera los resultados de la búsqueda de una cadena
     *
     */
    public static function search($cadena, $page = 1)
    {
        $response = Http::get('https://' . Config::get('constants.API_HOST') . 'search/multi?', [
            'api_key' => env('TMDBAPI_KEY'),
            'query' => $cadena,
            'page' => $page
        ]);
        return json_decode($response);
    }
}
