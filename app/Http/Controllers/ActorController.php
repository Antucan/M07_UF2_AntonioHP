<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Actor;

class ActorController extends Controller
{
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
