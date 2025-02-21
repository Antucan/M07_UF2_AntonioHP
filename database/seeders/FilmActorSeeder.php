<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ActorFakerSeeder::class,
            FilmFakerSeeder::class,
        ]);
        //añadir de 1 a 3 actores por pelicula
        
        $films = DB::table('films')->get();
        $actors = DB::table('actors')->get();
        foreach ($films as $film) {
            $actorsInFilm = $actors->random(rand(1, 3));
            foreach ($actorsInFilm as $actor) {
                DB::table('films_actors')->insert([
                    'film_id' => $film->id,
                    'actor_id' => $actor->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
