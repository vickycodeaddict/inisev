<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Website;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Website::insert([
            ['name' => 'Algobo.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Botan.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Compier.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
