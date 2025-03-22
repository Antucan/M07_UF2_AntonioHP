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
        try {
            $actors_db = DB::table('actors')->get()->map(function ($actor) {
                return (array) $actor;
            })->all();
            $actors = $actors_db;
        } catch (\Exception $e) {
            $actors = [];
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
    public function listActorsByDecade(Request $request)
    {
        // dd($request);
        $actors = ActorController::readActors();
        $decade = $request->query('decade');
        $actorsByDecade = [];
        $title = "Actors from the $decade's";
        //el campo de la base de datos es birthdate
        foreach ($actors as $actor) {
            $actorDecade = substr($actor['birthdate'], 0, 3) . "0";
            if ($actorDecade == $decade)
                $actorsByDecade[] = $actor;
        }
        return view('actors.list', ["actors" => $actorsByDecade, "title" => $title]);
    }

    /**
     * Destroy actor by id
     */
    public function destroyActor($id)
    {
        try {
            // $id = (int)$id;
            // dd($id);
            $actor = DB::table('actors')->where('id', $id)->first();
            
            if (!$actor) {
                return response()->json([
                    'error' => 'Actor not found'
                ], false);
            }
            DB::table('actors')->where('id', $id)->delete();
            return response()->json([
                'action' => 'delete'
            ], true);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error deleting actor'
            ], false);
        }
    }
    /**
     * Show actors
     */
    public function index()
    {
        $actors = ActorController::readActors();
        $title = "Actors";
        //show actors data json
        return response()->json($actors);
    }
}
