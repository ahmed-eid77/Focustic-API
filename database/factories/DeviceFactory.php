<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rotation_x' => $this->faker->randomFloat(1, 20, 30),
            'rotation_y' => $this->faker->randomFloat(1, 20, 30),
            'rotation_z' => $this->faker->randomFloat(1, 20, 30),
            'ultrasonic' => $this->faker->randomFloat(1, 20, 30),
            'user_id'    => User::all()->random()->id
        ];
    }
}
