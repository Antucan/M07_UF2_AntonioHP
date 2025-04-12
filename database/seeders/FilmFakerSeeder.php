<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Film::factory()->count(10)->create();
    }
}