<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'price' => rand(100, 1000),
            'service_id' => rand(1,4),
            'status' => 'ACTIVE'
        ];
    }
}
