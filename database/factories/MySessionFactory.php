<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MySessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_time = Carbon::now();
        $end_time =  Carbon::now()->addHour(3);


        return [
            'name'       => $this->faker->sentence(),
            'state'         => $this->faker->randomElement(['active', 'completed']),
            'start_time' => $start_time,
            'end_time'   => $end_time,
            'user_id'    => User::all()->random()->id,
        ];
    }
}
