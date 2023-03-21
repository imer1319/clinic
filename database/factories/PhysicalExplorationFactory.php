<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PhysicalExplorationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->sentence(5),
            'status' => 'ACTIVO'
        ];
    }
}
