<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Web Development",
            "Mobile Development",
            "Game Development",
            "Data & AI",
            "DevOps & Infrastructure",
            "Cybersecurity"
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate([
                'title' => $category
            ]);
        }
    }
}
