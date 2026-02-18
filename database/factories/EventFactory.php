<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venue;
use App\Models\Category;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = \App\Models\Event::class;

    public function definition(): array
    {
        $venue = Venue::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();

        // Start date for the event
        $startDate = $this->faker->dateTimeBetween('+1 days', '+60 days');

        // Duration in hours
        $durationHours = $this->faker->numberBetween(1, 5);

        // Calculate end time properly
        $endDate = (clone $startDate)->modify('+' . $durationHours . ' hours');

        $ticketCount = $this->faker->numberBetween(50, 500);
        $isPaid = $this->faker->boolean(70);

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'venue_id' => $venue ? $venue->id : null,
            'category_id' => $category ? $category->id : null,
            'event_date' => $startDate->format('Y-m-d'),
            'start_time' => $startDate->format('H:i:s'),
            'end_time' => $endDate->format('H:i:s'),
            'is_paid' => $isPaid,
            'price' => $isPaid ? $this->faker->randomFloat(2, 10, 200) : 0,
            'total_tickets' => $ticketCount,
            'available_tickets' => $ticketCount,
            'sale_start_at' => now(),
            'sale_end_at' => $startDate,
            'status' => 1, // Upcoming
            'image' => 'event_images/default.jpg',
        ];
    }
}
