<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricule' => strtoupper(fake()->bothify('??-####-??')),
            'model' => fake()->randomElement(['Peugeot 208', 'Renault Clio', 'Dacia Logan', 'Volkswagen Golf']),
            'image' => null,
        ];
    }
}
