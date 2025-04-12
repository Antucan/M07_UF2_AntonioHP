<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Film;
use Illuminate\Database\Eloquent\Collection;

class FilmController extends Controller
{
    /**
     * Read films with actors
     */
    public static function readFilmsWithActors(): Collection
    {
        $films = Film::with('actors')->get();
        return $films;
    }

    /**
     * Read films from storage
     */
    public static function readFilms(): array
    {
        $filmsDb = DB::table('films')->get()->all();

        $filmsJson = Storage::json('/public/films.json');
        // dd($filmsDb, $filmsJson);
        // una variable que contenga json y bbdd
        $filmsDbAsArray = array_map(function ($film) {
            return (array) $film;
        }, $filmsDb);

        $films = array_merge($filmsDbAsArray, $filmsJson);
        // dd($films);
        return $films;
    }

    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            // foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            } else if ((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            } else if (!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function listFilmsByYear($year = null)
    {
        $title = "Listado de todas las pelis";
        
        //if year is null
        if (is_null($year))
            $films = Film::all();
        else
            $films = Film::where('year', $year)->get();
            $title = "Listado de todas las pelis filtrado x año";
        return view("films.list", ["films" => $films, "title" => $title]);
    }

    public function listFilmsByGenre($genre = null)
    {
        $title = "Listado de todas las pelis";

        //if year is null
        if (is_null($genre)) {
            $films = Film::all();
        } else {
            $films = Film::where('genre', $genre)->get();
            $title = "Listado de todas las pelis filtrado x categoria";
        }

        return view("films.list", ["films" => $films, "title" => $title]);

    }

    public function sortFilms()
    {
        //using query builder instead readFilms and only showing db films
        $title = "Peliculas de la BBDD por año descendente";
        $films = Film::orderBy('year', 'desc')->get();
        //show en list.blade.php
        return view("films.list", ["films" => $films, "title" => $title]);
    }

    public function countFilms()
    {
        $title = "Conteo de todas las pelis";
        $count = Film::count();
        return view("films.counter", ["count" => $count, "title" => $title]);
    }

    public function createFilm(Request $request)
    {
        $films = FilmController::readFilms();

        $new_film = $request->only(['name', 'year', 'genre', 'country', 'duration', 'img_url']);
        $new_film['created_at'] = now();
        $new_film['updated_at'] = now();

        if (!Film::where('name', $new_film['name'])->exists()) {
            $envFlag = env('FLAG', 'default');
            // si en el .env pone flag = database
            if ($envFlag == 'database') {
                $film = Film::create($new_film);
                $status = $film ? true : false;
            }
            // si en el .env pone flag = json
            if ($envFlag == 'json') {
                $film = Storage::disk('local')->put('public/films.json', json_encode($films));
                $status = $film ? true : false;
            }
            //una vez guardado redirigir a la lista de peliculas
            if ($status)
                return redirect()->action('App\Http\Controllers\FilmController@listFilms');
            else
                return view('welcome', ["status" => "Error al guardar la película"]);
        } else {
            return view('welcome', ["status" => "La película ya existe"]);
        }
    }

    public static function isFilm($name): bool
    {
        return Film::where('name', $name)->exists();
    }
}
