<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    /**
     * Read actors from json and database
     */
    public static function readActors(): array
    {
        $actors_json = Storage::json('/public/actors.json') ?? [];
        try {
            $actors_db = DB::table('actors')->get()->map(function ($actor) {
                return (array) $actor;
            })->all();
            // Merge from json and database
            $actors = array_merge($actors_json, $actors_db);
        } catch (\Exception $e) {
            $actors = $actors_json;
        }
        return $actors;
    }

    /**
     * List actors
     */
    public function listActors()
    {
        $actors = ActorController::readActors();
        $title = "Actors";
        return view('actors.list', ["actors" => $actors, "title" => $title]);
    }

    /**
     * Count actors
     */
    public function countActors()
    {
        $actors = ActorController::readActors();
        $count = count($actors);
        return view('actors.count', ["count" => $count]);
    }

    /**
     * List actors by decade
     */
    public function listActorsByDecade($decade = null){
        $actors = ActorController::readActors();
        $title = $decade ? "Actors born in the $decade's" : "Actors";
        $actors_by_decade = [];
        if ($decade) {
            $actors_by_decade = array_filter($actors, function ($actor) use ($decade) {
                return $actor['born'] >= $decade && $actor['born'] < $decade + 10;
            });
        }
        return view('actors.list', ["actors" => $actors_by_decade, "title" => $title]);
    }
}