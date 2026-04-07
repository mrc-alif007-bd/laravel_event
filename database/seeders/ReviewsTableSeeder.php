<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewsTableSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [];
        $comments = [
            'Amazing event! Highly recommended.',
            'Great organization and wonderful experience.',
            'Could be better, but overall good.',
            'Excellent venue and performances.',
            'Too crowded, but enjoyable.',
            'Worth every penny!',
            'Disappointing organization.',
            'Fantastic experience, will attend again.',
            'Good value for money.',
            'The speakers were outstanding!',
        ];

        // Generate reviews for completed events
        for ($i = 1; $i <= 30; $i++) {
            $userId = rand(1, 12);
            $eventId = rand(1, 7);
            $rating = rand(1, 5);

            $reviews[] = [
                'user_id' => $userId,
                'event_id' => $eventId,
                'rating' => $rating,
                'comment' => $comments[array_rand($comments)],
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now(),
            ];
        }

        // Add specific reviews from admin and employer
        $reviews[] = [
            'user_id' => 1,
            'event_id' => 1,
            'rating' => 5,
            'comment' => 'Summer Music Festival was absolutely incredible! The lineup was fantastic.',
            'created_at' => Carbon::now()->subDays(2),
            'updated_at' => Carbon::now(),
        ];

        $reviews[] = [
            'user_id' => 2,
            'event_id' => 2,
            'rating' => 4,
            'comment' => 'Great conference, learned a lot from industry experts.',
            'created_at' => Carbon::now()->subDays(1),
            'updated_at' => Carbon::now(),
        ];

        DB::table('reviews')->insert($reviews);
    }
}
