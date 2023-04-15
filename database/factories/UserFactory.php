<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->regexify('[0-9]{10}'),
            'address' => $this->faker->address,
            'birthdate' => $this->faker->date(),
            'password' => bcrypt('password'),
            'type' => 'student',
            'image' => null,
        ];
    }
}
