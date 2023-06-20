<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseFactory extends Factory
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
            'body_part'   => $this->faker->sentence(),
            'repetitions' => $this->faker->numberBetween(1, 12),
            'sets'        => $this->faker->numberBetween(1, 9),
            'duration'    => $this->faker->numberBetween(1, 9),
            'category_id' => Category::all()->random()->id
        ];
    }
}
