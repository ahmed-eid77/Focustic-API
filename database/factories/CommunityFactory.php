<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'users_count' => $this->faker->numberBetween(1,100),
            'created_by'  => User::all()->random()->id
        ];
    }
}
