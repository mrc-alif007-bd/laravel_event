<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = \App\Models\Booking::class;

    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $event = Event::inRandomOrder()->first();

        $numberOfTickets = $this->faker->numberBetween(1, 5);
        $ticketPrice = $event ? $event->price : 0;
        $discount = $this->faker->randomFloat(2, 0, 10);
        $total = $ticketPrice * $numberOfTickets;
        $finalAmount = max($total - $discount, 0);

        return [
            'booking_code' => strtoupper(Str::random(8)),
            'user_id' => $user ? $user->id : null,
            'event_id' => $event ? $event->id : null,
            'number_of_tickets' => $numberOfTickets,
            'ticket_price' => $ticketPrice,
            'discount_amount' => $discount,
            'total_amount' => $total,
            'final_amount' => $finalAmount,
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'canceled']),
        ];
    }
}
