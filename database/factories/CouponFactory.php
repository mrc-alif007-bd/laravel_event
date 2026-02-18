<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    protected $model = \App\Models\Coupon::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper(Str::random(8)),
            'discount_type' => $this->faker->randomElement(['fixed', 'percentage']),
            'value' => $this->faker->randomFloat(2, 5, 50),
            'expires_at' => $this->faker->optional()->dateTimeBetween('+1 days', '+60 days'),
            'usage_limit' => $this->faker->optional()->numberBetween(1, 100),
        ];
    }
}
