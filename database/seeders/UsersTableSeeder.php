<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create 2 specific users for easy login
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'phone' => '+1234567890',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Employer User',
                'email' => 'employer@gmail.com',
                'phone' => '+1234567891',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'role' => 'user',
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
        ]);

        // Generate additional random users
        $users = [];
        for ($i = 1; $i <= 10; $i++) {
            $users[] = [
                'name' => "User $i",
                'email' => "user$i@example.com",
                'phone' => '+12345678' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'email_verified_at' => $i % 2 == 0 ? Carbon::now() : null,
                'password' => Hash::make('password'),
                'role' => 'user',
                'remember_token' => null,
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ];
        }

        DB::table('users')->insert($users);
    }
}
