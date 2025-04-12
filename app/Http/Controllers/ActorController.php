<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;
use Illuminate\Database\Eloquent\Collection;
class ActorController extends Controller
{
    /**
     * Read actors with films
     */
    public static function readActorsWithFilms(): Collection
    {
        $actors = Actor::with('films')->get();
        return $actors;
    }

    /**
     * Read actors from json and database
     */
    public static function readActors(): array
    {
        $actors = Actor::all()->toArray();

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
        $actors = Actor::count();
        return view('actors.count', ["count" => $actors]);
    }

    /**
     * List actors by decade
     */
    public function listActorsByDecade(Request $request)
    {
        $decade = (int)$request->query('decade');//Fuerzo a int, sin funciona pero da error al convertir en $actorsByDecade
        $enddecade = $decade + 9; //Se le suma 9 para obtener el rango de la decada 
        $title = "Actors from " . $decade . "'s";
        //guardar los actores que sean de esa decada
        $actorsByDecade = Actor::whereBetween('birthdate', ["$decade-01-01", "$enddecade-12-31"])->get();
        // dd($actorsByDecade); //El array se pasa vacio
        return view('actors.list', ["actors" => $actorsByDecade, "title" => $title]);
    }

    /**
     * Destroy actor by id
     */
    public function destroyActor($id)
    {
        $actor = Actor::find($id);
        if ($actor) {
            $actor->delete();
            return response()->json(['message' => 'Actor deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Actor not found'], 404);
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
