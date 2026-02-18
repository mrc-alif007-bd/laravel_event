<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    protected $model = \App\Models\Venue::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'capacity' => $this->faker->numberBetween(50, 1000),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->boolean(90), // mostly active
            'image' => 'venue_images/default.jpg',
        ];
    }
}
