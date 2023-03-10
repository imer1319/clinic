<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => 1,
            'doctor_id' => 1,
            'title' => $this->faker->sentence,
            'start' => date('Y-m-d'),
            'observations' => $this->faker->text,
            'color' => '#2d2d2d',
            'time_start' => '11:00',
            'time_end' => '14:00',
            'total' => rand(10,90),
            'status' => 'DEUDA',
        ];
    }
}
