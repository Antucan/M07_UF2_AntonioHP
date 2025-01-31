<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array
    {
        $films = Storage::json('/public/films.json');
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
            //foreach ($this->datasource as $film) {
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
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year is null
        if (is_null($year))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year informed
        foreach ($films as $film) {
            if ((!is_null($year)) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function listFilmsByGenre($genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year is null
        if (is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year informed
        foreach ($films as $film) {
            if ((!is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function sortFilms()
    {
        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();
        usort($films, function ($a, $b) {
            return $b['year'] <=> $a['year'];
        });
        //if year and genre are null

        return view("films.list", ["films" => $films, "title" => $title]);
    }

    public function countFilms()
    {
        $title = "Conteo de todas las pelis";
        $films = FilmController::readFilms();
        $count = count($films);
        return view("films.counter", ["count" => $count, "title" => $title]);
    }

    public function createFilm(Request $request)
    {
        $films = FilmController::readFilms();

        $new_film = [
            "name" => $request->input('name'),
            "year" => $request->input('year'),
            "genre" => $request->input('genre'),
            "country" => $request->input('country'),
            "duration" => $request->input('duration'),
            "img_url" => $request->input('img_url')
        ];

        if (!FilmController::isFilm($new_film['name'])) {
            $films[] = $new_film;
            $status = Storage::put('/public/films.json', json_encode($films));
            if ($status)
                return redirect()->action('App\Http\Controllers\FilmController@listFilms');
            else
                return view('welcome', ["status" => "Error al guardar la película"]);
        } else {
            return view('welcome', ["status" => "La película ya existe"]);
        }
    }

    public function deleteFilm(Request $request)
    {
        $films = FilmController::readFilms();
        $film_name = $request->input('film_name');
        $new_films = [];
        foreach ($films as $film) {
            if ($film['film_name'] != $film_name)
                $new_films[] = $film;
        }
        $status = Storage::put('/public/films.json', json_encode($new_films));
        if ($status)
            return redirect()->action('App\Http\Controllers\FilmController@listFilms');
        else
            return view('welcome', ["status" => "Error al eliminar la película"]);
    }

    public static function isFilm($name): bool
    {
        $films = FilmController::readFilms();
        foreach ($films as $film) {
            if ($film['name'] == $name)
                return true;
        }
        return false;
    }
}
