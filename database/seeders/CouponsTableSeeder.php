<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CouponsTableSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'WELCOME10',
                'discount_type' => 'percentage',
                'value' => 10.00,
                'expires_at' => Carbon::now()->addMonths(6),
                'usage_limit' => 100,
            ],
            [
                'code' => 'SAVE20',
                'discount_type' => 'percentage',
                'value' => 20.00,
                'expires_at' => Carbon::now()->addMonths(3),
                'usage_limit' => 50,
            ],
            [
                'code' => 'FLAT50',
                'discount_type' => 'fixed',
                'value' => 50.00,
                'expires_at' => Carbon::now()->addMonths(1),
                'usage_limit' => 20,
            ],
            [
                'code' => 'EARLYBIRD',
                'discount_type' => 'percentage',
                'value' => 15.00,
                'expires_at' => Carbon::now()->addDays(45),
                'usage_limit' => 200,
            ],
            [
                'code' => 'SPECIAL2026',
                'discount_type' => 'fixed',
                'value' => 25.00,
                'expires_at' => Carbon::now()->addMonths(8),
                'usage_limit' => null,
            ],
            [
                'code' => 'EXPIRED100',
                'discount_type' => 'fixed',
                'value' => 100.00,
                'expires_at' => Carbon::now()->subDays(10),
                'usage_limit' => 5,
            ],
        ];

        foreach ($coupons as $coupon) {
            DB::table('coupons')->insert([
                'code' => $coupon['code'],
                'discount_type' => $coupon['discount_type'],
                'value' => $coupon['value'],
                'expires_at' => $coupon['expires_at'],
                'usage_limit' => $coupon['usage_limit'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
