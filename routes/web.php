<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ActorController;
use App\Http\Middleware\ValidateYear;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidateUrl;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('year')->group(function () {
    Route::group(['prefix' => 'filmout'], function () {
        // Routes included with prefix "filmout"
        Route::get('oldFilms/{year?}', [FilmController::class, "listOldFilms"])->name('oldFilms');
        Route::get('newFilms/{year?}', [FilmController::class, "listNewFilms"])->name('newFilms');
        Route::get('films/{year?}/{genre?}', [FilmController::class, "listFilms"])->name('listFilms');
        Route::get('filmsByYear/{year?}', [FilmController::class, "listFilmsByYear"])->name('filmsByYear');
        Route::get('filmsByGenre/{genre?}', [FilmController::class, "listFilmsByGenre"])->name('filmsByGenre');
        Route::get('sortFilms/', [FilmController::class, "sortFilms"])->name('sortFilms');
        Route::get('countFilms/', [FilmController::class, "countFilms"])->name('countFilms');
    });
});

Route::middleware('url')->group(function () {
    Route::group(['prefix' => 'filmin'], function () {
        Route::post('createFilm', [FilmController::class, "createFilm"])->name('createFilm');
    });
});

Route::group(['prefix' => 'actorout'], function () {
    Route::get('actors', [ActorController::class, "listActors"])->name('actors');
    Route::get('countActors', [ActorController::class, "countActors"])->name('countActors');
    Route::middleware('year')->group(function () {
        Route::get('listActorsByDecade/{decade?}', [ActorController::class, "listActorsByDecade"])->name('listActorsByDecade');
    });
    Route::delete('actors/{id}', [ActorController::class, "destroyActor"])->name('destroyActor');
});
