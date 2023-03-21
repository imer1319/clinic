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
            'city' => $this->faker->word(),
            'celular' => $this->faker->randomNumber(8),
            'gender' => $this->faker->randomElement(['Masculino','Femenino']),
            'nacimiento' => $this->faker->date('Y-m-d'),
            'notas' => $this->faker->sentence(7)
        ];
    }
}
