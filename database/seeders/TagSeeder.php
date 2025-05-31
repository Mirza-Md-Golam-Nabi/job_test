<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            "Beginner",
            "Advanced",
            "Tutorial",
            "Problem Solving",
            "Bug Fix",
            "Open Source"
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate([
                'title' => $tag
            ]);
        }
    }
}
