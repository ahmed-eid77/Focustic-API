<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(100)->create();
        \App\Models\Task::factory(100)->create();
        \App\Models\MySession::factory(100)->create();
        \App\Models\Category::factory(7)->create();
        \App\Models\Community::factory(30)->create();
    }
}
