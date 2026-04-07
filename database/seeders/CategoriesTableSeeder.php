<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Music Concert', 'description' => 'Live music performances by top artists'],
            ['name' => 'Sports', 'description' => 'Football, basketball, and other sports events'],
            ['name' => 'Conference', 'description' => 'Business and technology conferences'],
            ['name' => 'Workshop', 'description' => 'Educational and skill-building workshops'],
            ['name' => 'Festival', 'description' => 'Cultural and food festivals'],
            ['name' => 'Theater', 'description' => 'Drama, comedy, and theater shows'],
            ['name' => 'Exhibition', 'description' => 'Art and trade exhibitions'],
            ['name' => 'Seminar', 'description' => 'Professional development seminars'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'description' => $category['description'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
