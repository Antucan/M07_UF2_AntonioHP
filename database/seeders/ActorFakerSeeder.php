<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
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
