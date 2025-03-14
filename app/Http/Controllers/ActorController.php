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
        return view('actors.list', ["actors" => $actors]);
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
}