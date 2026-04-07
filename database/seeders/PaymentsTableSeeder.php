<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $payments = [];
        $methods = ['bkash', 'stripe', 'cash', 'nagad', 'rocket'];

        // Get all bookings
        $bookings = DB::table('bookings')->get();

        foreach ($bookings as $booking) {
            // Only create payments for confirmed bookings
            if ($booking->status == 'confirmed') {
                $statuses = ['paid', 'paid', 'paid', 'refunded']; // More paid than refunded
                $status = $statuses[array_rand($statuses)];

                $payments[] = [
                    'booking_id' => $booking->id,
                    'amount' => $booking->final_amount,
                    'method' => $methods[array_rand($methods)],
                    'transaction_id' => 'TXN' . strtoupper(uniqid()),
                    'status' => $status,
                    'paid_at' => $status == 'paid' ? Carbon::now()->subDays(rand(1, 10)) : null,
                    'created_at' => Carbon::now()->subDays(rand(1, 15)),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('payments')->insert($payments);
    }
}
