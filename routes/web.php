<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/item/{mediaType}/{id}',[App\Http\Controllers\FilmListController::class, 'itemPage'])->name('item');

//Vistas de listas
Route::get('/trending/{page?}', [App\Http\Controllers\FilmListController::class, 'trending'])->name('trending');

Route::get('/favoritas/{page?}', [App\Http\Controllers\FilmListController::class, 'favoritas'])->name('favoritas');

Route::get('/por_ver/{page?}', [App\Http\Controllers\FilmListController::class, 'por_ver'])->name('por_ver');

Route::get('/search/{page?}', [App\Http\Controllers\FilmListController::class, 'search'])->name('search');



/*****************/
// Interacciones //
/*****************/
