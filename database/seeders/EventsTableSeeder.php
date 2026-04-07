<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Summer Music Festival',
                'description' => 'A 3-day music festival featuring top international artists',
                'venue_id' => 1,
                'category_id' => 1,
                'event_date' => '2026-07-15',
                'start_time' => '14:00:00',
                'end_time' => '23:00:00',
                'is_paid' => true,
                'price' => 99.99,
                'total_tickets' => 5000,
                'available_tickets' => 5000,
                'sale_start_at' => Carbon::now()->subDays(30),
                'sale_end_at' => Carbon::now()->addDays(60),
                'status' => 1,
                'image' => 'events/summer_festival.jpg', // Valid image path
            ],
            [
                'title' => 'Tech Conference 2026',
                'description' => 'Annual technology conference with industry leaders',
                'venue_id' => 2,
                'category_id' => 3,
                'event_date' => '2026-09-20',
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
                'is_paid' => true,
                'price' => 299.00,
                'total_tickets' => 1000,
                'available_tickets' => 1000,
                'sale_start_at' => Carbon::now()->subDays(15),
                'sale_end_at' => Carbon::now()->addDays(90),
                'status' => 1,
                'image' => 'events/tech_conference.jpg',
            ],
            [
                'title' => 'Championship Basketball Final',
                'description' => 'Exciting basketball finals between top teams',
                'venue_id' => 4,
                'category_id' => 2,
                'event_date' => '2026-05-10',
                'start_time' => '19:30:00',
                'end_time' => '22:00:00',
                'is_paid' => true,
                'price' => 150.00,
                'total_tickets' => 8000,
                'available_tickets' => 0,
                'sale_start_at' => Carbon::now()->subDays(60),
                'sale_end_at' => Carbon::now()->subDays(5),
                'status' => 2,
                'image' => 'events/basketball_final.jpg',
            ],
            [
                'title' => 'Free Community Workshop',
                'description' => 'Learn web development basics for free',
                'venue_id' => 3,
                'category_id' => 4,
                'event_date' => '2026-04-25',
                'start_time' => '10:00:00',
                'end_time' => '16:00:00',
                'is_paid' => false,
                'price' => 0.00,
                'total_tickets' => 200,
                'available_tickets' => 45,
                'sale_start_at' => Carbon::now()->subDays(45),
                'sale_end_at' => Carbon::now()->addDays(10),
                'status' => 1,
                'image' => 'events/workshop.jpg',
            ],
            [
                'title' => 'Jazz Night',
                'description' => 'An evening of smooth jazz and fine dining',
                'venue_id' => 2,
                'category_id' => 1,
                'event_date' => '2026-03-30',
                'start_time' => '20:00:00',
                'end_time' => '23:30:00',
                'is_paid' => true,
                'price' => 75.00,
                'total_tickets' => 300,
                'available_tickets' => 0,
                'sale_start_at' => Carbon::now()->subDays(90),
                'sale_end_at' => Carbon::now()->subDays(10),
                'status' => 2,
                'image' => 'event_image/noimage.jpg', // Use default image instead of null
            ],
            [
                'title' => 'Canceled Event - Outdoor Expo',
                'description' => 'Outdoor equipment exhibition',
                'venue_id' => 5,
                'category_id' => 7,
                'event_date' => '2026-02-28',
                'start_time' => '11:00:00',
                'end_time' => '19:00:00',
                'is_paid' => true,
                'price' => 25.00,
                'total_tickets' => 500,
                'available_tickets' => 0,
                'sale_start_at' => Carbon::now()->subDays(100),
                'sale_end_at' => Carbon::now()->subDays(20),
                'status' => 3,
                'image' => 'event_image/noimage.jpg', // Use default image instead of null
            ],
            [
                'title' => 'Digital Marketing Seminar',
                'description' => 'Learn latest digital marketing strategies',
                'venue_id' => 3,
                'category_id' => 8,
                'event_date' => '2026-11-05',
                'start_time' => '09:30:00',
                'end_time' => '17:30:00',
                'is_paid' => true,
                'price' => 199.00,
                'total_tickets' => 150,
                'available_tickets' => 150,
                'sale_start_at' => Carbon::now()->addDays(10),
                'sale_end_at' => Carbon::now()->addDays(150),
                'status' => 1,
                'image' => 'events/marketing_seminar.jpg',
            ],
        ];

        foreach ($events as $event) {
            DB::table('events')->insert([
                'title' => $event['title'],
                'description' => $event['description'],
                'venue_id' => $event['venue_id'],
                'category_id' => $event['category_id'],
                'event_date' => $event['event_date'],
                'start_time' => $event['start_time'],
                'end_time' => $event['end_time'],
                'is_paid' => $event['is_paid'],
                'price' => $event['price'],
                'total_tickets' => $event['total_tickets'],
                'available_tickets' => $event['available_tickets'],
                'sale_start_at' => $event['sale_start_at'],
                'sale_end_at' => $event['sale_end_at'],
                'status' => $event['status'],
                'image' => $event['image'], // Now always has a value
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ]);
        }
    }
}
