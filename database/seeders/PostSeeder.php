<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Website;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $websites = Website::all();

        foreach ($websites as $website) {
            Post::create([
                'website_id' => $website->id,
                'title' => 'Sample Post for ' . $website->name,
                'description' => 'This is a sample post for ' . $website->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
