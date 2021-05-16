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
    public static function trending($page = null)
    {
        $response = Http::get('https://' . Config::get('constants.API_HOST') . 'trending/all/week?', [
            'api_key' => env('TMDBAPI_KEY'),
            'page' => $page ?? 1
        ]);
        return json_decode($response);
    }

    public static function getItem($mediaType, $id)
    {
        $response = Http::get('https://' . Config::get('constants.API_HOST') . $mediaType . '/' . $id . '?', [
            'api_key' => env('TMDBAPI_KEY')
        ]);
        return json_decode($response);
    }
}
