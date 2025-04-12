<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\FilmController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::delete('Actors/{id}', [ActorController::class, "destroyActor"])->name('destroyActor');
Route::get('index', [ActorController::class, "index"])->name('index');
/**
 * List films with actors. Url to be used should be api/films
 */
Route::get('films', [FilmController::class, "readFilmsWithActors"])->name('listFilms');
/**
 * List actors with films. Url to be used should be api/actors
 */
Route::get('actors', [ActorController::class, "readActorsWithFilms"])->name('listActors');
