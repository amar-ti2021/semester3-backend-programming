<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'phone' => '+62 8' . fake()->unique()->randomNumber(9, true),
            'address' => fake()->address(),
            'status_id' => fake()->numberBetween(1, 3),
            'in_date_at' => fake()->date(),
            'out_date_at' => fake()->date()
        ];
    }
}
