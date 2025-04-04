<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // Géneros de películas
        $genres = ['thriller', 'action', 'drama', 'love'];
        foreach (range(1, 10) as $index) {
            DB::table('films')->insert([
                'name' => $faker->sentence(3),
                'year' => $faker->year,
                'genre' => $faker->randomElement($genres),
                'country' => $faker->countryCode,
                'duration' => $faker->numberBetween(60, 180),
                'img_url' => $faker->imageUrl(640, 480, 'film', true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}