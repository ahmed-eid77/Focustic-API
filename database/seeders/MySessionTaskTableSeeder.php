<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MySessionTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my_session_tasks')->insert([
            ['session_id' => 1, 'task_id' => 1],
            ['session_id' => 1, 'task_id' => 2],
            ['session_id' => 1, 'task_id' => 3],
            ['session_id' => 1, 'task_id' => 4],
            ['session_id' => 2, 'task_id' => 8],
            ['session_id' => 2, 'task_id' => 9],
            ['session_id' => 2, 'task_id' => 10],
            ['session_id' => 2, 'task_id' => 11],
            ['session_id' => 3, 'task_id' => 12],
            ['session_id' => 3, 'task_id' => 13],
            ['session_id' => 3, 'task_id' => 14],
            ['session_id' => 3, 'task_id' => 15],
            ['session_id' => 4, 'task_id' => 16],
            ['session_id' => 4, 'task_id' => 17],
            ['session_id' => 4, 'task_id' => 18],
            ['session_id' => 4, 'task_id' => 19],
            ['session_id' => 4, 'task_id' => 20],
            ['session_id' => 5, 'task_id' => 21],
            ['session_id' => 5, 'task_id' => 22],
            ['session_id' => 5, 'task_id' => 23],
            ['session_id' => 5, 'task_id' => 24],
            ['session_id' => 5, 'task_id' => 25],
            ['session_id' => 5, 'task_id' => 26],
            ['session_id' => 5, 'task_id' => 27],
        ]);
    }
}
