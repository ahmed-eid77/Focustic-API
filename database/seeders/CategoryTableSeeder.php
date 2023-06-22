<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**'name' => 'general'
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'general'
        ]);
        Category::create([
            'name' => 'Neck and Shoulder Relief'
        ]);
        Category::create([
            'name' => 'Eye Care and Vision'
        ]);
        Category::create([
            'name' => 'Back and Spine'
        ]);
        Category::create([
            'name' => 'Breathing and Relaxation'
        ]);
        Category::create([
            'name' => 'Stretch Breaks and Micro Movements'
        ]);
        Category::create([
            'name' => 'Mental Health and Mindfulness'
        ]);
    }
}
