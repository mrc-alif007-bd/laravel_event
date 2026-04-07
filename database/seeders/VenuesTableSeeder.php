<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VenuesTableSeeder extends Seeder
{
    public function run(): void
    {
        $venues = [
            [
                'name' => 'Madison Square Garden',
                'address' => '4 Pennsylvania Plaza',
                'city' => 'New York',
                'capacity' => 20000,
                'description' => 'World-famous arena in New York City',
                'status' => true,
                'image' => 'venues/msg.jpg',
            ],
            [
                'name' => 'Royal Albert Hall',
                'address' => 'Kensington Gore',
                'city' => 'London',
                'capacity' => 5272,
                'description' => 'Iconic concert hall in London',
                'status' => true,
                'image' => 'venues/royal_albert.jpg',
            ],
            [
                'name' => 'Sydney Opera House',
                'address' => 'Bennelong Point',
                'city' => 'Sydney',
                'capacity' => 5738,
                'description' => 'Famous performing arts centre',
                'status' => true,
                'image' => 'venues/sydney_opera.jpg',
            ],
            [
                'name' => 'Tokyo Dome',
                'address' => '1-3-61 Koraku',
                'city' => 'Tokyo',
                'capacity' => 55000,
                'description' => 'Baseball stadium and entertainment venue',
                'status' => true,
                'image' => 'venues/tokyo_dome.jpg',
            ],
            [
                'name' => 'O2 Arena',
                'address' => 'Peninsula Square',
                'city' => 'London',
                'capacity' => 20000,
                'description' => 'Multi-purpose indoor arena',
                'status' => false,
                'image' => null,
            ],
        ];

        foreach ($venues as $venue) {
            DB::table('venues')->insert([
                'name' => $venue['name'],
                'address' => $venue['address'],
                'city' => $venue['city'],
                'capacity' => $venue['capacity'],
                'description' => $venue['description'],
                'status' => $venue['status'],
                'image' => $venue['image'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ]);
        }
    }
}
