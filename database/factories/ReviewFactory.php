<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Event;

/**
 * @extends Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected $model = \App\Models\Review::class;

    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $event = Event::inRandomOrder()->first();

        return [
            'user_id' => $user ? $user->id : null,
            'event_id' => $event ? $event->id : null,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->optional()->paragraph(),
        ];
    }
}
