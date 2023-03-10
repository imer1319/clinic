<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'surnames' => $this->faker->sentence(2),
            'ci' => $this->faker->randomNumber(8),
            'address' => $this->faker->sentence(4),
            'phone' => $this->faker->randomNumber(8),
            'peso' => rand(40,120),
            'gender' => $this->faker->randomElement(['male','female']),
            'nacimiento' => $this->faker->date('Y-m-d'),
            'presion' => rand(80,180),
            'altura' => rand(100,220),
        ];
    }
}
