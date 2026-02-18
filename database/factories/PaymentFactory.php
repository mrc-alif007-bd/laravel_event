<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = \App\Models\Payment::class;

    public function definition(): array
    {
        $booking = Booking::inRandomOrder()->first();

        $status = $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded']);
        $amount = $booking ? $booking->final_amount : 0;

        return [
            'booking_id' => $booking ? $booking->id : null,
            'amount' => $amount,
            'method' => $this->faker->randomElement(['bkash', 'cash', 'card', 'stripe']),
            'transaction_id' => $status === 'paid' ? strtoupper(Str::random(10)) : null,
            'status' => $status,
            'paid_at' => $status === 'paid' ? now() : null,
        ];
    }
}
