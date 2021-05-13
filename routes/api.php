<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('trending',function(){
    $host = 'api.themoviedb.org/3/';
    $response = Http::get('https://' . $host . 'trending/all/week?', [
        'api_key' => env('TMDBAPI_KEY')
    ]);
    return response()->json(json_decode($response));
});

