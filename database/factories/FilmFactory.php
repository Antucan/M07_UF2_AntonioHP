<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'release_date' => $this->faker->date(),
            'duration' => $this->faker->numberBetween(60, 180),
            'country' => $this->faker->country,
            'img_url' => $this->faker->imageUrl(640, 480, 'film', true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
