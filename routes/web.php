<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilmListController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


/**********/
// Vistas //
/**********/

Route::redirect('/', '/home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/item/{mediaType}/{id}', [FilmListController::class, 'itemPage'])->name('item');

//Vistas de listas
Route::get('/trending/{page?}', [FilmListController::class, 'trending'])->name('trending');

Route::get('/favoritas/{page?}', [FilmListController::class, 'favoritas'])->name('favoritas');

Route::get('/por_ver/{page?}', [FilmListController::class, 'por_ver'])->name('por_ver');

Route::get('/search/{page?}', [FilmListController::class, 'search'])->name('search');

//Vistas de la sala
Route::get('/preSala/{salaId?}', [SalaController::class, 'preSala'])->name('preSala');

Route::get('/sala/{salaId}', [SalaController::class, 'vista'])->name('sala');



/*****************/
// Interacciones //
/*****************/

Route::post('/toggleFav', [UserController::class, 'toggleFav'])->name('toggleFav');

Route::post('/isFav', [UserController::class, 'isFavoritaRespuesta'])->name('isFav');

Route::post('/creaSala', [SalaController::class, 'creaSala'])->name('creaSala');

Route::post('/unirseASala', [SalaController::class, 'unirseASala'])->name('unirseASala');

Route::get('/salirSala', [SalaController::class, 'salirSala'])->name('salirSala');
