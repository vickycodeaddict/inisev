<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ['email' => 'user1@example.com', 'name' => 'John Doe', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'user2@example.com', 'name' => 'Smith One', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now()],
            ['email' => 'user3@example.com', 'name' => 'Alex Run', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
