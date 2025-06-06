<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Actor;
use Illuminate\Database\Seeder;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = Film::all();
        $actors = Actor::all();

        foreach ($films as $film) {
            $film->actors()->syncWithoutDetaching(
                $actors->random(rand(1, 5))->pluck('id')->toArray()
            );
        }
    }
}
