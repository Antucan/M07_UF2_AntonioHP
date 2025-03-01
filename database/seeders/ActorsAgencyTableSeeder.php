<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ActorsAgencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i < 10; $i++) {
            DB::table('actors')->insert([
                'name' => $faker->name,
                'surname' => $faker->lastName,
                'birthdate' => $faker->date,
                'country' => $faker->countryCode,
                'img_url' => $faker->imageUrl(640, 480, 'actor', true),
                'agency' => $faker->company,//adding agency
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
