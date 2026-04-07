<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingsTableSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = [];

        // Generate 25 random bookings
        for ($i = 1; $i <= 25; $i++) {
            $userId = rand(1, 12); // 2 specific + 10 random users
            $eventId = rand(1, 7);
            $tickets = rand(1, 5);

            // Get event price (simplified - in real app you'd query)
            $prices = [0, 99.99, 299.00, 150.00, 0, 75.00, 199.00];
            $ticketPrice = $prices[$eventId] ?? 50.00;

            $totalAmount = $ticketPrice * $tickets;
            $discountAmount = rand(0, 1) ? $totalAmount * 0.10 : 0;
            $finalAmount = $totalAmount - $discountAmount;

            $statuses = ['pending', 'confirmed', 'canceled'];
            $status = $statuses[array_rand($statuses)];

            $bookings[] = [
                'booking_code' => 'BK' . strtoupper(uniqid()),
                'user_id' => $userId,
                'event_id' => $eventId,
                'number_of_tickets' => $tickets,
                'ticket_price' => $ticketPrice,
                'discount_amount' => $discountAmount,
                'total_amount' => $totalAmount,
                'final_amount' => $finalAmount,
                'status' => $status,
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ];
        }

        // Add specific booking for admin and employer
        $bookings[] = [
            'booking_code' => 'BKADMIN001',
            'user_id' => 1, // admin
            'event_id' => 1,
            'number_of_tickets' => 2,
            'ticket_price' => 99.99,
            'discount_amount' => 0,
            'total_amount' => 199.98,
            'final_amount' => 199.98,
            'status' => 'confirmed',
            'created_at' => Carbon::now()->subDays(5),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ];

        $bookings[] = [
            'booking_code' => 'BKEMP001',
            'user_id' => 2, // employer
            'event_id' => 2,
            'number_of_tickets' => 3,
            'ticket_price' => 299.00,
            'discount_amount' => 89.70,
            'total_amount' => 897.00,
            'final_amount' => 807.30,
            'status' => 'confirmed',
            'created_at' => Carbon::now()->subDays(3),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ];

        DB::table('bookings')->insert($bookings);
    }
}
