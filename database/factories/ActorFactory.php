<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * 
 */
class ActorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Actor::class;
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'birthdate' => $this->faker->date(),
            'country' => $this->faker->countryCode,
            'img_url' => $this->faker->imageUrl(640, 480, 'actor', true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
