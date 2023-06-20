<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $initiated_at = $this->faker->dateTime()->format('Y.m.d H:i:s');
        $due_date =  $this->faker->dateTimeBetween($initiated_at, $initiated_at . '+7 days')->format('Y.m.d H:i:s');

        return [
            'user_id'       => User::all()->random()->id,
            'name'          => $this->faker->sentence(),
            'note'          => $this->faker->text(),
            'duration'      => $this->faker->randomElement(['30', '45', '90']),
            'state'         => $this->faker->randomElement(['active', 'completed']),
            'initiated_at'  => $initiated_at,
            'due_date'      => $due_date,
            'kind'          => $this->faker->randomElement(['daily', 'weekly', 'monthly']),
            'reminder'      => $this->faker->boolean(),
            'reminder_date' => $this->faker->dateTime(),
            'repeat'        => $this->faker->boolean(),
        ];
    }
}
